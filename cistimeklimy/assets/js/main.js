// Čistímeklimy.sk – interakcie návrhu (slider, porovnanie pred/po, menu, formulár)
(function () {
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reduceMotion && 'IntersectionObserver' in window) document.documentElement.classList.add('anim');
  // Mobilné menu
  var nav = document.querySelector('.nav');
  var toggle = document.querySelector('.menu-toggle');
  if (nav && toggle) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    nav.querySelectorAll('ul a').forEach(function (a) {
      a.addEventListener('click', function () { nav.classList.remove('open'); });
    });
  }

  // Hero slider cez celú sekciu – šikmý prechod snímok, nadpis sa mení so snímkou
  var slider = document.querySelector('[data-slider]');
  if (slider) {
    var slides = slider.querySelectorAll('.slide');
    var dotsBox = slider.querySelector('.slider-dots');
    var caption = slider.querySelector('.slide-caption');
    var title = slider.querySelector('.hero-title');
    var DUR = 6500, i = -1, timer = null;
    dotsBox.style.setProperty('--dur', DUR + 'ms');
    var dots = Array.prototype.map.call(slides, function (s, n) {
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Snímka ' + (n + 1));
      b.addEventListener('click', function () { if (n !== i) { go(n, true); restart(); } });
      dotsBox.appendChild(b);
      return b;
    });
    var setTitle = function (html) {
      if (!title || !html) return;
      var tmp = document.createElement('div'); tmp.innerHTML = html;
      var out = [], k = 0;
      tmp.childNodes.forEach(function (node) {
        var isEm = node.nodeName === 'EM';
        node.textContent.split(/(\s+)/).forEach(function (part) {
          if (!part) return;
          if (/^\s+$/.test(part)) { out.push(' '); return; }
          var w = '<span class="w"><span style="--k:' + (k++) + '">' + part + '</span></span>';
          out.push(isEm ? '<em>' + w + '</em>' : w);
        });
      });
      title.innerHTML = out.join('');
    };
    function go(n, animate) {
      var prev = i;
      i = (n + slides.length) % slides.length;
      slides.forEach(function (s, m) {
        s.classList.toggle('is-active', m === i);
        s.classList.toggle('is-prev', m === prev && prev !== i);
        s.classList.remove('wipe');
      });
      if (animate && !reduceMotion) { void slides[i].offsetWidth; slides[i].classList.add('wipe'); }
      dots.forEach(function (d, m) { if (m === i) d.setAttribute('aria-current', 'true'); else d.removeAttribute('aria-current'); });
      if (caption) caption.textContent = slides[i].getAttribute('data-caption') || '';
      if (animate) setTitle(slides[i].getAttribute('data-title'));
    }
    function restart() {
      clearInterval(timer);
      if (!reduceMotion) timer = setInterval(function () { go(i + 1, true); }, DUR);
    }
    go(0, false);
    if (!reduceMotion) setTitle(slides[0].getAttribute('data-title'));
    restart();

    // intro lamely – po otvorení ich skryť
    var louvers = slider.querySelector('.louvers');
    if (louvers) setTimeout(function () { louvers.classList.add('done'); }, 1500);

    // prúdy chladného vzduchu
    var cv = slider.querySelector('.hero-air');
    if (cv && cv.getContext && !reduceMotion) {
      var ctx = cv.getContext('2d'), W = 0, H = 0, dpr = Math.min(2, window.devicePixelRatio || 1), streaks = [], visible = true;
      var resize = function () {
        W = cv.clientWidth; H = cv.clientHeight;
        cv.width = W * dpr; cv.height = H * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      };
      var spawn = function (s, fresh) {
        s.x = fresh ? Math.random() * W : W + Math.random() * W * .3;
        s.y = Math.random() * H * .85;
        s.len = 60 + Math.random() * 160;
        s.v = .6 + Math.random() * 1.4;
        s.a = .05 + Math.random() * .12;
        s.phase = Math.random() * Math.PI * 2;
        s.amp = 6 + Math.random() * 18;
        return s;
      };
      resize();
      for (var n = 0; n < 38; n++) streaks.push(spawn({}, true));
      window.addEventListener('resize', resize);
      new IntersectionObserver(function (es) { visible = es[0].isIntersecting; }).observe(slider);
      var t = 0;
      var draw = function () {
        requestAnimationFrame(draw);
        if (!visible) return;
        t += 0.016;
        ctx.clearRect(0, 0, W, H);
        ctx.lineCap = 'round';
        streaks.forEach(function (s) {
          s.x -= s.v * 2.2; s.y += s.v * .35;
          if (s.x + s.len < 0 || s.y > H) spawn(s, false);
          ctx.beginPath();
          for (var q = 0; q <= 10; q++) {
            var px = s.x + (q / 10) * s.len;
            var py = s.y + Math.sin(px / 140 + s.phase + t) * s.amp;
            if (q === 0) ctx.moveTo(px, py); else ctx.lineTo(px, py);
          }
          var g = ctx.createLinearGradient(s.x, 0, s.x + s.len, 0);
          g.addColorStop(0, 'rgba(190,225,255,0)');
          g.addColorStop(.5, 'rgba(190,225,255,' + s.a + ')');
          g.addColorStop(1, 'rgba(190,225,255,0)');
          ctx.strokeStyle = g; ctx.lineWidth = 1.6;
          ctx.stroke();
        });
      };
      requestAnimationFrame(draw);
    }
  }

  // Porovnanie pred / po (ťahanie posúvačom)
  document.querySelectorAll('.compare').forEach(function (box) {
    var range = box.querySelector('input[type=range]');
    function set() { box.style.setProperty('--pos', range.value + '%'); }
    range.addEventListener('input', set);
    set();
  });

  // Formulár objednávky – v návrhu iba potvrdenie na stránke
  // (vo WordPress téme formulár odosiela server – tu len pre statický náhľad s data-demo)
  document.querySelectorAll('form[data-order][data-demo]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var ok = form.querySelector('.form-ok');
      ok.hidden = false;
      ok.textContent = 'Ďakujeme, ' + (form.elements.name.value || 'zákazník') +
        '. Ozveme sa vám do 60 minút. (V návrhu sa nič neodosiela – po spustení webu sa formulár napojí na e-mail.)';
    });
  });

  // ---- animácie pri scrollovaní (podľa BROMAR) ----
  var anim = document.documentElement.classList.contains('anim');
  if (anim) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (!e.isIntersecting) return;
        var el = e.target;
        el.classList.add('in');
        io.unobserve(el);
        // po odhalení vrátiť prvkom ich vlastné prechody (napr. hover na kartách)
        setTimeout(function () { el.classList.remove('rv', 'rv-img', 'in', 'd1', 'd2', 'd3', 'd4'); }, 1800);
      });
    }, { threshold: .14, rootMargin: '0px 0px -40px 0px' });
    document.querySelectorAll('.rv, .rv-img').forEach(function (el) { io.observe(el); });
  }

  // Odznak 99,9 % – číslo nabehne od nuly
  var badge = document.querySelector('.badge-999 b');
  if (badge && anim) {
    var small = badge.querySelector('small').outerHTML, t0 = null;
    var tick = function (t) {
      if (!t0) t0 = t;
      var k = Math.min(1, (t - t0) / 1600), v = 99.9 * (1 - Math.pow(1 - k, 3));
      badge.innerHTML = v.toFixed(1).replace('.', ',') + small;
      if (k < 1) requestAnimationFrame(tick);
    };
    setTimeout(function () { requestAnimationFrame(tick); }, 500);
  }

  // Parallax fotiek + čiara postupu v krokoch (jedna slučka rAF)
  var pars = document.querySelectorAll('[data-par] img');
  var steps = document.querySelector('[data-steps]');
  var stepEls = steps ? steps.querySelectorAll('li') : [];
  if (!reduceMotion && (pars.length || steps)) {
    var loop = function () {
      var vh = window.innerHeight;
      pars.forEach(function (img) {
        var r = img.parentElement.getBoundingClientRect();
        if (r.bottom < 0 || r.top > vh) return;
        var p = (r.top + r.height / 2 - vh / 2) / vh;
        img.style.transform = 'translate3d(0,' + (p * -9).toFixed(2) + '%,0) scale(1.16)';
      });
      if (steps) {
        var sr = steps.getBoundingClientRect();
        var sp = Math.min(1, Math.max(0, (vh * .8 - sr.top) / (sr.height + vh * .25)));
        steps.style.setProperty('--p', sp.toFixed(3));
        stepEls.forEach(function (li, n) { li.classList.toggle('lit', sp >= n / (stepEls.length - 1) - .02); });
      }
      requestAnimationFrame(loop);
    };
    requestAnimationFrame(loop);
  }
})();
