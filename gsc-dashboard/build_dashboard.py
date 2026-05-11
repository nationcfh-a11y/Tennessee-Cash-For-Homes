"""
Reads data/gsc_data.json and emits dashboard.html — a self-contained
dashboard with summary cards, position-bucket breakdown, charts, and
sortable keyword table.
"""

import json
from pathlib import Path

HERE = Path(__file__).parent
DATA = HERE / "data" / "gsc_data.json"
OUT = HERE / "dashboard.html"


def bucket(pos):
    if pos <= 10:
        return "1-10"
    if pos <= 20:
        return "11-20"
    return "20+"


def main():
    payload = json.loads(DATA.read_text())
    queries = payload["queries"]
    pages = payload["pages"]
    daily = payload["daily"]
    site = payload["site"]
    start = payload["startDate"]
    end = payload["endDate"]

    total_clicks = sum(r["clicks"] for r in queries)
    total_impr = sum(r["impressions"] for r in queries)
    avg_ctr = (total_clicks / total_impr * 100) if total_impr else 0.0
    avg_pos = (
        sum(r["position"] * r["impressions"] for r in queries) / total_impr
        if total_impr
        else 0.0
    )

    buckets = {"1-10": [], "11-20": [], "20+": []}
    for r in queries:
        buckets[bucket(r["position"])].append(r)

    for b in buckets.values():
        b.sort(key=lambda r: r["impressions"], reverse=True)

    top_by_clicks = sorted(queries, key=lambda r: r["clicks"], reverse=True)[:25]
    top_opportunities = sorted(
        [r for r in queries if 5 <= r["position"] <= 20 and r["impressions"] >= 50],
        key=lambda r: r["impressions"],
        reverse=True,
    )[:20]

    top_pages = sorted(pages, key=lambda r: r["clicks"], reverse=True)[:15]

    chart_data = {
        "bucketCounts": {k: len(v) for k, v in buckets.items()},
        "bucketClicks": {k: sum(r["clicks"] for r in v) for k, v in buckets.items()},
        "bucketImpressions": {
            k: sum(r["impressions"] for r in v) for k, v in buckets.items()
        },
        "daily": [
            {
                "date": r["keys"][0],
                "clicks": r["clicks"],
                "impressions": r["impressions"],
                "position": r["position"],
            }
            for r in daily
        ],
        "allKeywords": [
            {
                "query": r["keys"][0],
                "clicks": r["clicks"],
                "impressions": r["impressions"],
                "ctr": r["ctr"] * 100,
                "position": r["position"],
            }
            for r in queries
        ],
    }

    html = TEMPLATE.format(
        site=site,
        start=start,
        end=end,
        total_clicks=f"{total_clicks:,}",
        total_impr=f"{total_impr:,}",
        avg_ctr=f"{avg_ctr:.2f}%",
        avg_pos=f"{avg_pos:.1f}",
        total_keywords=f"{len(queries):,}",
        bucket_1_10=len(buckets["1-10"]),
        bucket_11_20=len(buckets["11-20"]),
        bucket_20=len(buckets["20+"]),
        top_by_clicks_rows=render_rows(top_by_clicks),
        opportunity_rows=render_rows(top_opportunities),
        bucket_1_10_rows=render_rows(buckets["1-10"][:25]),
        bucket_11_20_rows=render_rows(buckets["11-20"][:25]),
        bucket_20_rows=render_rows(buckets["20+"][:25]),
        top_pages_rows=render_page_rows(top_pages),
        chart_data=json.dumps(chart_data),
    )
    OUT.write_text(html)
    print(f"Wrote {OUT}")


def esc(s):
    return (
        s.replace("&", "&amp;")
        .replace("<", "&lt;")
        .replace(">", "&gt;")
        .replace('"', "&quot;")
    )


def render_rows(rows):
    out = []
    for r in rows:
        q = esc(r["keys"][0])
        clicks = f"{r['clicks']:,}"
        impr = f"{r['impressions']:,}"
        ctr = f"{r['ctr'] * 100:.2f}%"
        pos = f"{r['position']:.1f}"
        pos_class = (
            "pos-top" if r["position"] <= 10
            else "pos-mid" if r["position"] <= 20
            else "pos-low"
        )
        out.append(
            f"<tr><td class='kw'>{q}</td>"
            f"<td class='num'>{clicks}</td>"
            f"<td class='num'>{impr}</td>"
            f"<td class='num'>{ctr}</td>"
            f"<td class='num {pos_class}'>{pos}</td></tr>"
        )
    return "\n".join(out)


def render_page_rows(rows):
    out = []
    for r in rows:
        url = esc(r["keys"][0])
        short = url.replace("https://tennesseecashforhomes.com", "") or "/"
        clicks = f"{r['clicks']:,}"
        impr = f"{r['impressions']:,}"
        ctr = f"{r['ctr'] * 100:.2f}%"
        pos = f"{r['position']:.1f}"
        out.append(
            f"<tr><td class='kw'><a href='{url}' target='_blank'>{esc(short)}</a></td>"
            f"<td class='num'>{clicks}</td>"
            f"<td class='num'>{impr}</td>"
            f"<td class='num'>{ctr}</td>"
            f"<td class='num'>{pos}</td></tr>"
        )
    return "\n".join(out)


TEMPLATE = r"""<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GSC Dashboard — tennesseecashforhomes.com</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
  :root {{
    --bg: #0f1419;
    --panel: #1a212b;
    --panel2: #222b37;
    --border: #2a3441;
    --text: #e6edf3;
    --muted: #8b949e;
    --accent: #3b82f6;
    --green: #22c55e;
    --amber: #f59e0b;
    --red: #ef4444;
  }}
  * {{ box-sizing: border-box; }}
  body {{
    margin: 0; background: var(--bg); color: var(--text);
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
    font-size: 14px; line-height: 1.5;
  }}
  .container {{ max-width: 1400px; margin: 0 auto; padding: 32px 24px; }}
  header {{ margin-bottom: 32px; }}
  header h1 {{ margin: 0 0 4px; font-size: 24px; font-weight: 600; }}
  header .meta {{ color: var(--muted); font-size: 13px; }}
  .cards {{ display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 32px; }}
  .card {{ background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 18px; }}
  .card .label {{ color: var(--muted); font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }}
  .card .value {{ font-size: 28px; font-weight: 600; }}
  .buckets {{ display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }}
  .bucket-card {{ background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 20px; border-left: 4px solid; }}
  .bucket-card.top {{ border-left-color: var(--green); }}
  .bucket-card.mid {{ border-left-color: var(--amber); }}
  .bucket-card.low {{ border-left-color: var(--red); }}
  .bucket-card .title {{ font-size: 13px; color: var(--muted); margin-bottom: 8px; }}
  .bucket-card .count {{ font-size: 32px; font-weight: 700; }}
  .bucket-card .sub {{ font-size: 12px; color: var(--muted); margin-top: 4px; }}
  .charts {{ display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 32px; }}
  .chart-box {{ background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 20px; }}
  .chart-box h3 {{ margin: 0 0 16px; font-size: 14px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; }}
  .section {{ background: var(--panel); border: 1px solid var(--border); border-radius: 10px; margin-bottom: 24px; overflow: hidden; }}
  .section h2 {{ margin: 0; padding: 16px 20px; font-size: 15px; font-weight: 600; border-bottom: 1px solid var(--border); background: var(--panel2); }}
  .section h2 .desc {{ font-weight: 400; color: var(--muted); font-size: 13px; margin-left: 8px; }}
  table {{ width: 100%; border-collapse: collapse; }}
  th, td {{ padding: 10px 16px; text-align: left; border-bottom: 1px solid var(--border); }}
  th {{ background: var(--panel2); color: var(--muted); font-weight: 500; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer; user-select: none; }}
  th:hover {{ color: var(--text); }}
  td.num {{ text-align: right; font-variant-numeric: tabular-nums; }}
  td.kw {{ max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }}
  td.kw a {{ color: var(--accent); text-decoration: none; }}
  td.kw a:hover {{ text-decoration: underline; }}
  .pos-top {{ color: var(--green); font-weight: 600; }}
  .pos-mid {{ color: var(--amber); font-weight: 600; }}
  .pos-low {{ color: var(--red); }}
  .tabs {{ display: flex; gap: 2px; background: var(--panel2); padding: 4px; border-radius: 8px; margin-bottom: 16px; width: fit-content; }}
  .tab {{ padding: 8px 16px; border-radius: 6px; cursor: pointer; color: var(--muted); font-size: 13px; }}
  .tab.active {{ background: var(--panel); color: var(--text); }}
  .tab-content {{ display: none; }}
  .tab-content.active {{ display: block; }}
  .search-wrap {{ padding: 12px 16px; background: var(--panel2); border-bottom: 1px solid var(--border); }}
  .search-wrap input {{ background: var(--bg); border: 1px solid var(--border); color: var(--text); padding: 8px 12px; border-radius: 6px; width: 300px; font-size: 13px; }}
</style>
</head>
<body>
<div class="container">
  <header>
    <h1>Search Console Dashboard</h1>
    <div class="meta">{site} · {start} → {end}</div>
  </header>

  <div class="cards">
    <div class="card"><div class="label">Total Clicks</div><div class="value">{total_clicks}</div></div>
    <div class="card"><div class="label">Impressions</div><div class="value">{total_impr}</div></div>
    <div class="card"><div class="label">Avg CTR</div><div class="value">{avg_ctr}</div></div>
    <div class="card"><div class="label">Avg Position</div><div class="value">{avg_pos}</div></div>
    <div class="card"><div class="label">Keywords</div><div class="value">{total_keywords}</div></div>
  </div>

  <div class="buckets">
    <div class="bucket-card top">
      <div class="title">Positions 1-10 (Page 1)</div>
      <div class="count">{bucket_1_10}</div>
      <div class="sub">keywords ranking on page 1</div>
    </div>
    <div class="bucket-card mid">
      <div class="title">Positions 11-20 (Page 2)</div>
      <div class="count">{bucket_11_20}</div>
      <div class="sub">striking distance — ripe for optimization</div>
    </div>
    <div class="bucket-card low">
      <div class="title">Positions 20+</div>
      <div class="count">{bucket_20}</div>
      <div class="sub">deeper pages, needs more work</div>
    </div>
  </div>

  <div class="charts">
    <div class="chart-box">
      <h3>Clicks & Impressions Over Time</h3>
      <canvas id="dailyChart" height="100"></canvas>
    </div>
    <div class="chart-box">
      <h3>Keywords by Position Bucket</h3>
      <canvas id="bucketChart" height="200"></canvas>
    </div>
  </div>

  <div class="section">
    <h2>Striking-Distance Opportunities <span class="desc">· position 5-20, 50+ impressions — easiest wins</span></h2>
    <table>
      <thead><tr><th>Keyword</th><th class="num">Clicks</th><th class="num">Impressions</th><th class="num">CTR</th><th class="num">Position</th></tr></thead>
      <tbody>{opportunity_rows}</tbody>
    </table>
  </div>

  <div class="section">
    <h2>Top Keywords by Clicks</h2>
    <table>
      <thead><tr><th>Keyword</th><th class="num">Clicks</th><th class="num">Impressions</th><th class="num">CTR</th><th class="num">Position</th></tr></thead>
      <tbody>{top_by_clicks_rows}</tbody>
    </table>
  </div>

  <div class="section">
    <h2>Keywords by Position Bucket</h2>
    <div style="padding: 16px;">
      <div class="tabs">
        <div class="tab active" data-tab="t1">Positions 1-10</div>
        <div class="tab" data-tab="t2">Positions 11-20</div>
        <div class="tab" data-tab="t3">Positions 20+</div>
      </div>
      <div id="t1" class="tab-content active">
        <table><thead><tr><th>Keyword</th><th class="num">Clicks</th><th class="num">Impressions</th><th class="num">CTR</th><th class="num">Position</th></tr></thead>
        <tbody>{bucket_1_10_rows}</tbody></table>
      </div>
      <div id="t2" class="tab-content">
        <table><thead><tr><th>Keyword</th><th class="num">Clicks</th><th class="num">Impressions</th><th class="num">CTR</th><th class="num">Position</th></tr></thead>
        <tbody>{bucket_11_20_rows}</tbody></table>
      </div>
      <div id="t3" class="tab-content">
        <table><thead><tr><th>Keyword</th><th class="num">Clicks</th><th class="num">Impressions</th><th class="num">CTR</th><th class="num">Position</th></tr></thead>
        <tbody>{bucket_20_rows}</tbody></table>
      </div>
    </div>
  </div>

  <div class="section">
    <h2>All Keywords <span class="desc">· click column headers to sort</span></h2>
    <div class="search-wrap"><input id="kwSearch" type="text" placeholder="Filter keywords..."></div>
    <table id="allKwTable">
      <thead><tr>
        <th data-sort="query">Keyword</th>
        <th data-sort="clicks" class="num">Clicks</th>
        <th data-sort="impressions" class="num">Impressions</th>
        <th data-sort="ctr" class="num">CTR</th>
        <th data-sort="position" class="num">Position</th>
      </tr></thead>
      <tbody id="allKwBody"></tbody>
    </table>
  </div>

  <div class="section">
    <h2>Top Landing Pages</h2>
    <table>
      <thead><tr><th>Page</th><th class="num">Clicks</th><th class="num">Impressions</th><th class="num">CTR</th><th class="num">Position</th></tr></thead>
      <tbody>{top_pages_rows}</tbody>
    </table>
  </div>
</div>

<script>
const DATA = {chart_data};

// Daily chart
new Chart(document.getElementById('dailyChart'), {{
  type: 'line',
  data: {{
    labels: DATA.daily.map(d => d.date),
    datasets: [
      {{ label: 'Clicks', data: DATA.daily.map(d => d.clicks), borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.1)', yAxisID: 'y', tension: 0.3, fill: true }},
      {{ label: 'Impressions', data: DATA.daily.map(d => d.impressions), borderColor: '#8b949e', backgroundColor: 'rgba(139,148,158,0.05)', yAxisID: 'y1', tension: 0.3, fill: true }}
    ]
  }},
  options: {{
    responsive: true, interaction: {{ mode: 'index', intersect: false }},
    plugins: {{ legend: {{ labels: {{ color: '#e6edf3' }} }} }},
    scales: {{
      x: {{ ticks: {{ color: '#8b949e', maxTicksLimit: 12 }}, grid: {{ color: '#2a3441' }} }},
      y: {{ position: 'left', ticks: {{ color: '#3b82f6' }}, grid: {{ color: '#2a3441' }} }},
      y1: {{ position: 'right', ticks: {{ color: '#8b949e' }}, grid: {{ display: false }} }}
    }}
  }}
}});

// Bucket chart
new Chart(document.getElementById('bucketChart'), {{
  type: 'doughnut',
  data: {{
    labels: ['1-10', '11-20', '20+'],
    datasets: [{{
      data: [DATA.bucketCounts['1-10'], DATA.bucketCounts['11-20'], DATA.bucketCounts['20+']],
      backgroundColor: ['#22c55e', '#f59e0b', '#ef4444'],
      borderColor: '#1a212b', borderWidth: 2
    }}]
  }},
  options: {{ plugins: {{ legend: {{ labels: {{ color: '#e6edf3' }} }} }} }}
}});

// Tabs
document.querySelectorAll('.tab').forEach(t => t.addEventListener('click', () => {{
  document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(x => x.classList.remove('active'));
  t.classList.add('active');
  document.getElementById(t.dataset.tab).classList.add('active');
}}));

// All-keywords table with sort + filter
const body = document.getElementById('allKwBody');
let rows = [...DATA.allKeywords];
let sortKey = 'clicks', sortDir = -1;
function render() {{
  const filter = document.getElementById('kwSearch').value.toLowerCase();
  const sorted = rows
    .filter(r => r.query.toLowerCase().includes(filter))
    .sort((a, b) => {{
      const av = a[sortKey], bv = b[sortKey];
      return av < bv ? -sortDir : av > bv ? sortDir : 0;
    }})
    .slice(0, 500);
  body.innerHTML = sorted.map(r => {{
    const pc = r.position <= 10 ? 'pos-top' : r.position <= 20 ? 'pos-mid' : 'pos-low';
    return `<tr><td class='kw'>${{r.query}}</td>
      <td class='num'>${{r.clicks.toLocaleString()}}</td>
      <td class='num'>${{r.impressions.toLocaleString()}}</td>
      <td class='num'>${{r.ctr.toFixed(2)}}%</td>
      <td class='num ${{pc}}'>${{r.position.toFixed(1)}}</td></tr>`;
  }}).join('');
}}
document.querySelectorAll('#allKwTable th').forEach(th => th.addEventListener('click', () => {{
  const k = th.dataset.sort;
  if (sortKey === k) sortDir *= -1; else {{ sortKey = k; sortDir = k === 'query' ? 1 : -1; }}
  render();
}}));
document.getElementById('kwSearch').addEventListener('input', render);
render();
</script>
</body>
</html>
"""

if __name__ == "__main__":
    main()
