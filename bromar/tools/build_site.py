#!/usr/bin/env python3
"""Build the BROMAR site mockup (homepage + product subpages) into design/site/.

Pages live in design/src/pages/*.html and start with a meta comment:
    <!--page title="..." description="..." -->
Inside pages and sections:
    {{> partials/header}}   include design/src/partials/header.html (recursive)
    %%IMG:name.webp%%       reference design/assets/name.webp (copied to site/assets/)
The result is a plain multi-page static site: open design/site/index.html.
"""
import pathlib
import re
import shutil

ROOT = pathlib.Path(__file__).resolve().parent.parent
SRC = ROOT / "design" / "src"
ASSETS = ROOT / "design" / "assets"
OUT = ROOT / "design" / "site"

HEAD = """<!doctype html>
<html lang="sk">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{title}</title>
<meta name="description" content="{description}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Stack+Sans+Headline:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body class="{body}" data-product="{product}">
"""
TAIL = """<script src="main.js"></script>
</body>
</html>
"""

used = set()


def expand(text, depth=0):
    if depth > 8:
        raise RuntimeError("include loop")
    text = re.sub(r"\{\{>\s*([\w/-]+)\s*\}\}", lambda m: expand((SRC / f"{m.group(1)}.html").read_text(encoding="utf-8"), depth + 1), text)

    def img(m):
        used.add(m.group(1))
        return f"assets/{m.group(1)}"

    return re.sub(r"%%IMG:([\w.-]+)%%", img, text)


import runpy
runpy.run_path(str(SRC / "subpages.py"))

if OUT.exists():
    shutil.rmtree(OUT)
(OUT / "assets").mkdir(parents=True)
for page in sorted((SRC / "pages").glob("*.html")):
    raw = page.read_text(encoding="utf-8")
    meta = dict(re.findall(r'(\w+)="([^"]*)"', re.match(r"<!--page(.*?)-->", raw, re.S).group(1)))
    body = re.sub(r"^<!--page.*?-->\s*", "", raw, flags=re.S)
    html = HEAD.format(title=meta["title"], description=meta.get("description", ""), body=meta.get("body", "sub"), product=meta.get("product", ""))
    html += expand("{{> partials/sprite}}\n{{> partials/header}}\n<main id=\"top\">\n" + body + "</main>\n{{> partials/footer}}\n") + TAIL
    (OUT / page.name).write_text(html, encoding="utf-8")
    print(f"{page.name:18s} {len(html) // 1024:4d} KB")
for f in ("style.css", "main.js"):
    shutil.copy(SRC / f, OUT / f)
for name in sorted(used):
    shutil.copy(ASSETS / name, OUT / "assets" / name)
size = sum(p.stat().st_size for p in OUT.rglob("*") if p.is_file())
print(f"{len(used)} assets, site total {size // 1024} KB -> {OUT}")
