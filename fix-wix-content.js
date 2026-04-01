require('dotenv').config();
const axios = require('axios');
const fs = require('fs');
const path = require('path');

const WP_URL = process.env.WP_URL;
const WP_USERNAME = process.env.WP_USERNAME;
const WP_APP_PASSWORD = process.env.WP_APP_PASSWORD;
const WP_AUTH = Buffer.from(`${WP_USERNAME}:${WP_APP_PASSWORD}`).toString('base64');
const headers = { Authorization: `Basic ${WP_AUTH}`, 'Content-Type': 'application/json' };

const PREVIEW_ONLY = process.argv.includes('--preview');
const FIX_ALL = process.argv.includes('--fix-all');

// ─── Draft.js to HTML Converter ─────────────────────────────────

function draftJsToHtml(draftContent) {
  const { blocks, entityMap } = draftContent;
  if (!blocks || !Array.isArray(blocks)) return '';

  const htmlParts = [];
  let i = 0;

  while (i < blocks.length) {
    const block = blocks[i];

    // Group consecutive list items
    if (block.type === 'unordered-list-item' || block.type === 'ordered-list-item') {
      const tag = block.type === 'ordered-list-item' ? 'ol' : 'ul';
      const items = [];
      while (i < blocks.length && blocks[i].type === block.type) {
        items.push(`<li>${applyStyles(blocks[i], entityMap)}</li>`);
        i++;
      }
      htmlParts.push(`<${tag}>\n${items.join('\n')}\n</${tag}>`);
      continue;
    }

    switch (block.type) {
      case 'unstyled': {
        const text = applyStyles(block, entityMap);
        if (text.trim()) {
          htmlParts.push(`<p>${text}</p>`);
        }
        break;
      }
      case 'header-two':
        htmlParts.push(`<h2>${applyStyles(block, entityMap)}</h2>`);
        break;
      case 'header-three':
        htmlParts.push(`<h3>${applyStyles(block, entityMap)}</h3>`);
        break;
      case 'header-four':
        htmlParts.push(`<h4>${applyStyles(block, entityMap)}</h4>`);
        break;
      case 'atomic':
        htmlParts.push(renderAtomicBlock(block, entityMap));
        break;
      default: {
        const text = applyStyles(block, entityMap);
        if (text.trim()) {
          htmlParts.push(`<p>${text}</p>`);
        }
      }
    }
    i++;
  }

  return htmlParts.join('\n\n');
}

function applyStyles(block, entityMap) {
  const { text, inlineStyleRanges, entityRanges } = block;
  if (!text) return '';

  // Build a character-level annotation map
  const chars = Array.from(text);
  const annotations = chars.map(() => ({ styles: new Set(), entity: null }));

  // Apply inline styles
  for (const range of (inlineStyleRanges || [])) {
    for (let i = range.offset; i < range.offset + range.length && i < chars.length; i++) {
      annotations[i].styles.add(range.style);
    }
  }

  // Apply entity ranges
  for (const range of (entityRanges || [])) {
    for (let i = range.offset; i < range.offset + range.length && i < chars.length; i++) {
      annotations[i].entity = range.key;
    }
  }

  // Build HTML by grouping runs with the same annotations
  let result = '';
  let currentStyles = new Set();
  let currentEntity = null;

  for (let i = 0; i < chars.length; i++) {
    const ann = annotations[i];
    const stylesChanged = !setsEqual(ann.styles, currentStyles);
    const entityChanged = ann.entity !== currentEntity;

    if (stylesChanged || entityChanged) {
      // Close previous
      if (currentEntity !== null) result += '</a>';
      result += closeStyleTags(currentStyles);

      // Open new
      currentStyles = ann.styles;
      currentEntity = ann.entity;

      result += openStyleTags(currentStyles);
      if (currentEntity !== null) {
        const entity = entityMap[currentEntity];
        if (entity && entity.type === 'LINK') {
          const url = entity.data.url || '#';
          const target = entity.data.target ? ` target="${entity.data.target}"` : '';
          result += `<a href="${escapeHtml(url)}"${target}>`;
        }
      }
    }

    result += escapeHtml(chars[i]);
  }

  // Close remaining
  if (currentEntity !== null) result += '</a>';
  result += closeStyleTags(currentStyles);

  // Clean up newlines within paragraphs
  result = result.replace(/\n/g, '<br />');

  return result;
}

function openStyleTags(styles) {
  let tags = '';
  if (styles.has('BOLD')) tags += '<strong>';
  if (styles.has('ITALIC')) tags += '<em>';
  if (styles.has('UNDERLINE')) tags += '<u>';
  return tags;
}

function closeStyleTags(styles) {
  let tags = '';
  if (styles.has('UNDERLINE')) tags += '</u>';
  if (styles.has('ITALIC')) tags += '</em>';
  if (styles.has('BOLD')) tags += '</strong>';
  return tags;
}

function setsEqual(a, b) {
  if (a.size !== b.size) return false;
  for (const item of a) if (!b.has(item)) return false;
  return true;
}

function renderAtomicBlock(block, entityMap) {
  if (!block.entityRanges || block.entityRanges.length === 0) return '';
  const entityKey = block.entityRanges[0].key;
  const entity = entityMap[entityKey];
  if (!entity) return '';

  switch (entity.type) {
    case 'wix-draft-plugin-image': {
      const src = entity.data.src;
      if (!src) return '';
      const fileId = src.file_name || src.id || '';
      const imgUrl = fileId.startsWith('http')
        ? fileId
        : `https://static.wixstatic.com/media/${fileId}`;
      const alt = entity.data.metadata?.alt || entity.data.metadata?.caption || '';
      return `<figure><img src="${escapeHtml(imgUrl)}" alt="${escapeHtml(alt)}" width="${src.width || ''}" height="${src.height || ''}" />${
        entity.data.metadata?.caption ? `<figcaption>${escapeHtml(entity.data.metadata.caption)}</figcaption>` : ''
      }</figure>`;
    }
    case 'wix-draft-plugin-video': {
      const videoSrc = entity.data.src || '';
      if (!videoSrc) return '';
      // Convert YouTube URLs to embeds
      const ytMatch = videoSrc.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/);
      if (ytMatch) {
        return `<figure><iframe width="560" height="315" src="https://www.youtube.com/embed/${ytMatch[1]}" frameborder="0" allowfullscreen></iframe></figure>`;
      }
      return `<p><a href="${escapeHtml(videoSrc)}">Watch Video</a></p>`;
    }
    case 'wix-draft-plugin-link-button': {
      const btnData = entity.data || {};
      const url = btnData.button?.settings?.url?.url || btnData.url || '#';
      const text = btnData.button?.settings?.buttonText || btnData.text || 'Learn More';
      const target = btnData.button?.settings?.url?.target || '_blank';
      return `<p><a href="${escapeHtml(url)}" target="${target}" class="wp-block-button__link">${escapeHtml(text)}</a></p>`;
    }
    default:
      return '';
  }
}

function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

// ─── Schema Markup ──────────────────────────────────────────────

function generateArticleSchema(title, date, wpUrl) {
  return JSON.stringify({
    '@context': 'https://schema.org',
    '@type': 'Article',
    headline: title,
    datePublished: date,
    author: { '@type': 'Organization', name: 'Nation Capital Home Solutions' },
    publisher: { '@type': 'Organization', name: 'Nation Capital Home Solutions' },
    mainEntityOfPage: { '@type': 'WebPage', '@id': wpUrl },
  });
}

// ─── Main ───────────────────────────────────────────────────────

async function fetchAllPosts() {
  const all = [];
  let page = 1;
  while (true) {
    const r = await axios.get(`${WP_URL}/wp-json/wp/v2/posts`, {
      params: { per_page: 100, page, context: 'edit' },
      headers,
    });
    all.push(...r.data);
    if (r.data.length < 100) break;
    page++;
  }
  return all;
}

async function main() {
  console.log('═══════════════════════════════════════');
  console.log('  Wix Draft.js → WordPress HTML Fixer');
  console.log('═══════════════════════════════════════\n');

  console.log('Fetching all WordPress posts...');
  const posts = await fetchAllPosts();
  console.log(`Found ${posts.length} posts\n`);

  // Identify posts with raw Draft.js JSON
  const jsonPosts = [];
  for (const post of posts) {
    const raw = post.content.raw.trimStart();
    if (raw.startsWith('{"blocks"')) {
      jsonPosts.push(post);
    }
  }
  console.log(`${jsonPosts.length} posts contain raw Wix Draft.js JSON\n`);

  if (jsonPosts.length === 0) {
    console.log('Nothing to fix!');
    return;
  }

  // ─── Preview mode: show 1 post before/after ────────────────
  if (PREVIEW_ONLY || !FIX_ALL) {
    const post = jsonPosts[0];
    let rawJson = post.content.raw;
    const schemaIdx = rawJson.indexOf('\n<!-- Article Schema');
    if (schemaIdx > 0) rawJson = rawJson.substring(0, schemaIdx);

    const draft = JSON.parse(rawJson);
    const html = draftJsToHtml(draft);

    // Add schema
    const schema = generateArticleSchema(
      post.title.raw, post.date, post.link
    );
    const fullHtml = html + `\n\n<!-- Article Schema Markup -->\n<script type="application/ld+json">${schema}</script>`;

    console.log('═══════════════════════════════════════');
    console.log(`  PREVIEW: "${post.title.raw}"`);
    console.log('═══════════════════════════════════════');
    console.log('\n─── BEFORE (first 500 chars of raw JSON) ───');
    console.log(post.content.raw.substring(0, 500));
    console.log('\n─── AFTER (converted HTML) ───');
    console.log(fullHtml.substring(0, 2000));
    console.log('\n═══════════════════════════════════════');
    console.log('\nTo fix all posts, run:');
    console.log('  node fix-wix-content.js --fix-all\n');
    return;
  }

  // ─── Fix all posts ─────────────────────────────────────────
  console.log('Updating all posts with clean HTML...\n');
  let success = 0;
  let failed = 0;

  for (let i = 0; i < jsonPosts.length; i++) {
    const post = jsonPosts[i];
    const num = i + 1;
    process.stdout.write(`  [${num}/${jsonPosts.length}] "${post.title.raw.substring(0, 60)}..." `);

    try {
      let rawJson = post.content.raw;
      const schemaIdx = rawJson.indexOf('\n<!-- Article Schema');
      if (schemaIdx > 0) rawJson = rawJson.substring(0, schemaIdx);

      const draft = JSON.parse(rawJson);
      const html = draftJsToHtml(draft);

      const schema = generateArticleSchema(
        post.title.raw, post.date, post.link
      );
      const fullHtml = html + `\n\n<!-- Article Schema Markup -->\n<script type="application/ld+json">${schema}</script>`;

      await axios.post(
        `${WP_URL}/wp-json/wp/v2/posts/${post.id}`,
        { content: fullHtml },
        { headers }
      );

      console.log('✓');
      success++;
    } catch (err) {
      console.log('✗ ' + (err.response?.data?.message || err.message));
      failed++;
    }

    // Small delay for rate limiting
    await new Promise(r => setTimeout(r, 300));
  }

  console.log('\n═══════════════════════════════════════');
  console.log(`  Done! ${success} fixed, ${failed} failed`);
  console.log('═══════════════════════════════════════\n');
}

main().catch(err => {
  console.error('Fatal error:', err.message);
  process.exit(1);
});
