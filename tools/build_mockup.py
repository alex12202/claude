#!/usr/bin/env python3
"""Build design/danora-homepage.html: inline logos and design/assets images into the template."""
import base64
import io
import pathlib
import re

from PIL import Image

ROOT = pathlib.Path(__file__).resolve().parent.parent
IMG = ROOT / "danora-child" / "assets" / "img"


def data_uri(name, max_side):
    im = Image.open(IMG / name)
    im.thumbnail((max_side, max_side))
    buf = io.BytesIO()
    im.save(buf, "WEBP", quality=88, method=6)
    return "data:image/webp;base64," + base64.b64encode(buf.getvalue()).decode()


DIVIDER = (
    '<svg class="divider" viewBox="0 0 120 12" aria-hidden="true">'
    '<line x1="0" y1="6" x2="50" y2="6" stroke-width="1"/>'
    '<path class="fill" d="M60 0 L64 6 L60 12 L56 6 Z"/>'
    '<line x1="70" y1="6" x2="120" y2="6" stroke-width="1"/></svg>'
)

html = (ROOT / "design" / "src" / "homepage.template.html").read_text(encoding="utf-8")
ASSETS = ROOT / "design" / "assets"
html = re.sub(
    r"%%IMG:([\w.-]+)%%",
    lambda m: "data:image/webp;base64," + base64.b64encode((ASSETS / m.group(1)).read_bytes()).decode(),
    html,
)
html = (
    html.replace("%%NAME%%", data_uri("danora-name.png", 420))
    .replace("%%FULL%%", data_uri("danora-logo-full.png", 380))
    .replace("%%DIVIDER%%", DIVIDER)
)
out = ROOT / "design" / "danora-homepage.html"
out.write_text(html, encoding="utf-8")
print(out, len(html) // 1024, "KB")
