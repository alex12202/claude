(() => {
  const $ = (s, r = document) => r.querySelector(s), $$ = (s, r = document) => [...r.querySelectorAll(s)];
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const onLoad = (fn) => document.readyState === 'complete' ? fn() : addEventListener('load', fn, { once: true });

  /* ---- header ---- */
  const hdr = $('#hdr'), mcta = $('#mcta');
  const onScrollHdr = () => { const y = scrollY; hdr.classList.toggle('solid', y > 40); mcta.classList.toggle('show', y > innerHeight * .7); };
  addEventListener('scroll', onScrollHdr, { passive: true }); onScrollHdr();
  const drawer = $('#drawer');
  $('#burger').onclick = () => drawer.classList.add('open');
  $('#drawerX').onclick = () => drawer.classList.remove('open');
  $$('#drawer a').forEach(a => a.addEventListener('click', () => drawer.classList.remove('open')));

  /* ---- links to the page we are already on ---- */
  const here = location.pathname.split('/').pop() || 'index.html';
  $$('a.link').forEach(a => { if (a.getAttribute('href') === here) a.remove(); });

  /* ---- headings split into words ---- */
  $$('[data-split]').forEach(h => {
    const walk = (node, em) => [...node.childNodes].map(n => n.nodeType === 3
      ? n.textContent.split(/(\s+)/).map(w => w.trim() ? `<span class="w"><span>${em ? '<em>' + w + '</em>' : w}</span></span>` : w).join('')
      : walk(n, true)).join('');
    h.innerHTML = walk(h, false);
    $$('.w > span', h).forEach((s, i) => s.style.transitionDelay = (i * 0.07) + 's');
  });

  /* ---- "venetian blind" slats (hero slider and subpage images) ---- */
  const N = 14;
  const fillBlinds = (el) => { for (let i = 0; i < N; i++) { const s = document.createElement('i'); s.style.setProperty('--d', (i * 28) + 'ms'); el.appendChild(s); } };
  $$('[data-reveal]').forEach(b => { fillBlinds(b); onLoad(() => setTimeout(() => b.classList.remove('closed'), reduce ? 0 : 350)); });

  /* ---- homepage hero slider ---- */
  const blinds = $('#blinds');
  if (blinds) {
    const slides = $$('.slide'), texts = $$('.hero-text'), dots = $$('.hn'), DUR = 7000;
    fillBlinds(blinds);
    let cur = 0, timer, busy = false;
    const show = (i) => {
      slides.forEach((s, k) => s.classList.toggle('active', k === i));
      texts.forEach((t, k) => { t.classList.toggle('active', k === i); t.classList.remove('in'); });
      dots.forEach((d, k) => { d.classList.toggle('active', k === i); d.style.setProperty('--dur', DUR + 'ms'); });
      requestAnimationFrame(() => requestAnimationFrame(() => texts[i].classList.add('in')));
      cur = i;
    };
    const open = () => blinds.classList.remove('closed');
    const schedule = () => { clearTimeout(timer); timer = setTimeout(() => go((cur + 1) % slides.length), DUR); };
    const go = (i) => {
      if (busy || i === cur) return; busy = true; clearTimeout(timer);
      dots.forEach(d => d.classList.remove('active'));
      if (reduce) { show(i); busy = false; schedule(); return; }
      blinds.classList.add('reset'); blinds.classList.remove('closed');
      void blinds.offsetWidth; blinds.classList.remove('reset');
      blinds.classList.add('closed');
      setTimeout(() => { slides.forEach(s => s.style.transition = 'none'); show(i); setTimeout(() => { open(); slides.forEach(s => s.style.transition = ''); busy = false; schedule(); }, 120); }, 560 + N * 28);
    };
    dots.forEach((d, k) => d.onclick = () => go(k));
    $('#next').onclick = () => go((cur + 1) % slides.length);
    $('#prev').onclick = () => go((cur - 1 + slides.length) % slides.length);
    show(0);
    onLoad(() => { setTimeout(open, reduce ? 0 : 450); schedule(); });
    const scSl = $('#scSl'), scPct = $('#scPct');
    $$('.sc-bar button').forEach(b => b.onclick = () => { scSl.style.setProperty('--p', b.dataset.p + '%'); scPct.textContent = b.dataset.p + ' %'; });
  }

  /* ---- reveal on scroll ---- */
  const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }), { threshold: .14, rootMargin: '0px 0px -40px 0px' });
  $$('.rv,.rv-img').forEach(el => io.observe(el));

  /* ---- interactive window with exterior blinds ---- */
  const win = $('#win');
  if (win) {
    const slats = $('#slats'), tilt = $('#tilt');
    for (let i = 0; i < 26; i++) slats.appendChild(document.createElement('i'));
    const setTilt = (v) => {
      v = +v; win.style.setProperty('--tilt', v + 'deg'); tilt.value = v; tilt.style.setProperty('--v', (v / 85 * 100) + '%');
      $('#tiltOut').textContent = v + '°';
      const drop = parseFloat(getComputedStyle(win).getPropertyValue('--drop')) || 0;
      const cover = drop / 100 * (0.25 + 0.75 * Math.sin(v * Math.PI / 180));
      win.style.setProperty('--dark', (0.05 + cover * 0.55).toFixed(2));
      $('#lightOut').textContent = v < 25 ? 'veľa' : v < 60 ? 'stredne' : 'málo';
      $('#viewOut').textContent = v < 25 ? 'áno' : v < 60 ? 'čiastočný' : 'zatemnené';
    };
    tilt.oninput = () => setTilt(tilt.value);
    let dropTimer;
    $$('.keys button').forEach(b => b.onclick = () => {
      if (b.dataset.drop === 'stop') { const h = slats.getBoundingClientRect().height / win.getBoundingClientRect().height * 100; win.style.setProperty('--drop', h.toFixed(1) + '%'); return; }
      win.style.setProperty('--drop', (b.dataset.drop === '0' ? 4 : 100) + '%');
      clearTimeout(dropTimer); dropTimer = setTimeout(() => setTilt(tilt.value), 2000);
    });
    $$('.pf').forEach(p => p.onclick = () => { $$('.pf').forEach(x => x.classList.toggle('on', x === p)); setTilt(p.dataset.tilt); });
    setTilt(40);
  }
  $$('.tabs button').forEach(b => b.onclick = () => {
    $$('.tabs button').forEach(x => x.classList.toggle('on', x === b));
    $$('.panel').forEach(p => p.classList.toggle('on', p.id === b.dataset.tab));
  });

  /* ---- Somfy remote demo ---- */
  const mdBlind = $('#mdBlind'), mdLed = $('#mdLed');
  $$('.situo button').forEach(b => b.onclick = () => {
    mdBlind.style.setProperty('--p', b.dataset.p + '%');
    mdLed.classList.add('on'); clearTimeout(mdLed.t); mdLed.t = setTimeout(() => mdLed.classList.remove('on'), 400);
  });

  /* ---- pergola lamellas driven by scroll ---- */
  const lamDemo = $('#lamDemo');
  let setLam = null;
  if (lamDemo) {
    const lams = $('#lams'), rays = $('#rays'), NL = 16, ns = 'http://www.w3.org/2000/svg';
    const lamEls = [], rayEls = [];
    for (let i = 0; i < NL; i++) {
      const x = 70 + i * 25.5;
      const r = document.createElementNS(ns, 'rect'); r.setAttribute('x', x - 11); r.setAttribute('y', 100); r.setAttribute('width', 22); r.setAttribute('height', 5); r.setAttribute('rx', 2.5); r.setAttribute('fill', '#e9e7e2');
      lams.appendChild(r); lamEls.push([r, x]);
      const p = document.createElementNS(ns, 'polygon'); p.setAttribute('fill', 'url(#sunray)'); rays.appendChild(p); rayEls.push([p, x]);
    }
    setLam = (deg) => {
      lamEls.forEach(([r, x]) => r.setAttribute('transform', `rotate(${-deg} ${x} 102.5)`));
      const open = Math.sin(deg * Math.PI / 180);
      rayEls.forEach(([p, x]) => { const w = 9 * open; p.setAttribute('points', `${x + 2 - w},104 ${x + 2 + w},104 ${x - 40 + w * 1.4},280 ${x - 40 - w * 1.4},280`); p.style.opacity = open; });
      $('#lamDeg').textContent = Math.round(deg) + '°';
    };
  }

  /* ---- marquee, parallax, pergola, process line: one rAF loop ---- */
  const steps = $('#steps'), stepEls = $$('.step'), marq = $('#marq'), pars = $$('[data-par] img');
  const loop = () => {
    const vh = innerHeight, y = scrollY;
    if (marq) marq.style.transform = `translate3d(${-(y * 0.35) % (marq.scrollWidth / 2)}px,0,0)`;
    if (!reduce) pars.forEach(img => { const r = img.parentElement.getBoundingClientRect(); if (r.bottom < 0 || r.top > vh) return; const p = (r.top + r.height / 2 - vh / 2) / vh; img.style.transform = `translate3d(0,${(-8 + p * -10).toFixed(2)}%,0)`; });
    if (setLam) { const lr = lamDemo.getBoundingClientRect(); const lp = Math.min(1, Math.max(0, (vh - lr.top) / (vh + lr.height * .2))); setLam(Math.min(90, lp * 110)); }
    if (steps) { const sr = steps.getBoundingClientRect(); const sp = Math.min(1, Math.max(0, (vh * .75 - sr.top) / (sr.height + vh * .2))); steps.style.setProperty('--p', sp.toFixed(3)); stepEls.forEach((s, i) => s.classList.toggle('lit', sp >= i / (stepEls.length - 1) - .02)); }
    requestAnimationFrame(loop);
  };
  requestAnimationFrame(loop);

  /* ---- smooth inertial wheel scrolling (desktop) ---- */
  if (!reduce && matchMedia('(pointer:fine)').matches) {
    let target = scrollY, curY = scrollY, running = false;
    const max = () => document.documentElement.scrollHeight - innerHeight;
    const step = () => { curY += (target - curY) * 0.1; if (Math.abs(target - curY) < 0.5) { curY = target; running = false; } scrollTo(0, curY); if (running) requestAnimationFrame(step); };
    addEventListener('wheel', e => {
      if (e.ctrlKey || e.target.closest('.mega,textarea,.spec-wrap')) return;
      e.preventDefault();
      if (!running) { curY = target = scrollY; }
      target = Math.max(0, Math.min(max(), target + e.deltaY * (e.deltaMode === 1 ? 40 : 1)));
      if (!running) { running = true; requestAnimationFrame(step); }
    }, { passive: false });
    addEventListener('scroll', () => { if (!running) target = curY = scrollY; }, { passive: true });
    $$('a[href^="#"]').forEach(a => a.addEventListener('click', e => {
      const id = a.getAttribute('href'); const el = id.length > 1 && $(id); if (!el && id !== '#top') return;
      e.preventDefault(); curY = scrollY; target = id === '#top' ? 0 : Math.min(max(), el.getBoundingClientRect().top + scrollY - 70);
      if (!running) { running = true; requestAnimationFrame(step); }
    }));
  }

  /* ---- gallery lightbox ---- */
  const lb = $('#lb');
  $$('.gal figure:not(.gv), .pgal figure:not(.gv)').forEach(f => f.onclick = () => { lb.firstElementChild.src = $('img', f).src; lb.classList.add('on'); });
  lb.onclick = () => lb.classList.remove('on');
  addEventListener('keydown', e => { if (e.key === 'Escape') { lb.classList.remove('on'); drawer.classList.remove('open'); } });

  /* ---- lead form (demo): preselect the product of this page ---- */
  const form = $('#leadForm'), product = document.body.dataset.product;
  if (product) $$('input[name=p]', form).forEach(i => i.checked = i.value === product);
  form.addEventListener('submit', e => {
    e.preventDefault();
    const bad = [...form.querySelectorAll('[required]')].find(i => i.type === 'checkbox' ? !i.checked : !i.value.trim());
    if (bad) { bad.focus(); (bad.closest('.fl') || bad).animate([{ transform: 'translateX(0)' }, { transform: 'translateX(-6px)' }, { transform: 'translateX(6px)' }, { transform: 'translateX(0)' }], { duration: 300 }); return; }
    form.classList.add('done');
  });
})();
