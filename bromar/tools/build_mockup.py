#!/usr/bin/env python3
"""Build design/bromar-homepage.html: inline design/assets images into the template."""
import base64
import pathlib
import re

ROOT = pathlib.Path(__file__).resolve().parent.parent
ASSETS = ROOT / "design" / "assets"
html = (ROOT / "design" / "src" / "homepage.template.html").read_text(encoding="utf-8")
html = re.sub(
    r"%%IMG:([\w.-]+)%%",
    lambda m: "data:image/webp;base64," + base64.b64encode((ASSETS / m.group(1)).read_bytes()).decode(),
    html,
)
out = ROOT / "design" / "bromar-homepage.html"
out.write_text(html, encoding="utf-8")
print(out, len(html) // 1024, "KB")
