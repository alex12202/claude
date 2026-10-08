/**
 * Skin & Face – slider v hero, mobilné menu, meranie kliknutí.
 */
(function () {
  'use strict';

  /* ---------- Slider (obe polovice naraz) ---------- */
  var hero = document.querySelector('[data-sf-slider]');
  if (hero) {
    var tabs = hero.querySelectorAll('[data-sf-go]');
    var count = tabs.length || 1;
    var current = 0;
    var timer = null;
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var autoplay = hero.getAttribute('data-autoplay') === '1' && !reduce && count > 1;

    var show = function (i) {
      current = (i + count) % count;
      hero.querySelectorAll('[data-sf-slide]').forEach(function (el) {
        var on = Number(el.getAttribute('data-sf-slide')) === current;
        el.classList.toggle('is-active', on);
        if (el.classList.contains('sf-half__title')) {
          if (on) { el.removeAttribute('aria-hidden'); } else { el.setAttribute('aria-hidden', 'true'); }
        }
      });
      tabs.forEach(function (t, k) {
        t.classList.toggle('is-active', k === current);
        t.setAttribute('aria-pressed', k === current ? 'true' : 'false');
      });
    };
    var start = function () {
      if (!autoplay) { return; }
      clearInterval(timer);
      timer = setInterval(function () { show(current + 1); }, 6000);
    };

    tabs.forEach(function (t) {
      t.addEventListener('click', function () { show(Number(t.getAttribute('data-sf-go'))); start(); });
    });
    var prev = hero.querySelector('[data-sf-prev]');
    var next = hero.querySelector('[data-sf-next]');
    if (prev) { prev.addEventListener('click', function () { show(current - 1); start(); }); }
    if (next) { next.addEventListener('click', function () { show(current + 1); start(); }); }
    hero.addEventListener('mouseenter', function () { clearInterval(timer); });
    hero.addEventListener('mouseleave', start);
    document.addEventListener('visibilitychange', function () {
      if (document.hidden) { clearInterval(timer); } else { start(); }
    });
    start();
  }

  /* ---------- Mobilné menu ---------- */
  var drawer = document.getElementById('sf-drawer');
  var burger = document.querySelector('.sf-burger');
  if (drawer && burger) {
    var closeBtn = drawer.querySelector('.sf-drawer__close');
    var open = function (state) {
      drawer.classList.toggle('is-open', state);
      drawer.setAttribute('aria-hidden', state ? 'false' : 'true');
      burger.setAttribute('aria-expanded', state ? 'true' : 'false');
      document.body.classList.toggle('sf-no-scroll', state);
      if (state && closeBtn) { closeBtn.focus(); } else { burger.focus(); }
    };
    burger.addEventListener('click', function () { open(true); });
    if (closeBtn) { closeBtn.addEventListener('click', function () { open(false); }); }
    drawer.addEventListener('click', function (e) { if (e.target.closest('a')) { open(false); } });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) { open(false); }
    });
  }

  /* ---------- Meranie pre kampane (Google Tag Manager / GA4) ---------- */
  window.dataLayer = window.dataLayer || [];
  document.addEventListener('click', function (e) {
    var a = e.target.closest('a');
    if (!a) { return; }
    var href = a.getAttribute('href') || '';
    var type = a.getAttribute('data-sf-track');
    if (!type && href.indexOf('tel:') === 0) { type = 'phone'; }
    if (!type && href.indexOf('mailto:') === 0) { type = 'email'; }
    if (!type && href.indexOf('navstevalekara.sk') !== -1) { type = 'booking'; }
    if (type) {
      window.dataLayer.push({ event: 'sf_click', sf_type: type, sf_url: href });
    }
  });
})();
