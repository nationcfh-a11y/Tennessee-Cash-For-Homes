"""Add the approved city-page links from city-links.json to live blog posts.

Dry run by default: prints each change. With --apply, saves every post's raw
content to backups/<id>.html first, then updates it through /wp/v2/posts.

Each link goes on the FIRST mention of its anchor text inside a <p> or <li>
that is not already in a link, heading, caption, or script. If that text is
no longer in the post, the row is skipped and reported, never guessed.

Rows with "find"/"replace" change an existing link instead. The find text must
appear exactly once in the post (or at least once when the row sets "all"),
or the row is skipped.

usage: python3 apply_city_links.py [--apply] [--only POST_ID ...]
"""
import argparse, base64, json, os, re, urllib.error, urllib.request

HERE = os.path.dirname(os.path.abspath(__file__))
TOK = re.compile(r'(<!--.*?-->|<[^>]+>)', re.S)
SKIP = {'a', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'script', 'style', 'figcaption', 'button', 'figure', 'summary'}
VOID = {'br', 'img', 'hr', 'input', 'meta', 'link', 'source'}


def load_env():
    env = {}
    for line in open(os.path.join(HERE, '..', '.env')):
        if '=' in line and not line.startswith('#'):
            k, v = line.strip().split('=', 1)
            env[k] = v
    return env


def api(base, auth, path, data=None):
    req = urllib.request.Request(base + path, headers={'Authorization': 'Basic ' + auth, 'User-Agent': 'Mozilla/5.0',
                                                       'Content-Type': 'application/json'},
                                 data=json.dumps(data).encode() if data is not None else None,
                                 method='POST' if data is not None else 'GET')
    return json.load(urllib.request.urlopen(req))


def first_eligible(raw, anchor):
    """Offset of the first eligible occurrence of anchor, or None."""
    stack, pos = [], 0
    rx = re.compile(r'\b' + re.escape(anchor) + r'\b')
    for part in TOK.split(raw):
        if part.startswith('<'):
            m = re.match(r'<(/?)([a-zA-Z0-9]+)', part)
            if m and not part.startswith('<!--'):
                tag = m.group(2).lower()
                if m.group(1):
                    if tag in stack:
                        while stack and stack.pop() != tag:
                            pass
                elif not part.endswith('/>') and tag not in VOID:
                    stack.append(tag)
        elif not any(t in SKIP for t in stack) and any(t in ('p', 'li') for t in stack):
            m = rx.search(part)
            if m:
                return pos + m.start()
        pos += len(part)
    return None


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('--apply', action='store_true')
    ap.add_argument('--only', nargs='*', type=int)
    args = ap.parse_args()

    env = load_env()
    # WP_URL may redirect (www -> non-www); a POST to the redirecting host loses its body.
    base = urllib.request.urlopen(urllib.request.Request(env['WP_URL'].rstrip('/') + '/wp-json/', method='HEAD')).geturl()
    base = base.rstrip('/').removesuffix('/wp-json')
    auth = base64.b64encode(f"{env['WP_USERNAME']}:{env['WP_APP_PASSWORD']}".encode()).decode()

    plan = json.load(open(os.path.join(HERE, 'city-links.json')))
    by_post = {}
    for row in plan:
        if not args.only or row['post_id'] in args.only:
            by_post.setdefault(row['post_id'], []).append(row)

    os.makedirs(os.path.join(HERE, 'backups'), exist_ok=True)
    done = skipped = 0
    for pid, rows in by_post.items():
        post = api(base, auth, f'/wp-json/wp/v2/posts/{pid}?context=edit&_fields=id,link,content')
        raw = new = post['content']['raw']
        # New links first, so a link that a replace row creates can't block one.
        for row in sorted(rows, key=lambda r: 'find' in r):
            if 'find' in row:
                count = new.count(row['find'])
                if count == 0 or (count > 1 and not row.get('all')):
                    print(f'  MISS  #{pid} {row["note"]}: expected text found {count} times; left alone')
                    skipped += 1
                    continue
                new = new.replace(row['find'], row['replace'])
                print(f'  edit  #{pid} {row["note"]}' + (f' x{count}' if count > 1 else ''))
                done += 1
                continue
            if f'href="{row["href"]}"' in new:
                print(f'  skip  #{pid} already links {row["href"]}')
                skipped += 1
                continue
            at = first_eligible(new, row['anchor'])
            if at is None:
                print(f'  MISS  #{pid} "{row["anchor"]}" not found as plain text; left alone')
                skipped += 1
                continue
            end = at + len(row['anchor'])
            new = f'{new[:at]}<a href="{row["href"]}">{new[at:end]}</a>{new[end:]}'
            print(f'  link  #{pid} "{row["anchor"]}" -> {row["href"]}')
            done += 1
        if new != raw and args.apply:
            with open(os.path.join(HERE, 'backups', f'{pid}.html'), 'w') as f:
                f.write(raw)
            api(base, auth, f'/wp-json/wp/v2/posts/{pid}', {'content': new})
            print(f'  saved #{pid} {post["link"]}')
    print(f'\n{done} links {"applied" if args.apply else "would be applied (dry run)"}, {skipped} skipped')


if __name__ == '__main__':
    main()
