require('dotenv').config();
const axios = require('axios');
const fs = require('fs');
const path = require('path');
const sharp = require('sharp');
const cheerio = require('cheerio');

// ─── Config from .env ───────────────────────────────────────────
const WIX_API_KEY = process.env.WIX_API_KEY;
const WIX_SITE_ID = process.env.WIX_SITE_ID;
const WP_URL = process.env.WP_URL;
const WP_USERNAME = process.env.WP_USERNAME;
const WP_APP_PASSWORD = process.env.WP_APP_PASSWORD;

const WP_AUTH = Buffer.from(`${WP_USERNAME}:${WP_APP_PASSWORD}`).toString('base64');
const IMAGE_DIR = path.join(__dirname, 'migrated-images');
const TEST_MODE = process.argv.includes('--test');
const TEST_LIMIT = 3;

// Load CSV URL mapping for exact Wix URLs
function loadWixUrlMap() {
  const csvPath = path.join(__dirname, 'wix-blog-urls.csv');
  if (!fs.existsSync(csvPath)) return {};
  const lines = fs.readFileSync(csvPath, 'utf-8').split('\n').slice(1); // skip header
  const map = {}; // slug -> full Wix URL
  for (const line of lines) {
    if (!line.trim()) continue;
    // Handle CSV with possible quoted fields
    const match = line.match(/,\s*(https?:\/\/.+)/);
    if (match) {
      const url = match[1].trim().replace(/^"|"$/g, '');
      const slugMatch = url.match(/\/post\/(.+?)$/);
      if (slugMatch) {
        map[slugMatch[1]] = url;
      }
    }
  }
  return map;
}

// ─── Helpers ────────────────────────────────────────────────────

function slugify(text) {
  return text.toLowerCase()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');
}

function imageFilename(postTitle, index, ext) {
  const base = slugify(postTitle);
  const suffix = index > 0 ? `-${index + 1}` : '';
  return `${base}${suffix}${ext || '.jpg'}`;
}

async function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

// ─── Wix API ────────────────────────────────────────────────────

const wixApi = axios.create({
  baseURL: 'https://www.wixapis.com/blog/v3',
  headers: {
    'Authorization': WIX_API_KEY,
    'wix-site-id': WIX_SITE_ID,
    'Content-Type': 'application/json',
  },
});

async function fetchAllWixPosts() {
  const allPosts = [];
  let cursor = null;
  let page = 1;

  while (true) {
    console.log(`  Fetching Wix posts page ${page}...`);
    const body = {
      paging: { limit: 100 },
      fieldsets: ['CONTENT', 'SEO', 'URL', 'CONTENT_TEXT'],
    };
    if (cursor) {
      body.paging.cursor = cursor;
    }

    const res = await wixApi.post('/posts/query', body);
    const posts = res.data.posts || [];
    allPosts.push(...posts);
    console.log(`  Got ${posts.length} posts (total: ${allPosts.length})`);

    const pagingMetadata = res.data.pagingMetadata || res.data.metaData;
    if (pagingMetadata && pagingMetadata.cursors && pagingMetadata.cursors.next) {
      cursor = pagingMetadata.cursors.next;
      page++;
    } else if (posts.length === 100) {
      // Fallback: use offset-based paging
      body.paging.offset = allPosts.length;
      delete body.paging.cursor;
      page++;
    } else {
      break;
    }

    await sleep(500); // Rate limit courtesy
  }

  return allPosts;
}

async function fetchWixCategories() {
  try {
    const res = await wixApi.post('/categories/query', {
      paging: { limit: 100 },
    });
    return res.data.categories || [];
  } catch (err) {
    console.warn('  Warning: Could not fetch Wix categories:', err.response?.data?.message || err.message);
    return [];
  }
}

async function fetchWixTags() {
  try {
    const res = await wixApi.post('/tags/query', {
      paging: { limit: 100 },
    });
    return res.data.tags || [];
  } catch (err) {
    console.warn('  Warning: Could not fetch Wix tags:', err.response?.data?.message || err.message);
    return [];
  }
}

// ─── WordPress API ──────────────────────────────────────────────

const wpApi = axios.create({
  baseURL: `${WP_URL}/wp-json/wp/v2`,
  headers: {
    'Authorization': `Basic ${WP_AUTH}`,
    'Content-Type': 'application/json',
  },
});

async function getOrCreateWpCategory(name) {
  // Check if it exists
  const res = await wpApi.get('/categories', { params: { search: name, per_page: 100 } });
  const match = res.data.find(c => c.name.toLowerCase() === name.toLowerCase());
  if (match) return match.id;

  // Create it
  const created = await wpApi.post('/categories', { name, slug: slugify(name) });
  return created.data.id;
}

async function getOrCreateWpTag(name) {
  const res = await wpApi.get('/tags', { params: { search: name, per_page: 100 } });
  const match = res.data.find(t => t.name.toLowerCase() === name.toLowerCase());
  if (match) return match.id;

  const created = await wpApi.post('/tags', { name, slug: slugify(name) });
  return created.data.id;
}

async function uploadImageToWp(filePath, altText) {
  const fileName = path.basename(filePath);
  const fileBuffer = fs.readFileSync(filePath);
  const mimeType = fileName.endsWith('.png') ? 'image/png'
    : fileName.endsWith('.webp') ? 'image/webp'
    : 'image/jpeg';

  const res = await axios.post(
    `${WP_URL}/wp-json/wp/v2/media`,
    fileBuffer,
    {
      headers: {
        'Authorization': `Basic ${WP_AUTH}`,
        'Content-Type': mimeType,
        'Content-Disposition': `attachment; filename="${fileName}"`,
      },
    }
  );

  // Set alt text
  if (altText) {
    await axios.post(
      `${WP_URL}/wp-json/wp/v2/media/${res.data.id}`,
      { alt_text: altText },
      {
        headers: {
          'Authorization': `Basic ${WP_AUTH}`,
          'Content-Type': 'application/json',
        },
      }
    );
  }

  return { id: res.data.id, url: res.data.source_url };
}

// ─── Image Processing ───────────────────────────────────────────

async function downloadAndOptimizeImage(imageUrl, postTitle, index) {
  if (!fs.existsSync(IMAGE_DIR)) {
    fs.mkdirSync(IMAGE_DIR, { recursive: true });
  }

  const ext = '.jpg'; // Standardize to optimized JPEG
  const filename = imageFilename(postTitle, index, ext);
  const outputPath = path.join(IMAGE_DIR, filename);

  // Skip if already downloaded
  if (fs.existsSync(outputPath)) {
    return outputPath;
  }

  try {
    const response = await axios.get(imageUrl, { responseType: 'arraybuffer', timeout: 30000 });
    const buffer = Buffer.from(response.data);

    // Optimize with sharp - resize if too large, compress
    await sharp(buffer)
      .resize(1200, null, { withoutEnlargement: true })
      .jpeg({ quality: 82, progressive: true })
      .toFile(outputPath);

    return outputPath;
  } catch (err) {
    console.warn(`    Warning: Failed to download image: ${imageUrl} - ${err.message}`);
    return null;
  }
}

// ─── Wix Content Parsing ────────────────────────────────────────

function extractWixContentHtml(richContent) {
  // Wix stores content in a rich content JSON format (Draft.js-like)
  // We need to convert it to HTML
  if (!richContent || !richContent.nodes) {
    return '';
  }

  let html = '';

  for (const node of richContent.nodes) {
    html += renderNode(node);
  }

  return html;
}

function renderNode(node) {
  if (!node) return '';

  switch (node.type) {
    case 'PARAGRAPH': {
      const inner = (node.nodes || []).map(renderNode).join('');
      return inner ? `<p>${inner}</p>` : '';
    }
    case 'HEADING': {
      const level = node.headingData?.level || node.style?.headerLevel || 2;
      const hTag = `h${level}`;
      const inner = (node.nodes || []).map(renderNode).join('');
      return `<${hTag}>${inner}</${hTag}>`;
    }
    case 'TEXT': {
      let text = node.textData?.text || '';
      const decorations = node.textData?.decorations || [];
      for (const dec of decorations) {
        if (dec.type === 'BOLD') text = `<strong>${text}</strong>`;
        if (dec.type === 'ITALIC') text = `<em>${text}</em>`;
        if (dec.type === 'UNDERLINE') text = `<u>${text}</u>`;
        if (dec.type === 'LINK' || dec.type === 'ANCHOR') {
          const url = dec.linkData?.link?.url || dec.anchorData?.anchor || '#';
          text = `<a href="${url}">${text}</a>`;
        }
      }
      return text;
    }
    case 'IMAGE': {
      const src = node.imageData?.image?.src?.url || node.imageData?.src?.url || '';
      const alt = node.imageData?.altText || '';
      const imgUrl = src.startsWith('//') ? `https:${src}` : src;
      return `<img src="${imgUrl}" alt="${alt}" />`;
    }
    case 'BULLETED_LIST':
    case 'ORDERED_LIST': {
      const tag = node.type === 'ORDERED_LIST' ? 'ol' : 'ul';
      const items = (node.nodes || []).map(renderNode).join('');
      return `<${tag}>${items}</${tag}>`;
    }
    case 'LIST_ITEM': {
      const inner = (node.nodes || []).map(renderNode).join('');
      return `<li>${inner}</li>`;
    }
    case 'BLOCKQUOTE': {
      const inner = (node.nodes || []).map(renderNode).join('');
      return `<blockquote>${inner}</blockquote>`;
    }
    case 'DIVIDER':
      return '<hr />';
    case 'VIDEO': {
      const videoUrl = node.videoData?.video?.src?.url || '';
      return videoUrl ? `<p><a href="${videoUrl}">Watch Video</a></p>` : '';
    }
    case 'EMBED':
    case 'HTML': {
      const embedHtml = node.htmlData?.html || node.embedData?.html || '';
      return embedHtml;
    }
    default: {
      // Recursively process child nodes
      const inner = (node.nodes || []).map(renderNode).join('');
      return inner;
    }
  }
}

function extractImagesFromContent(html) {
  const $ = cheerio.load(html);
  const images = [];
  $('img').each((i, el) => {
    const src = $(el).attr('src');
    if (src) images.push(src);
  });
  return images;
}

// ─── Schema Markup ──────────────────────────────────────────────

function generateArticleSchema(post, wpUrl) {
  return JSON.stringify({
    '@context': 'https://schema.org',
    '@type': 'Article',
    'headline': post.title,
    'datePublished': post.firstPublishedDate || post.publishedDate,
    'dateModified': post.lastPublishedDate || post.publishedDate,
    'author': {
      '@type': 'Organization',
      'name': 'Nation Capital Home Solutions',
    },
    'publisher': {
      '@type': 'Organization',
      'name': 'Nation Capital Home Solutions',
    },
    'mainEntityOfPage': {
      '@type': 'WebPage',
      '@id': wpUrl,
    },
  });
}

// ─── Main Migration ─────────────────────────────────────────────

async function migrate() {
  console.log('═══════════════════════════════════════');
  console.log(TEST_MODE ? '  TEST RUN — Migrating 3 posts only' : '  FULL MIGRATION');
  console.log('═══════════════════════════════════════\n');

  // Step 1: Verify WordPress connection
  console.log('[1/7] Verifying WordPress connection...');
  try {
    const wpCheck = await wpApi.get('/posts', { params: { per_page: 1 } });
    console.log('  ✓ WordPress API connected\n');
  } catch (err) {
    console.error('  ✗ Cannot connect to WordPress API:', err.response?.data?.message || err.message);
    console.error('  Make sure Yoast SEO or RankMath is installed and the REST API is accessible.');
    process.exit(1);
  }

  // Step 2: Fetch Wix categories and tags
  console.log('[2/7] Fetching Wix categories and tags...');
  const wixCategories = await fetchWixCategories();
  const wixTags = await fetchWixTags();
  console.log(`  Found ${wixCategories.length} categories, ${wixTags.length} tags\n`);

  // Build lookup maps
  const categoryMap = {};
  for (const cat of wixCategories) {
    categoryMap[cat._id] = cat.label || cat.displayName || cat.name;
  }
  const tagMap = {};
  for (const tag of wixTags) {
    tagMap[tag._id] = tag.label || tag.displayName || tag.name;
  }

  // Step 3: Fetch all Wix posts
  console.log('[3/7] Fetching all Wix blog posts...');
  let allPosts = await fetchAllWixPosts();
  console.log(`  Total posts found: ${allPosts.length}\n`);

  if (TEST_MODE) {
    allPosts = allPosts.slice(0, TEST_LIMIT);
    console.log(`  Test mode: limiting to ${TEST_LIMIT} posts\n`);
  }

  // Load the CSV URL map for exact Wix URLs
  const wixUrlMap = loadWixUrlMap();
  console.log(`  Loaded ${Object.keys(wixUrlMap).length} URLs from wix-blog-urls.csv\n`);

  // Step 4: Migrate posts
  console.log('[4/7] Migrating posts to WordPress...\n');
  const results = [];
  const redirects = [];

  for (let i = 0; i < allPosts.length; i++) {
    const post = allPosts[i];
    const postNum = i + 1;
    const title = post.title || 'Untitled';
    console.log(`  [${postNum}/${allPosts.length}] "${title}"`);

    try {
      // Extract slug from Wix URL
      const wixSlug = post.slug || post.url?.path?.replace(/^\/post\//, '') || slugify(title);
      // Use exact URL from CSV if available, otherwise construct from slug
      const wixUrl = wixUrlMap[wixSlug]
        || post.url?.url
        || `https://www.tennesseecashforhomes.com/post/${wixSlug}`;

      // Convert content
      let contentHtml = '';
      if (post.richContent) {
        contentHtml = extractWixContentHtml(post.richContent);
      } else if (post.content) {
        // Some Wix APIs return raw HTML
        contentHtml = post.content;
      } else if (post.plainContent) {
        contentHtml = `<p>${post.plainContent.replace(/\n\n/g, '</p><p>').replace(/\n/g, '<br />')}</p>`;
      }

      // Handle images in content
      const imageUrls = extractImagesFromContent(contentHtml);
      let featuredImageId = null;
      let imgIndex = 0;

      // Handle featured/cover image
      const coverImageUrl = post.coverImage?.image?.url
        || post.coverImage?.src?.url
        || post.media?.wixMedia?.image?.url
        || null;

      if (coverImageUrl) {
        const fullUrl = coverImageUrl.startsWith('//') ? `https:${coverImageUrl}` : coverImageUrl;
        console.log(`    Downloading cover image...`);
        const localPath = await downloadAndOptimizeImage(fullUrl, title, 0);
        if (localPath) {
          const altText = `${title} - Featured Image`;
          const uploaded = await uploadImageToWp(localPath, altText);
          featuredImageId = uploaded.id;
          console.log(`    ✓ Cover image uploaded`);
        }
        imgIndex = 1;
      }

      // Handle content images
      for (const imgUrl of imageUrls) {
        const fullUrl = imgUrl.startsWith('//') ? `https:${imgUrl}` : imgUrl;
        if (!fullUrl.startsWith('http')) continue;

        console.log(`    Downloading content image ${imgIndex + 1}...`);
        const localPath = await downloadAndOptimizeImage(fullUrl, title, imgIndex);
        if (localPath) {
          const altText = `${title} - Image ${imgIndex + 1}`;
          const uploaded = await uploadImageToWp(localPath, altText);
          // Replace old URL with new WordPress URL in content
          contentHtml = contentHtml.split(imgUrl).join(uploaded.url);

          // Use first content image as featured if no cover
          if (!featuredImageId) {
            featuredImageId = uploaded.id;
          }
        }
        imgIndex++;
        await sleep(300);
      }

      // Resolve categories
      const wpCategoryIds = [];
      if (post.categoryIds) {
        for (const catId of post.categoryIds) {
          const catName = categoryMap[catId];
          if (catName) {
            const wpCatId = await getOrCreateWpCategory(catName);
            wpCategoryIds.push(wpCatId);
          }
        }
      }

      // Resolve tags
      const wpTagIds = [];
      if (post.tagIds) {
        for (const tagId of post.tagIds) {
          const tagName = tagMap[tagId];
          if (tagName) {
            const wpTagId = await getOrCreateWpTag(tagName);
            wpTagIds.push(wpTagId);
          }
        }
      }

      // SEO data
      const seoTitle = post.seoData?.title || post.seoTitle || title;
      const seoDescription = post.seoData?.description || post.seoDescription || '';

      // Build Article schema
      const newWpUrl = `${WP_URL}/${wixSlug}/`;
      const schemaMarkup = generateArticleSchema(post, newWpUrl);

      // Add schema to content footer
      const schemaScript = `\n<!-- Article Schema Markup -->\n<script type="application/ld+json">${schemaMarkup}</script>`;

      // Publish date
      const publishDate = post.firstPublishedDate || post.publishedDate || post.createdDate;

      // Create the WordPress post
      const wpPostData = {
        title: title,
        content: contentHtml + schemaScript,
        slug: wixSlug,
        status: 'publish',
        date: publishDate,
        categories: wpCategoryIds.length > 0 ? wpCategoryIds : undefined,
        tags: wpTagIds.length > 0 ? wpTagIds : undefined,
        featured_media: featuredImageId || undefined,
        meta: {},
      };

      // Yoast SEO meta fields (if Yoast is installed)
      wpPostData.meta = {
        _yoast_wpseo_title: seoTitle,
        _yoast_wpseo_metadesc: seoDescription,
        _yoast_wpseo_canonical: newWpUrl,
      };

      // Also try RankMath fields
      wpPostData.meta.rank_math_title = seoTitle;
      wpPostData.meta.rank_math_description = seoDescription;
      wpPostData.meta.rank_math_canonical_url = newWpUrl;

      const created = await wpApi.post('/posts', wpPostData);
      const actualWpUrl = created.data.link;

      console.log(`    ✓ Published: ${actualWpUrl}`);

      results.push({
        status: 'success',
        title,
        wixUrl,
        wpUrl: actualWpUrl,
        wpSlug: created.data.slug,
      });

      redirects.push({
        oldUrl: `/post/${wixSlug}`,
        newUrl: `/${created.data.slug}/`,
        wixFullUrl: wixUrl,
        wpFullUrl: actualWpUrl,
      });

    } catch (err) {
      const errorMsg = err.response?.data?.message || err.response?.data?.data?.status
        || err.message;
      console.error(`    ✗ FAILED: ${errorMsg}`);
      results.push({
        status: 'failed',
        title,
        error: errorMsg,
      });
    }

    await sleep(500); // Rate limit
  }

  // Step 5: Generate redirects CSV
  console.log('\n[5/7] Generating redirects.csv...');
  const csvHeader = 'source_url,target_url,status_code,wix_full_url,wp_full_url\n';
  const csvRows = redirects.map(r =>
    `"${r.oldUrl}","${r.newUrl}",301,"${r.wixFullUrl}","${r.wpFullUrl}"`
  ).join('\n');
  fs.writeFileSync(path.join(__dirname, 'redirects.csv'), csvHeader + csvRows);
  console.log(`  ✓ redirects.csv generated with ${redirects.length} entries\n`);

  // Step 6: Generate XML sitemap
  console.log('[6/7] Generating sitemap.xml...');
  const sitemapEntries = results
    .filter(r => r.status === 'success')
    .map(r => `  <url>
    <loc>${r.wpUrl}</loc>
    <lastmod>${new Date().toISOString().split('T')[0]}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>`).join('\n');

  const sitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
${sitemapEntries}
</urlset>`;
  fs.writeFileSync(path.join(__dirname, 'migrated-sitemap.xml'), sitemap);
  console.log(`  ✓ migrated-sitemap.xml generated\n`);

  // Step 7: Summary
  console.log('[7/7] Migration Summary');
  console.log('═══════════════════════════════════════');
  const successful = results.filter(r => r.status === 'success');
  const failed = results.filter(r => r.status === 'failed');

  console.log(`  Total posts:     ${results.length}`);
  console.log(`  Successful:      ${successful.length}`);
  console.log(`  Failed:          ${failed.length}`);

  if (TEST_MODE) {
    console.log('\n  TEST RUN RESULTS:');
    for (const r of successful) {
      console.log(`    ✓ "${r.title}"`);
      console.log(`      Wix:  ${r.wixUrl}`);
      console.log(`      WP:   ${r.wpUrl}`);
    }
  }

  if (failed.length > 0) {
    console.log('\n  FAILED POSTS:');
    for (const r of failed) {
      console.log(`    ✗ "${r.title}" — ${r.error}`);
    }
  }

  if (!TEST_MODE) {
    console.log('\n  NEXT STEPS:');
    console.log('  1. Install the "Redirection" plugin on WordPress');
    console.log('     Import redirects.csv to set up 301 redirects');
    console.log('  2. Submit migrated-sitemap.xml to Google Search Console');
    console.log('  3. Verify Yoast SEO or RankMath meta data on a few posts');
    console.log('  4. Test a few post URLs to make sure they load correctly');
  } else {
    console.log('\n  Review the 3 test posts above.');
    console.log('  When ready, run again WITHOUT --test flag for full migration:');
    console.log('    node migrate-wix-to-wp.js');
  }

  console.log('\n═══════════════════════════════════════');
}

// Run
migrate().catch(err => {
  console.error('Fatal error:', err.message);
  process.exit(1);
});
