#!/usr/bin/env python3
"""Build design/bromar-homepage.html: inline design/assets images and videos into the template."""
import base64
import pathlib
import re

ROOT = pathlib.Path(__file__).resolve().parent.parent
ASSETS = ROOT / "design" / "assets"
MIME = {"webp": "image/webp", "mp4": "video/mp4", "webm": "video/webm", "jpg": "image/jpeg", "png": "image/png"}
html = (ROOT / "design" / "src" / "homepage.template.html").read_text(encoding="utf-8")
html = re.sub(
    r"%%IMG:([\w.-]+)%%",
    lambda m: f"data:{MIME[m.group(1).rsplit('.', 1)[1]]};base64," + base64.b64encode((ASSETS / m.group(1)).read_bytes()).decode(),
    html,
)
out = ROOT / "design" / "bromar-homepage.html"
out.write_text(html, encoding="utf-8")
print(out, len(html) // 1024, "KB")
