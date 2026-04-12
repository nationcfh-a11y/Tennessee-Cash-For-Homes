require('dotenv').config();
const axios = require('axios');
const fs = require('fs');
const path = require('path');

const POST_ID = 1942;
const IMAGE_PATH = path.join(__dirname, 'tn-cash-for-homes', 'brand_assets', 'Zillow_Is_Lying.webp');
const FILENAME = 'Zillow_Is_Lying.webp';

const auth = Buffer.from(process.env.WP_USERNAME + ':' + process.env.WP_APP_PASSWORD).toString('base64');
const base = process.env.WP_URL + '/wp-json/wp/v2';

(async () => {
  // 1. Check if image already in media library by slug
  const searchRes = await axios.get(`${base}/media?slug=zillow_is_lying&per_page=10`, {
    headers: { Authorization: 'Basic ' + auth },
  });
  // Also search by 'zillow-is-lying'
  const searchRes2 = await axios.get(`${base}/media?search=Zillow_Is_Lying&per_page=10`, {
    headers: { Authorization: 'Basic ' + auth },
  });
  const existing = [...searchRes.data, ...searchRes2.data];
  let mediaId = null;
  if (existing.length) {
    mediaId = existing[0].id;
    console.log(`Found existing media id=${mediaId}: ${existing[0].source_url}`);
  } else {
    // 2. Upload image
    console.log('Uploading image to media library...');
    const buf = fs.readFileSync(IMAGE_PATH);
    const uploadRes = await axios.post(`${base}/media`, buf, {
      headers: {
        Authorization: 'Basic ' + auth,
        'Content-Type': 'image/webp',
        'Content-Disposition': `attachment; filename="${FILENAME}"`,
      },
      maxContentLength: Infinity,
      maxBodyLength: Infinity,
    });
    mediaId = uploadRes.data.id;
    console.log(`Uploaded. Media id=${mediaId}, url=${uploadRes.data.source_url}`);

    // Set alt text
    await axios.post(`${base}/media/${mediaId}`, {
      alt_text: "Zillow Is Lying About Your Home's Value",
      title: "Zillow Is Lying About Your Home's Value",
    }, { headers: { Authorization: 'Basic ' + auth } });
  }

  // 3. Set as featured image on the post
  console.log(`Setting featured_media=${mediaId} on post ${POST_ID}...`);
  const updateRes = await axios.post(`${base}/posts/${POST_ID}`, {
    featured_media: mediaId,
  }, { headers: { Authorization: 'Basic ' + auth } });

  console.log('Done.');
  console.log('  Post:', updateRes.data.title.rendered.replace(/<[^>]+>/g, ''));
  console.log('  featured_media:', updateRes.data.featured_media);
})().catch(e => {
  console.error('ERR:', e.response?.status, e.response?.data || e.message);
  process.exit(1);
});
