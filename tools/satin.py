import numpy as np
from PIL import Image, ImageFilter
import sys

def satin(W, H, seed, base, hi, lo, angle=0.5, out='satin.jpg'):
    rng = np.random.default_rng(seed)
    y, x = np.mgrid[0:H, 0:W].astype(np.float32)
    x /= W; y /= W
    # low-freq warp
    def smooth_noise(scale, amp):
        n = rng.standard_normal((int(H / scale) + 3, int(W / scale) + 3)).astype(np.float32)
        im = Image.fromarray(n).resize((W, H), Image.BICUBIC)
        return np.asarray(im) * amp
    wx = smooth_noise(480, 0.035)
    wy = smooth_noise(480, 0.035)
    u = (x + wx) * np.cos(angle) + (y + wy) * np.sin(angle)
    v = -(x + wx) * np.sin(angle) + (y + wy) * np.cos(angle)
    h = np.zeros_like(u)
    for k, (f, a, ph) in enumerate([(3.2, 1.0, 0.3), (5.3, 0.35, 1.7), (1.7, 0.7, 0.8)]):
        h += a * np.sin(2 * np.pi * f * u + ph + 1.3 * np.sin(2 * np.pi * (0.5 + 0.2 * k) * v + k))
    gy, gx = np.gradient(h)
    s = 42.0
    n = np.dstack([-gx * s, -gy * s, np.ones_like(h)])
    n /= np.linalg.norm(n, axis=2, keepdims=True)
    L = np.array([-0.45, -0.55, 0.7]); L /= np.linalg.norm(L)
    V = np.array([0, 0, 1.0]); Hh = (L + V); Hh /= np.linalg.norm(Hh)
    diff = np.clip((n * L).sum(2), 0, 1)
    spec = np.clip((n * Hh).sum(2), 0, 1) ** 30
    sheen = np.clip((n * Hh).sum(2), 0, 1) ** 5
    base, hi, lo = [np.array(c, np.float32) / 255 for c in (base, hi, lo)]
    t = diff[..., None]
    col = lo * (1 - t) + base * t
    col = col + (hi - col) * (0.55 * sheen[..., None]) + 0.22 * spec[..., None]
    # vignette + soft light from top-left
    vig = 1 - 0.18 * (((x - 0.45) ** 2 + ((y - 0.25) * 1.4) ** 2) ** 0.5)
    col *= vig[..., None]
    img = Image.fromarray((np.clip(col, 0, 1) * 255).astype(np.uint8))
    img = img.filter(ImageFilter.GaussianBlur(0.6))
    img.save(out, quality=86, optimize=True, progressive=True)

satin(1920, 1080, 3, (238, 226, 206), (255, 250, 240), (196, 176, 146), 0.55, 'satin-cream.jpg')
satin(1920, 1080, 11, (229, 207, 170), (255, 243, 222), (170, 138, 96), -0.4, 'satin-champagne.jpg')
satin(1920, 1080, 7, (44, 37, 30), (150, 128, 98), (14, 11, 9), 0.9, 'satin-ink.jpg')
