// Čistímeklimy.sk – interakcie návrhu (slider, porovnanie pred/po, menu, formulár)
(function () {
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
})();
