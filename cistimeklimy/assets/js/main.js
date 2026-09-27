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

  // Hero slider cez celú sekciu – obrázky sa striedajú a pomaly približujú
  var slider = document.querySelector('[data-slider]');
  if (slider) {
    var slides = slider.querySelectorAll('.slide');
    var dotsBox = slider.querySelector('.slider-dots');
    var caption = slider.querySelector('.slide-caption');
    var i = 0, timer = null;
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var dots = Array.prototype.map.call(slides, function (s, n) {
      var b = document.createElement('button');
      b.type = 'button';
      b.setAttribute('aria-label', 'Snímka ' + (n + 1));
      b.addEventListener('click', function () { go(n); restart(); });
      dotsBox.appendChild(b);
      return b;
    });
    function go(n) {
      slides[i].classList.remove('is-active');
      dots[i].removeAttribute('aria-current');
      i = (n + slides.length) % slides.length;
      slides[i].classList.add('is-active');
      dots[i].setAttribute('aria-current', 'true');
      if (caption) caption.textContent = slides[i].getAttribute('data-caption') || '';
    }
    function restart() {
      clearInterval(timer);
      if (!reduce) timer = setInterval(function () { go(i + 1); }, 5500);
    }
    go(0);
    restart();
  }

  // Porovnanie pred / po (ťahanie posúvačom)
  document.querySelectorAll('.compare').forEach(function (box) {
    var range = box.querySelector('input[type=range]');
    function set() { box.style.setProperty('--pos', range.value + '%'); }
    range.addEventListener('input', set);
    set();
  });

  // Formulár objednávky – v návrhu iba potvrdenie na stránke
  document.querySelectorAll('form[data-order]').forEach(function (form) {
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
