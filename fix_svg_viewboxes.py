#!/usr/bin/env python3
"""
Calculate correct viewBox values for all county and city SVG maps.
Outputs a PHP include file with slug => viewBox mappings.

For county SVGs: finds the highlighted county path (fill != #e8e2b7) in statelayer
For city SVGs: finds the placelayer paths (city boundaries)
Calculates bounding box + 15% padding for each.
"""

import os
import re
import sys
import xml.etree.ElementTree as ET
import json

COUNTY_SVG_DIR = os.path.join(os.path.dirname(__file__), 'tn-cash-for-homes', 'brand_assets', 'county-svgs')
CITY_SVG_DIR = os.path.join(os.path.dirname(__file__), 'tn-cash-for-homes', 'brand_assets', 'city-svgs')
OUTPUT_PHP = os.path.join(os.path.dirname(__file__), 'tn-cash-for-homes', 'svg-viewbox-map.php')

NS = {'svg': 'http://www.w3.org/2000/svg'}
PADDING_PERCENT = 0.15  # 15% padding on all sides
ASPECT_RATIO = 4 / 3    # 4:3 aspect ratio (width:height)


def parse_path_coords(d):
    """
    Extract all coordinate points from an SVG path d attribute.
    Handles M, L, H, V, C, S, Q, T, A commands (absolute and relative).
    Returns list of (x, y) tuples representing all points the path touches.
    """
    if not d:
        return []

    coords = []
    # Tokenize: split into commands and numbers
    tokens = re.findall(r'[MmLlHhVvCcSsQqTtAaZz]|[-+]?[0-9]*\.?[0-9]+(?:[eE][-+]?[0-9]+)?', d)

    current_x, current_y = 0, 0
    start_x, start_y = 0, 0
    command = 'M'
    i = 0

    while i < len(tokens):
        token = tokens[i]

        if token.isalpha() or token == 'Z' or token == 'z':
            command = token
            i += 1
            if command in ('Z', 'z'):
                current_x, current_y = start_x, start_y
                coords.append((current_x, current_y))
                continue
        else:
            # Implicit repeat of last command (L after M, etc.)
            pass

        try:
            if command == 'M':
                x, y = float(tokens[i]), float(tokens[i + 1])
                current_x, current_y = x, y
                start_x, start_y = x, y
                coords.append((x, y))
                i += 2
                command = 'L'  # subsequent coords are lines
            elif command == 'm':
                dx, dy = float(tokens[i]), float(tokens[i + 1])
                current_x += dx
                current_y += dy
                start_x, start_y = current_x, current_y
                coords.append((current_x, current_y))
                i += 2
                command = 'l'
            elif command == 'L':
                x, y = float(tokens[i]), float(tokens[i + 1])
                current_x, current_y = x, y
                coords.append((x, y))
                i += 2
            elif command == 'l':
                dx, dy = float(tokens[i]), float(tokens[i + 1])
                current_x += dx
                current_y += dy
                coords.append((current_x, current_y))
                i += 2
            elif command == 'H':
                x = float(tokens[i])
                current_x = x
                coords.append((current_x, current_y))
                i += 1
            elif command == 'h':
                dx = float(tokens[i])
                current_x += dx
                coords.append((current_x, current_y))
                i += 1
            elif command == 'V':
                y = float(tokens[i])
                current_y = y
                coords.append((current_x, current_y))
                i += 1
            elif command == 'v':
                dy = float(tokens[i])
                current_y += dy
                coords.append((current_x, current_y))
                i += 1
            elif command == 'C':
                # Cubic bezier: 3 coordinate pairs
                for j in range(3):
                    x, y = float(tokens[i]), float(tokens[i + 1])
                    coords.append((x, y))
                    i += 2
                current_x, current_y = x, y
            elif command == 'c':
                for j in range(3):
                    dx, dy = float(tokens[i]), float(tokens[i + 1])
                    coords.append((current_x + dx, current_y + dy))
                    i += 2
                current_x += dx
                current_y += dy
            elif command == 'S':
                for j in range(2):
                    x, y = float(tokens[i]), float(tokens[i + 1])
                    coords.append((x, y))
                    i += 2
                current_x, current_y = x, y
            elif command == 's':
                for j in range(2):
                    dx, dy = float(tokens[i]), float(tokens[i + 1])
                    coords.append((current_x + dx, current_y + dy))
                    i += 2
                current_x += dx
                current_y += dy
            elif command == 'Q':
                for j in range(2):
                    x, y = float(tokens[i]), float(tokens[i + 1])
                    coords.append((x, y))
                    i += 2
                current_x, current_y = x, y
            elif command == 'q':
                for j in range(2):
                    dx, dy = float(tokens[i]), float(tokens[i + 1])
                    coords.append((current_x + dx, current_y + dy))
                    i += 2
                current_x += dx
                current_y += dy
            elif command == 'T':
                x, y = float(tokens[i]), float(tokens[i + 1])
                current_x, current_y = x, y
                coords.append((x, y))
                i += 2
            elif command == 't':
                dx, dy = float(tokens[i]), float(tokens[i + 1])
                current_x += dx
                current_y += dy
                coords.append((current_x, current_y))
                i += 2
            elif command == 'A':
                # Arc: rx ry rotation large-arc sweep x y
                i += 5  # skip rx, ry, rotation, large-arc, sweep
                x, y = float(tokens[i]), float(tokens[i + 1])
                current_x, current_y = x, y
                coords.append((x, y))
                i += 2
            elif command == 'a':
                i += 5
                dx, dy = float(tokens[i]), float(tokens[i + 1])
                current_x += dx
                current_y += dy
                coords.append((current_x, current_y))
                i += 2
            else:
                i += 1  # skip unknown
        except (IndexError, ValueError):
            i += 1

    return coords


def get_bounding_box(paths_elements):
    """Calculate bounding box from a list of SVG path elements."""
    all_coords = []
    for path_el in paths_elements:
        d = path_el.get('d', '')
        coords = parse_path_coords(d)
        all_coords.extend(coords)

    if not all_coords:
        return None

    xs = [c[0] for c in all_coords]
    ys = [c[1] for c in all_coords]

    return {
        'min_x': min(xs),
        'min_y': min(ys),
        'max_x': max(xs),
        'max_y': max(ys),
    }


def calc_viewbox_with_padding(bbox, padding_pct=PADDING_PERCENT, aspect_ratio=ASPECT_RATIO):
    """
    Calculate viewBox string from bounding box with padding and fixed aspect ratio.
    Returns "x y width height" string.
    """
    raw_w = bbox['max_x'] - bbox['min_x']
    raw_h = bbox['max_y'] - bbox['min_y']

    # Add padding
    pad_x = raw_w * padding_pct
    pad_y = raw_h * padding_pct

    x = bbox['min_x'] - pad_x
    y = bbox['min_y'] - pad_y
    w = raw_w + 2 * pad_x
    h = raw_h + 2 * pad_y

    # Enforce aspect ratio (4:3 = w/h)
    current_ratio = w / h if h > 0 else 1
    if current_ratio > aspect_ratio:
        # Too wide - increase height
        new_h = w / aspect_ratio
        y -= (new_h - h) / 2
        h = new_h
    else:
        # Too tall - increase width
        new_w = h * aspect_ratio
        x -= (new_w - w) / 2
        w = new_w

    return f"{x:.2f} {y:.2f} {w:.2f} {h:.2f}"


HIGHLIGHT_COLORS = {'#e4744f', '#e60000', '#ff0000', '#00ff00'}
BACKGROUND_COLORS = {'#e8e2b7', '#fdf9d2', '#cccccc', '#d0d0d0', '#ffffff', 'none', ''}


def find_paths_by_fill(root, target_fills):
    """Search all paths in SVG for specific fill colors (checking both attrs and inline styles)."""
    found = []
    for el in root.iter():
        tag = el.tag.split('}')[-1] if '}' in el.tag else el.tag
        if tag != 'path':
            continue
        fill = el.get('fill', '').lower().strip()
        style = el.get('style', '')
        style_fill = ''
        m = re.search(r'fill:\s*([^;]+)', style)
        if m:
            style_fill = m.group(1).strip().lower()

        if fill in target_fills or style_fill in target_fills:
            found.append(el)
    return found


def process_legacy_county_svg(root):
    """Handle legacy Inkscape-format county SVGs by finding highlighted paths."""
    # Search for paths with highlight fill colors
    highlighted = find_paths_by_fill(root, HIGHLIGHT_COLORS)

    if not highlighted:
        # Check for <use> elements with highlight fills referencing paths by ID
        for el in root.iter():
            tag = el.tag.split('}')[-1] if '}' in el.tag else el.tag
            if tag == 'use':
                fill = el.get('fill', '').lower().strip()
                if fill in HIGHLIGHT_COLORS or fill in {'#e60000'}:
                    # Find the referenced path
                    href = el.get('{http://www.w3.org/1999/xlink}href', el.get('href', ''))
                    if href and href.startswith('#'):
                        ref_id = href[1:]
                        # Find path with matching id
                        for p in root.iter():
                            if p.get('id') == ref_id:
                                ptag = p.tag.split('}')[-1] if '}' in p.tag else p.tag
                                if ptag == 'path':
                                    highlighted.append(p)
                                elif ptag == 'g':
                                    # Group - get all child paths
                                    for cp in p.iter():
                                        cptag = cp.tag.split('}')[-1] if '}' in cp.tag else cp.tag
                                        if cptag == 'path':
                                            highlighted.append(cp)
                                break

    if not highlighted:
        return None, "No highlighted paths found in legacy SVG"

    bbox = get_bounding_box(highlighted)
    if not bbox:
        return None, "Could not calculate bounding box for legacy SVG"

    viewbox = calc_viewbox_with_padding(bbox)
    return viewbox, None


def process_legacy_city_svg(root):
    """Handle legacy Inkscape-format city SVGs by finding all non-background paths."""
    # For legacy city SVGs, find paths with non-background fills
    # These typically have colored paths for highlighted areas
    highlighted = find_paths_by_fill(root, HIGHLIGHT_COLORS)

    if not highlighted:
        # Try to find any paths with fills that aren't background colors
        all_bg = BACKGROUND_COLORS
        for el in root.iter():
            tag = el.tag.split('}')[-1] if '}' in el.tag else el.tag
            if tag != 'path':
                continue
            fill = el.get('fill', '').lower().strip()
            style = el.get('style', '')
            m = re.search(r'fill:\s*([^;]+)', style)
            style_fill = m.group(1).strip().lower() if m else ''

            if (fill and fill not in all_bg) or (style_fill and style_fill not in all_bg):
                highlighted.append(el)

    if not highlighted:
        return None, "No highlighted paths found in legacy city SVG"

    bbox = get_bounding_box(highlighted)
    if not bbox:
        return None, "Could not calculate bounding box for legacy city SVG"

    viewbox = calc_viewbox_with_padding(bbox)
    return viewbox, None


def process_county_svg(filepath):
    """
    Process a county SVG: find the highlighted county path in statelayer.
    The highlighted path has fill != #e8e2b7 (the default beige).
    """
    try:
        tree = ET.parse(filepath)
        root = tree.getroot()
    except ET.ParseError as e:
        return None, f"XML parse error: {e}"

    statelayer = root.find('.//svg:g[@id="statelayer"]', NS)
    if statelayer is None:
        # Try without namespace (some SVGs may not use namespace)
        statelayer = root.find('.//*[@id="statelayer"]')

    if statelayer is None:
        # Legacy Inkscape SVGs have nested transforms making raw path coordinates
        # unreliable for viewBox calculation. Skip them - the template will render
        # them at their original size without modification.
        return None, "Legacy format (no statelayer) - will render at original size"

    # Find highlighted path(s) - fill != #e8e2b7
    highlighted = []
    default_fill = statelayer.get('fill', '#e8e2b7').lower()

    for path in statelayer.findall('svg:path', NS) or statelayer.findall('path'):
        fill = path.get('fill', '').lower()
        if fill and fill != default_fill and fill != 'inherit' and fill != 'none':
            highlighted.append(path)

    # If no explicitly highlighted paths found, try first path
    if not highlighted:
        paths = statelayer.findall('svg:path', NS) or statelayer.findall('path')
        if paths:
            # Check if first path has a different fill
            first_fill = paths[0].get('fill', '').lower()
            if first_fill and first_fill != default_fill:
                highlighted = [paths[0]]

    if not highlighted:
        return None, "No highlighted county path found in statelayer"

    bbox = get_bounding_box(highlighted)
    if not bbox:
        return None, "Could not calculate bounding box"

    viewbox = calc_viewbox_with_padding(bbox)
    return viewbox, None


def process_city_svg(filepath):
    """
    Process a city SVG: find placelayer paths for bounding box.
    Falls back to countylayer if placelayer is empty.
    """
    try:
        tree = ET.parse(filepath)
        root = tree.getroot()
    except ET.ParseError as e:
        return None, f"XML parse error: {e}"

    # Try placelayer first
    placelayer = root.find('.//svg:g[@id="placelayer"]', NS) or root.find('.//*[@id="placelayer"]')
    paths = []
    if placelayer is not None:
        paths = placelayer.findall('svg:path', NS) or placelayer.findall('path')

    # Fall back to countylayer
    if not paths:
        countylayer = root.find('.//svg:g[@id="countylayer"]', NS) or root.find('.//*[@id="countylayer"]')
        if countylayer is not None:
            paths = countylayer.findall('svg:path', NS) or countylayer.findall('path')

    if not paths:
        # Legacy format: try to find highlighted paths
        return process_legacy_city_svg(root)

    bbox = get_bounding_box(paths)
    if not bbox:
        return None, "Could not calculate bounding box"

    viewbox = calc_viewbox_with_padding(bbox)
    return viewbox, None


def main():
    county_viewboxes = {}
    city_viewboxes = {}
    errors = []

    print("=" * 60)
    print("SVG MAP VIEWBOX AUDIT & FIX")
    print("=" * 60)

    # Process county SVGs
    print("\n--- COUNTY SVGs ---")
    county_files = sorted([f for f in os.listdir(COUNTY_SVG_DIR) if f.endswith('.svg')])
    county_ok = 0
    county_fail = 0

    for fname in county_files:
        slug = fname.replace('.svg', '')
        filepath = os.path.join(COUNTY_SVG_DIR, fname)
        viewbox, error = process_county_svg(filepath)

        if viewbox:
            county_viewboxes[slug] = viewbox
            county_ok += 1
        else:
            county_fail += 1
            errors.append(f"COUNTY {slug}: {error}")
            print(f"  FAIL: {slug} - {error}")

    print(f"\n  County results: {county_ok} OK, {county_fail} failed")

    # Process city SVGs
    print("\n--- CITY SVGs ---")
    city_files = sorted([f for f in os.listdir(CITY_SVG_DIR) if f.endswith('.svg')])
    city_ok = 0
    city_fail = 0

    for fname in city_files:
        slug = fname.replace('.svg', '')
        filepath = os.path.join(CITY_SVG_DIR, fname)
        viewbox, error = process_city_svg(filepath)

        if viewbox:
            city_viewboxes[slug] = viewbox
            city_ok += 1
        else:
            city_fail += 1
            errors.append(f"CITY {slug}: {error}")
            print(f"  FAIL: {slug} - {error}")

    print(f"\n  City results: {city_ok} OK, {city_fail} failed")

    # Generate PHP output
    print(f"\n--- GENERATING PHP LOOKUP ---")
    php_lines = [
        "<?php",
        "/**",
        " * Auto-generated SVG viewBox mappings.",
        " * Each viewBox is calculated from the highlighted shape's bounding box + 15% padding,",
        " * enforcing a 4:3 aspect ratio for consistent rendering.",
        " *",
        " * Generated by fix_svg_viewboxes.py",
        " */",
        "",
        "function tcfh_get_county_viewbox( $slug ) {",
        "    $map = array(",
    ]

    for slug in sorted(county_viewboxes.keys()):
        vb = county_viewboxes[slug]
        php_lines.append(f"        '{slug}' => '{vb}',")

    php_lines.extend([
        "    );",
        "    return isset( $map[ $slug ] ) ? $map[ $slug ] : null;",
        "}",
        "",
        "function tcfh_get_city_viewbox( $slug ) {",
        "    $map = array(",
    ])

    for slug in sorted(city_viewboxes.keys()):
        vb = city_viewboxes[slug]
        php_lines.append(f"        '{slug}' => '{vb}',")

    php_lines.extend([
        "    );",
        "    return isset( $map[ $slug ] ) ? $map[ $slug ] : null;",
        "}",
    ])

    with open(OUTPUT_PHP, 'w') as f:
        f.write('\n'.join(php_lines) + '\n')

    print(f"  Written to: {OUTPUT_PHP}")
    print(f"  County entries: {len(county_viewboxes)}")
    print(f"  City entries: {len(city_viewboxes)}")

    # Summary
    print("\n" + "=" * 60)
    print("SUMMARY")
    print("=" * 60)
    print(f"Total county SVGs: {len(county_files)}")
    print(f"  Successfully processed: {county_ok}")
    print(f"  Failed (need manual review): {county_fail}")
    print(f"Total city SVGs: {len(city_files)}")
    print(f"  Successfully processed: {city_ok}")
    print(f"  Failed (need manual review): {city_fail}")

    if errors:
        print(f"\n--- ERRORS ({len(errors)}) ---")
        for e in errors:
            print(f"  {e}")

    return 0 if not errors else 1


if __name__ == '__main__':
    sys.exit(main())
