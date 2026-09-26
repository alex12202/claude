// Render scenes from render-scenes.html to PNG with headless Chromium.
// Needs `npm i three@0.170.0 playwright` in the working dir (node_modules next to the html).
// Usage: node render.mjs <outdir> scene:view:time:w:h [...]
import { chromium } from 'playwright';
import http from 'node:http';
import fs from 'node:fs';
import path from 'node:path';

const root = process.cwd();
const types = { '.html': 'text/html', '.js': 'text/javascript', '.mjs': 'text/javascript' };
const srv = http.createServer((req, res) => {
  const f = path.join(root, decodeURIComponent(req.url.split('?')[0]));
  fs.readFile(f, (e, d) => { if (e) { res.writeHead(404); res.end(); } else { res.writeHead(200, { 'content-type': types[path.extname(f)] || 'application/octet-stream' }); res.end(d); } });
}).listen(0);
const port = srv.address().port;
const [outdir, ...jobs] = process.argv.slice(2);
const browser = await chromium.launch({ args: ['--use-angle=swiftshader', '--enable-unsafe-swiftshader', '--ignore-gpu-blocklist'] });
for (const job of jobs) {
  const [scene, view = 'hero', time = 'day', w = 1600, h = 900] = job.split(':');
  const page = await browser.newPage();
  page.on('console', m => console.log('  ', m.text()));
  page.on('pageerror', e => console.log('  ERR', e.message));
  const t = Date.now();
  await page.goto(`http://127.0.0.1:${port}/render-scenes.html?scene=${scene}&view=${view}&time=${time}&w=${w}&h=${h}&ss=2`);
  await page.waitForFunction('window.done === true', null, { timeout: 600000 });
  const data = await page.evaluate(() => document.querySelector('canvas').toDataURL('image/png'));
  const name = `${scene}-${view}-${time}.png`;
  fs.writeFileSync(path.join(outdir, name), Buffer.from(data.split(',')[1], 'base64'));
  console.log(name, ((Date.now() - t) / 1000).toFixed(1) + 's');
  await page.close();
}
await browser.close(); srv.close();
