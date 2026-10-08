/* OH Consulting – slider, mobilné menu, animácie pri scrollovaní */
(function () {
  'use strict';

  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ---------- Hero slider ----------
  var hero = document.querySelector('.oh-hero');
  if (hero) {
    var slides = hero.querySelectorAll('.oh-slide');
    var dots = hero.querySelectorAll('.oh-dot');
    var speed = parseInt(hero.getAttribute('data-speed'), 10) || 0;
    var current = 0;
    var timer = null;

    var show = function (index) {
      current = (index + slides.length) % slides.length;
      slides.forEach(function (slide, i) {
        var active = i === current;
        slide.classList.toggle('is-active', active);
        if (active) {
          slide.removeAttribute('aria-hidden');
        } else {
          slide.setAttribute('aria-hidden', 'true');
        }
      });
      dots.forEach(function (dot, i) {
        dot.setAttribute('aria-current', i === current ? 'true' : 'false');
      });
    };

    var stop = function () {
      if (timer) {
        clearInterval(timer);
        timer = null;
      }
    };

    var start = function () {
      stop();
      if (speed > 0 && !reduceMotion && slides.length > 1) {
        timer = setInterval(function () { show(current + 1); }, speed * 1000);
      }
    };

    dots.forEach(function (dot) {
      dot.addEventListener('click', function () {
        show(parseInt(dot.getAttribute('data-slide'), 10));
        start();
      });
    });

    hero.querySelectorAll('.oh-arrow').forEach(function (btn) {
      btn.addEventListener('click', function () {
        show(current + parseInt(btn.getAttribute('data-dir'), 10));
        start();
      });
    });

    // Pauza, keď je kurzor alebo fokus v slideri.
    hero.addEventListener('mouseenter', stop);
    hero.addEventListener('mouseleave', start);
    hero.addEventListener('focusin', stop);
    hero.addEventListener('focusout', start);

    // Potiahnutie prstom na mobile.
    var touchX = null;
    hero.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
    hero.addEventListener('touchend', function (e) {
      if (touchX === null) { return; }
      var dx = e.changedTouches[0].clientX - touchX;
      if (Math.abs(dx) > 50) {
        show(current + (dx < 0 ? 1 : -1));
        start();
      }
      touchX = null;
    });

    start();
  }

  // ---------- Mobilné menu ----------
  var toggle = document.querySelector('.oh-nav-toggle');
  var nav = document.getElementById('oh-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // ---------- Animácie pri scrollovaní ----------
  var items = document.querySelectorAll('.oh-reveal');
  if (!('IntersectionObserver' in window) || reduceMotion) {
    items.forEach(function (el) { el.classList.add('is-visible'); });
  } else {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -60px 0px' });
    items.forEach(function (el) { io.observe(el); });
  }
})();
