#!/usr/bin/env python3
"""Convert PNG renders (from render.mjs) into the WebP images used by the mockup.

Usage: python3 tools/build_assets.py <render-dir>
"""
import pathlib
import sys

from PIL import Image

ROOT = pathlib.Path(__file__).resolve().parent.parent
OUT = ROOT / "design" / "assets"
SRC = pathlib.Path(sys.argv[1] if len(sys.argv) > 1 else "out")

# name: (source png, output size, crop centre x/y as 0..1, quality)
JOBS = {
    "hero-house.webp": ("house-heroR-dusk.png", (1920, 1080), (0.5, 0.5), 76),
    "hero-pergola.webp": ("pergola-hero-day.png", (1920, 1080), (0.5, 0.5), 76),
    "hero-screen.webp": ("screen-hero-day.png", (1920, 1080), (0.5, 0.5), 76),
    "hero-interior.webp": ("interior-hero-day.png", (1920, 1080), (0.5, 0.5), 76),
    "perg-dusk.webp": ("pergola-hero-dusk.png", (1920, 1080), (0.5, 0.5), 76),
    "card-blinds.webp": ("house-hero-day.png", (960, 720), (0.48, 0.42), 80),
    "card-screen.webp": ("screen-hero-day.png", (960, 720), (0.42, 0.5), 80),
    "card-roller.webp": ("roller-hero-day.png", (960, 720), (0.45, 0.5), 80),
    "card-pergola.webp": ("pergola-hero-day.png", (960, 720), (0.5, 0.55), 80),
    "card-interior.webp": ("interior-hero-day.png", (960, 720), (0.55, 0.5), 80),
    "card-service.webp": ("service-hero-day.png", (960, 720), (0.55, 0.5), 80),
    "card-screen-tall.webp": ("screen-hero-day.png", (1000, 1040), (0.4, 0.5), 80),
    "card-roller-tall.webp": ("roller-hero-day.png", (1000, 1040), (0.45, 0.5), 80),
    "card-service-tall.webp": ("service-hero-day.png", (1000, 1040), (0.6, 0.5), 80),
    "blinds-detail.webp": ("house-detail-day.png", (1200, 750), (0.5, 0.5), 80),
    "view-garden.webp": ("pergola-fromHouse-day.png", (900, 968), (0.5, 0.5), 80),
}


def cover(im, size, centre):
    tw, th = size
    scale = max(tw / im.width, th / im.height)
    # zoom a bit on small crops so the subject fills the frame
    w, h = round(im.width * scale), round(im.height * scale)
    im = im.resize((w, h), Image.LANCZOS)
    cx, cy = centre
    x = min(max(0, round(cx * w - tw / 2)), w - tw)
    y = min(max(0, round(cy * h - th / 2)), h - th)
    return im.crop((x, y, x + tw, y + th))


OUT.mkdir(parents=True, exist_ok=True)
for name, (src, size, centre, q) in JOBS.items():
    im = Image.open(SRC / src).convert("RGB")
    cover(im, size, centre).save(OUT / name, "WEBP", quality=q, method=6)
    print(f"{name:26s} {(OUT / name).stat().st_size // 1024:4d} KB")
