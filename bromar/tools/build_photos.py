#!/usr/bin/env python3
"""Crop real BROMAR installation photos into WebP assets for the mockup.

Usage: python3 tools/build_photos.py <photo-dir>
Videos (video-*.mp4) are trimmed/cropped separately with ffmpeg, see README.
Crops avoid car licence plates and construction mess visible in the originals.
"""
import pathlib
import sys

from PIL import Image, ImageOps

ROOT = pathlib.Path(__file__).resolve().parent.parent
OUT = ROOT / "design" / "assets"
SRC = pathlib.Path(sys.argv[1])

# name: (source, crop box in px of the original or None, max side)
JOBS = {
    "real-screen.webp": ("a3c75eab-image.jpg", None, 1600),
    "real-blinds-card.webp": ("d4e21fe4-image.jpg", (0, 520, 2048, 2056), 1000),
    "real-blinds-detail.webp": ("d4e21fe4-image.jpg", (970, 660, 1700, 1270), 1000),
    "real-rollers.webp": ("18f4f956-image.jpg", (165, 600, 1215, 1135), 1200),
    "real-interior.webp": ("18af6077-image.jpg", (0, 0, 1152, 1515), 1100),
    "real-flats.webp": ("d9ba62e4-image.jpg", (0, 0, 1152, 1262), 1100),
    "hero-real-house.webp": ("966f240d-image.jpg", (0, 400, 1536, 1264), 1920),
    "hero-real-screen.webp": ("a3c75eab-image.jpg", (0, 250, 2048, 1402), 1920),
    "hero-real-tower.webp": ("30ef2175-image.jpg", (0, 150, 2048, 1302), 1920),
    "real-terrace.webp": ("d08522e4-image.jpg", None, 1300),
    "real-terrace-card.webp": ("d08522e4-image.jpg", (0, 250, 1536, 1402), 1000),
    "real-bungalow.webp": ("966f240d-image.jpg", (0, 450, 1536, 1218), 1400),
    "real-carport.webp": ("15660e6e-image.jpg", None, 1200),
    "real-tower.webp": ("30ef2175-image.jpg", None, 1400),
}

for name, (src, box, side) in JOBS.items():
    im = ImageOps.exif_transpose(Image.open(SRC / src)).convert("RGB")
    if box:
        im = im.crop(box)
    im.thumbnail((side, side), Image.LANCZOS)
    im.save(OUT / name, "WEBP", quality=80, method=6)
    print(f"{name:26s} {im.size} {(OUT / name).stat().st_size // 1024} KB")
