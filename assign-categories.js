require('dotenv').config();
const axios = require('axios');

const auth = Buffer.from(process.env.WP_USERNAME + ':' + process.env.WP_APP_PASSWORD).toString('base64');
const api = axios.create({
  baseURL: process.env.WP_URL + '/wp-json/wp/v2',
  headers: { Authorization: 'Basic ' + auth },
  timeout: 30000,
});

// Post ID -> category slug assignments
const ASSIGNMENTS = {
  1941: 'market-trends',
  1942: 'education',
  1944: 'selling-guide',
  1946: 'education',
  1948: 'education',
  1950: 'selling-guide',
  1952: 'selling-guide',
  1954: 'selling-guide',
  1956: 'market-trends',
  1958: 'selling-guide',
  1960: 'market-trends',
  1962: 'selling-guide',
  1964: 'selling-guide',
  1966: 'selling-guide',
  1968: 'market-trends',
  1970: 'selling-guide',
  1972: 'selling-guide',
  1974: 'market-trends',
  1976: 'selling-guide',
  1978: 'selling-guide',
  1980: 'selling-guide',
  1982: 'selling-guide',
  1984: 'selling-guide',
  1986: 'selling-guide',
  1988: 'selling-guide',
  1990: 'selling-guide',
  1992: 'market-trends',
  1994: 'selling-guide',
  1996: 'education',
  1998: 'selling-guide',
  2000: 'selling-guide',
  2002: 'education',
  2004: 'selling-guide',
  2006: 'education',
  2008: 'market-trends',
  2010: 'education',
  2012: 'education',
  2014: 'education',
  2016: 'education',
  2018: 'selling-guide',
  2020: 'selling-guide',
  2022: 'selling-guide',
  2024: 'selling-guide',
  2026: 'selling-guide',
  2028: 'selling-guide',
  2030: 'selling-guide',
  2032: 'education',
  2034: 'market-trends',
  2036: 'selling-guide',
  2038: 'market-trends',
  2040: 'selling-guide',
  2042: 'selling-guide',
  2044: 'selling-guide',
  2046: 'market-trends',
  2048: 'selling-guide',
  2050: 'home-tips',
  2052: 'education',
  2054: 'education',
  2056: 'education',
  2058: 'home-tips',
  2060: 'home-tips',
  2062: 'home-tips',
  2064: 'home-tips',
  2066: 'home-tips',
  2068: 'home-tips',
  2070: 'education',
  2072: 'education',
  2074: 'market-trends',
  2076: 'market-trends',
  2078: 'market-trends',
  2080: 'selling-guide',
  2082: 'home-tips',
  2084: 'selling-guide',
  2086: 'education',
  2088: 'education',
  2090: 'selling-guide',
  2092: 'education',
  2094: 'home-tips',
  2096: 'selling-guide',
  2098: 'selling-guide',
  2100: 'selling-guide',
  2102: 'education',
  2104: 'education',
  2106: 'home-tips',
  2108: 'market-trends',
  2110: 'market-trends',
  2112: 'market-trends',
  2114: 'education',
  2116: 'market-trends',
  2118: 'selling-guide',
  2120: 'selling-guide',
  2122: 'education',
  2124: 'education',
  2126: 'selling-guide',
  2128: 'education',
  2130: 'selling-guide',
  2132: 'education',
  2134: 'selling-guide',
  2136: 'education',
  2138: 'selling-guide',
  2140: 'education',
  2142: 'education',
  2144: 'selling-guide',
  2146: 'education',
};

const CATEGORY_DEFS = [
  { slug: 'market-trends',   name: 'Market Trends' },
  { slug: 'home-tips',       name: 'Home Tips' },
  { slug: 'selling-guide',   name: 'Selling Guide' },
  { slug: 'education',       name: 'Education' },
  { slug: 'success-stories', name: 'Success Stories' },
];

async function ensureCategories() {
  const existing = {};
  let page = 1;
  while (true) {
    const r = await api.get(`/categories?per_page=100&page=${page}`);
    r.data.forEach(c => { existing[c.slug] = c.id; });
    if (r.data.length < 100) break;
    page++;
  }
  const map = {};
  for (const def of CATEGORY_DEFS) {
    if (existing[def.slug]) {
      map[def.slug] = existing[def.slug];
      console.log(`  ✓ Category exists: ${def.name} (id=${existing[def.slug]})`);
    } else {
      const r = await api.post('/categories', { name: def.name, slug: def.slug });
      map[def.slug] = r.data.id;
      console.log(`  + Created category: ${def.name} (id=${r.data.id})`);
    }
  }
  return map;
}

async function fetchAllPosts() {
  const all = [];
  for (let page = 1; ; page++) {
    const r = await api.get(`/posts?per_page=100&status=publish&_fields=id,title,categories&orderby=date&order=desc&page=${page}`);
    all.push(...r.data);
    if (r.data.length < 100) break;
  }
  return all;
}

(async () => {
  console.log('== Ensuring categories ==');
  const catMap = await ensureCategories();

  console.log('\n== Fetching posts ==');
  const posts = await fetchAllPosts();
  console.log(`Found ${posts.length} posts.`);

  const errors = [];
  const uncategorized = [];
  const report = [];

  for (const p of posts) {
    const slug = ASSIGNMENTS[p.id];
    if (!slug) {
      uncategorized.push(p);
      continue;
    }
    const catId = catMap[slug];
    const title = p.title.rendered.replace(/<[^>]+>/g, '').replace(/&#8217;/g, "'").replace(/&#8220;|&#8221;/g, '"').replace(/&amp;/g, '&');
    try {
      await api.post(`/posts/${p.id}`, { categories: [catId] });
      report.push({ id: p.id, title, category: CATEGORY_DEFS.find(c => c.slug === slug).name });
      process.stdout.write('.');
    } catch (e) {
      errors.push({ id: p.id, title, error: e.response?.data?.message || e.message });
      process.stdout.write('X');
    }
  }
  console.log('\n');

  console.log('\n== ASSIGNMENT REPORT ==');
  report.forEach(r => console.log(`[${r.category}] ${r.id} — ${r.title}`));

  if (uncategorized.length) {
    console.log('\n== UNCATEGORIZED (no assignment mapped) ==');
    uncategorized.forEach(p => console.log(p.id, '|', p.title.rendered));
  }
  if (errors.length) {
    console.log('\n== ERRORS ==');
    errors.forEach(e => console.log(e.id, '|', e.title, '|', e.error));
  }
  console.log(`\nDone. ${report.length} assigned, ${uncategorized.length} unmapped, ${errors.length} errors.`);
})().catch(e => { console.error('FATAL:', e.response?.data || e.message); process.exit(1); });
