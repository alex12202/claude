(() => {
/* ================= DATA ================= */
const CATS = [
  {id:'ovocie', name:'Ovocie', subs:[
    {id:'lyo', name:'Lyofilizované ovocie'},
    {id:'susene', name:'Sušené ovocie', soon:true},
    {id:'cerstve', name:'Čerstvé ovocie (sezónne)', soon:true}]},
  {id:'orechy', name:'Orechy', subs:[
    {id:'natural', name:'Orechy natural'},
    {id:'cokolada', name:'Orechy v čokoláde'}]},
  {id:'zelenina', name:'Zelenina', subs:[
    {id:'susena', name:'Sušená zelenina'}]}
];
const W = {
  lyo:[[30,.36],[100,1],[250,2.3],[500,3.9]],
  natural:[[100,1],[250,2.25],[500,4.1],[1000,6.5]],
  cokolada:[[100,1],[250,2.3],[500,4.2]],
  susena:[[30,.4],[100,1],[250,2.35]]
};
const P = [
  {id:'jahody',   name:'Jahody',        kind:'Lyofilizované · Fragaria ananassa', sub:'lyo', p:6.9, o:'Poľsko', desc:'Celé plátky, sladkokyslé. Do müsli, jogurtu aj len tak.', tint:'#e9a9a0', promo:true, bio:true, nosugar:true, top:1},
  {id:'maliny',   name:'Maliny',        kind:'Lyofilizované · Rubus idaeus', sub:'lyo', p:7.9, o:'Srbsko', desc:'Aromatické maliny z Arilje, rozpadnú sa na jazyku.', tint:'#e59aa7', promo:true, bio:true, nosugar:true, top:3},
  {id:'cucoriedky',name:'Čučoriedky',   kind:'Lyofilizované · Vaccinium', sub:'lyo', p:8.9, o:'Poľsko', desc:'Celé bobule, jemne kyslé. Plné antioxidantov.', tint:'#a9b3dc', promo:true, bio:true, nosugar:true, isNew:true},
  {id:'banany',   name:'Banány',        kind:'Lyofilizované · Musa', sub:'lyo', p:4.9, o:'Uganda', desc:'Krémová sladkosť bez pridaného cukru. Pre deti aj športovcov.', tint:'#f0d98f', promo:true, bio:true, nosugar:true, top:5},
  {id:'mango',    name:'Mango',         kind:'Lyofilizované · Mangifera indica', sub:'lyo', p:5.9, o:'Uganda', desc:'Zrelé mango z ugandských plantáží. Tropická chuť v každom kúsku.', tint:'#f3c46b', promo:true, bio:true, nosugar:true, top:2},
  {id:'visne',    name:'Višne',         kind:'Lyofilizované · Prunus cerasus', sub:'lyo', p:7.5, o:'Maďarsko', desc:'Výrazne kyslé višne bez kôstok. Skvelé do pečenia.', tint:'#d98c8c', promo:true, bio:true, nosugar:true, isNew:true},
  {id:'jablka',   name:'Jablká',        kind:'Lyofilizované · Malus domestica', sub:'lyo', p:3.9, o:'Slovensko', desc:'Tenké krúžky zo slovenských sadov. Chrumkavý chips bez oleja.', tint:'#cfe0a3', promo:true, bio:true, nosugar:true},
  {id:'vlasske',  name:'Vlašské orechy',kind:'Orechy · Juglans regia', sub:'natural', p:3.49, o:'Uzbekistan', desc:'Svetlé polovičky z údolia Fergana. Jemná, nehorká chuť.', tint:'#d8bb8a', bio:true, nosugar:true, top:4},
  {id:'lieskove', name:'Lieskové orechy',kind:'Orechy · Corylus avellana', sub:'natural', p:2.99, o:'Turecko', desc:'Oblé lieskovce z pobrežia Čierneho mora.', tint:'#cfa682', bio:true, nosugar:true},
  {id:'mandle',   name:'Mandle',        kind:'Orechy · Prunus dulcis', sub:'natural', p:2.79, o:'Španielsko', desc:'Celé mandle so šupkou. Z Valencie, zbierané ručne.', tint:'#d9ae86', bio:true, nosugar:true, top:7},
  {id:'kesu',     name:'Kešu orechy',   kind:'Orechy · Anacardium occidentale', sub:'natural', p:3.29, o:'Vietnam', desc:'Celé jadrá W320, maslová chuť.', tint:'#eadbb8', bio:true, nosugar:true, top:6},
  {id:'mandle-cokolada', name:'Mandle v čokoláde', kind:'V mliečnej čokoláde', sub:'cokolada', p:3.9, o:'Španielsko', desc:'Pražená mandľa v hrubej vrstve mliečnej čokolády.', tint:'#b98c6c', bio:true, top:8},
  {id:'lieskove-cokolada', name:'Lieskovce v čokoláde', kind:'V mliečnej čokoláde', sub:'cokolada', p:3.9, o:'Turecko', desc:'Celé lieskovce, jemná belgická čokoláda.', tint:'#b58a6f', bio:true, isNew:true},
  {id:'arasidy-cokolada', name:'Arašidy v čokoláde', kind:'V mliečnej čokoláde', sub:'cokolada', p:2.49, o:'Argentína', desc:'Klasika do kina. Chrumkavé arašidy v čokoláde.', tint:'#a98166'},
  {id:'paprika',  name:'Paprika',       kind:'Sušená zelenina · Capsicum', sub:'susena', p:3.9, o:'Španielsko', desc:'Sladká červená paprika na kocky. Do polievok a omáčok.', tint:'#e7988a', bio:true, nosugar:true},
  {id:'cibula',   name:'Cibuľa',        kind:'Sušená zelenina · Allium cepa', sub:'susena', p:2.49, o:'Egypt', desc:'Sušené lupienky. Plná chuť bez plakania.', tint:'#eee0bd', bio:true, nosugar:true},
  {id:'cesnak',   name:'Cesnak',        kind:'Sušená zelenina · Allium sativum', sub:'susena', p:3.49, o:'Španielsko', desc:'Plátky cesnaku, stačí hodiť do panvice.', tint:'#e9e2cf', bio:true, nosugar:true},
  {id:'mrkva',    name:'Mrkva',         kind:'Sušená zelenina · Daucus carota', sub:'susena', p:2.49, o:'Slovensko', desc:'Kocky mrkvy do vývarov, rizot a na výlety.', tint:'#f0b27f', bio:true, nosugar:true},
  {id:'cuketa',   name:'Cuketa',        kind:'Sušená zelenina · Cucurbita pepo', sub:'susena', p:3.2, o:'Taliansko', desc:'Plátky cukety na chipsy aj do jedál.', tint:'#c5d9a1', bio:true, nosugar:true, isNew:true},
  {id:'paradajka',name:'Paradajky',     kind:'Sušená zelenina · Solanum lycopersicum', sub:'susena', p:3.6, o:'Taliansko', desc:'Kocky paradajok z Apúlie. Intenzívna chuť leta.', tint:'#e58f7c', bio:true, nosugar:true},
];
const ORIGINS = {
  'Uganda':['UG','0.35° S, 32.6° V','6 080 km'], 'Uzbekistan':['UZ','40.4° S, 71.8° V','4 150 km'],
  'Turecko':['TR','41.0° S, 38.9° V','1 900 km'], 'Španielsko':['ES','39.5° S, 0.4° Z','1 850 km'],
  'Vietnam':['VN','11.9° S, 108.4° V','8 900 km'], 'Poľsko':['PL','50.0° S, 20.9° V','250 km'],
  'Srbsko':['RS','43.8° S, 20.1° V','700 km'], 'Maďarsko':['HU','46.9° S, 19.7° V','300 km'],
  'Slovensko':['SK','48.1° S, 17.1° V','u nás'], 'Taliansko':['IT','41.1° S, 16.9° V','1 250 km'],
  'Egypt':['EG','30.0° S, 31.2° V','2 700 km'], 'Argentína':['AR','32.9° J, 60.6° Z','11 700 km']
};
const FREE_SHIP = 50;
const GIFTS = [
  [30,'Vzorka 30 g podľa výberu','vzorku 30 g podľa výberu'],
  [50,'Doprava zdarma + maliny 30 g','dopravu zdarma a maliny 30 g'],
  [80,'Darčeková tuba s orechovým mixom 250 g','darčekovú tubu s orechovým mixom']
];
const DEAL = {id:'mango', g:250, price:9.9};
const BUNDLES = [
  {id:'ranajky', name:'Raňajkový balíček', note:'Do müsli, kaše a jogurtu', items:[['jahody',100],['maliny',100],['mandle',250]]},
  {id:'sport', name:'Športový balíček', note:'Energia na tréning a túru', items:[['banany',100],['mango',100],['kesu',250]]},
  {id:'kuchyna', name:'Kuchynský balíček', note:'Základ do polievok a omáčok', items:[['paprika',100],['mrkva',100],['cibula',100],['cesnak',100]]},
];
const WEIGHT_CHIPS = [30,100,250,500,1000];
const RADII = ['52% 48% 44% 56%/58% 50% 50% 42%','46% 54% 58% 42%/48% 56% 44% 52%','58% 42% 50% 50%/44% 58% 42% 56%','44% 56% 48% 52%/56% 42% 58% 44%'];
const XXL_MIN = {lyo:500, natural:1000, cokolada:500, susena:250};
const PROPS = [['bio','BIO'],['nosugar','Bez pridaného cukru'],['promo','Akcia 2 + 1 zdarma']];

/* ================= HELPERS ================= */
const $ = s => document.querySelector(s);
const $$ = s => [...document.querySelectorAll(s)];
const fmt = n => n.toLocaleString('sk-SK',{minimumFractionDigits:2,maximumFractionDigits:2}) + ' €';
const wlabel = g => g >= 1000 ? (g/1000)+' kg' : g+' g';
const round9 = v => Math.max(0.99, Math.round(v*10)/10 - 0.01);
const listPrice = (p,g) => { const f = W[p.sub].find(x=>x[0]===g); return f[1]===1 ? p.p : round9(p.p * f[1]); };
const isDeal = (p,g) => p.id===DEAL.id && g===DEAL.g;
const priceOf = (p,g) => isDeal(p,g) ? DEAL.price : listPrice(p,g);
const weightsOf = p => W[p.sub].map(x=>x[0]);
const byId = id => P.find(p=>p.id===id);
const subOf = id => CATS.flatMap(c=>c.subs.map(s=>({...s,cat:c.id}))).find(s=>s.id===id);
const esc = s => String(s).replace(/[&<>"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
const img = id => `assets/products/${id}.webp`;
const ICON_PLUS = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 5v14M5 12h14"/></svg>';
const ICON_GIFT = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="8" width="18" height="13" rx="2"/><path d="M12 8v13M3 12h18M12 8S10 3 7.5 4.5 9 8 12 8zm0 0s2-5 4.5-3.5S15 8 12 8z"/></svg>';
const bundleSum = b => b.items.reduce((a,[id,g])=>a+priceOf(byId(id),g),0);
const bundlePrice = b => Math.floor(bundleSum(b)*0.85) + 0.9;

/* ================= SHARED CHROME ================= */
const page = document.body.dataset.page || (document.getElementById('slider') ? 'home' : document.getElementById('grid') ? 'shop' : '');
const shopHref = h => (page==='shop' ? '' : 'obchod.html') + '#' + h;
const homeHref = h => (page==='home' ? '' : 'index.html') + (h ? '#'+h : '');
const count = sub => P.filter(p=>p.sub===sub).length;

const top = $('#chrome-top');
if (top) top.outerHTML = `
<div class="promo"><div class="wrap">
  <span><b>2 + 1 zdarma</b> na všetko lyofilizované ovocie</span>
  <span>Darček ku každému nákupu od <b>30 €</b></span>
  <span>Doprava zdarma od <b>${FREE_SHIP} €</b></span>
</div></div>
<header class="site">
  <div class="wrap bar">
    <a class="logo" href="${homeHref('')||'index.html'}" aria-label="Alešove dobroty, úvod">
      <img src="assets/logo.webp" alt="">
      <span>Alešove<small>dobroty</small></span>
    </a>
    <label class="search" for="q">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
      <input id="q" type="search" placeholder="Hľadaj: jahody, kešu, mango…" autocomplete="off">
    </label>
    <button class="theme-t" id="themeT" type="button" aria-label="Prepnúť svetlý a tmavý režim">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
    </button>
    <button class="gift-pill" id="giftPill" type="button" aria-label="Otvoriť košík a zobraziť darčeky">
      ${ICON_GIFT}<span><span data-gift-short>Darček od 30 €</span><span class="mini"><i data-gift-fill></i></span></span>
    </button>
    <button class="cart-btn" id="cartBtn" type="button" aria-label="Otvoriť košík">
      <span class="sum price" id="cartSum">0,00 €</span>
      <span class="count" id="cartCount">0</span>
    </button>
  </div>
  <div class="wrap"><nav class="cats" id="cats" aria-label="Kategórie">
    ${page==='home'?'':`<div class="cat"><a class="navlink" href="index.html">Úvod</a></div>`}
    ${CATS.map(c => `<div class="cat" data-cat="${c.id}"><button type="button" aria-expanded="false">${c.name} <span class="n">${c.subs.reduce((a,s)=>a+count(s.id),0)}</span></button></div>`).join('')}
    <div class="cat"><a class="navlink hot" href="${shopHref('akcia')}">2 + 1 zdarma</a></div>
    <div class="cat"><a class="navlink" href="${shopHref('xxl')}">XXL balenia</a></div>
    <div class="cat"><a class="navlink" href="${shopHref('vzorky')}">Vzorky 30 g</a></div>
    <div class="cat"><a class="navlink" href="${homeHref('balicky')}">Balíčky</a></div>
    <div class="cat"><a class="navlink" href="${homeHref('povod')}">Pôvod</a></div>
  </nav></div>
</header>
<div class="mega" id="mega" hidden></div>`;

const bottom = $('#chrome-bottom');
if (bottom) bottom.outerHTML = `
<footer id="kontakt">
  <div class="wrap">
    <div class="cols">
      <div><div class="hand">Alešove dobroty</div>
        <ul><li>Orechy · lyofilizované ovocie · zdravá výživa</li><li>info@alesovedobroty.sk</li><li>+421 900 000 000</li></ul></div>
      <div><h4>Obchod</h4><ul><li><a href="${shopHref('lyo')}">Lyofilizované ovocie</a></li><li><a href="${shopHref('natural')}">Orechy</a></li><li><a href="${shopHref('susena')}">Sušená zelenina</a></li><li><a href="${shopHref('xxl')}">XXL balenia</a></li><li><a href="${shopHref('vzorky')}">Vzorky</a></li></ul></div>
      <div><h4>Nákup</h4><ul><li>Doprava a platba</li><li>Reklamácie a vrátenie</li><li><a href="${homeHref('darceky')}">Darčeky k nákupu</a></li><li>Veľkoobchod</li></ul></div>
      <div><h4>Informácie</h4><ul><li>Obchodné podmienky</li><li>Ochrana osobných údajov</li><li>Cookies</li><li>SOI · Alternatívne riešenie sporov</li></ul></div>
    </div>
    <div class="legal">Návrh e-shopu. Ceny, pôvod a údaje prevádzkovateľa sú ukážkové.</div>
  </div>
</footer>
<div class="scrim" id="scrim"></div>
<div class="pip" id="pip" role="dialog" aria-label="Rýchly náhľad produktu"></div>
<aside class="drawer" id="drawer" aria-label="Košík">
  <header><h2>Košík</h2><button class="x" id="closeCart" type="button" aria-label="Zavrieť košík">✕</button></header>
  <div class="gbar" id="dGift"></div>
  <div class="lines" id="lines"></div>
  <div class="sumbox" id="sumbox"></div>
</aside>
<div class="toast" id="toast" role="status" aria-live="polite"></div>`;

/* ================= STATE ================= */
let cart = {};
try { const s = JSON.parse(localStorage.getItem('ad-cart')||'{}'); if (s && typeof s === 'object') cart = s; } catch(e) {}
const saveCart = () => { try { localStorage.setItem('ad-cart', JSON.stringify(cart)); } catch(e){} };
const F = {subs:new Set(), weight:null, max:40, props:new Set(), origins:new Set(), q:'', sort:'cheap', xxl:false};
const sel = {};
P.forEach(p => sel[p.id] = weightsOf(p).includes(100) ? 100 : weightsOf(p)[0]);


function shownWeight(p){
  if (F.weight && weightsOf(p).includes(F.weight)) return F.weight;
  if (F.xxl) return XXL_MIN[p.sub];
  return sel[p.id];
}

/* ================= CARD ================= */
function cardHTML(p,i){
  const g = shownWeight(p), pr = priceOf(p,g), deal = isDeal(p,g);
  const badges = [
    deal ? '<span class="tag" style="background:var(--berry);color:var(--ink-on-accent)">Ponuka týždňa</span>' : '',
    p.promo?'<span class="tag deal">2 + 1</span>':'',
    g>=XXL_MIN[p.sub]?'<span class="tag xxlt">XXL</span>':'',
    p.isNew?'<span class="tag newt">Novinka</span>':'',
    p.bio?'<span class="tag bio">BIO</span>':''].join('');
  return `<article class="card" data-id="${p.id}" data-i="${i}" style="--tint:${p.tint};--r:${RADII[i%4]}">
    <button class="art" type="button" aria-label="Rýchly náhľad: ${esc(p.name)}"><span class="badges">${badges}</span><img src="${img(p.id)}" alt="" loading="lazy"></button>
    <div class="kind">${esc(p.kind)}</div>
    <h3>${esc(p.name)}</h3>
    <p class="desc">${esc(p.desc)}</p>
    <div class="kind">Pôvod: ${esc(p.o)}</div>
    <div class="wts">${weightsOf(p).map(w=>`<button type="button" class="chip" data-w="${w}" aria-pressed="${w===g}">${wlabel(w)}</button>`).join('')}</div>
    <div class="buy">
      <div>${deal?`<s class="old">${fmt(listPrice(p,g))}</s>`:''}<span class="price">${fmt(pr)}</span><span class="w">/ ${wlabel(g)}</span><span class="p100">${fmt(pr/g*100)} za 100 g</span></div>
      <button class="add" type="button" data-add="${p.id}" aria-label="Pridať ${esc(p.name)} ${wlabel(g)} do košíka">${ICON_PLUS}</button>
    </div>
  </article>`;
}
document.addEventListener('click', e => {
  const card = e.target.closest('.card'); if (!card) return;
  const p = byId(card.dataset.id);
  const w = e.target.closest('[data-w]');
  if (w) {
    sel[p.id] = +w.dataset.w; F.weight = null; F.xxl = false;
    if (AD.onWeight) AD.onWeight(); else card.outerHTML = cardHTML(p, +card.dataset.i);
    return;
  }
  const add = e.target.closest('[data-add]');
  if (add) { addToCart(p.id, shownWeight(p)); return; }
  if (e.target.closest('.art')) showPip(card, true);
});

/* ================= MEGA MENU ================= */
const nav = $('#cats'), mega = $('#mega');
let megaT;
function openMega(el){
  const c = CATS.find(x=>x.id===el.dataset.cat);
  mega.innerHTML = `<div><h4>${c.name}</h4><ul><li><a href="${shopHref(c.id)}">Všetko (${c.subs.reduce((a,s)=>a+count(s.id),0)})</a></li></ul></div>` +
    c.subs.map(s=>`<div><h4>${s.name}</h4><ul>${s.soon?'<li class="soon">Pripravujeme</li>':
      P.filter(p=>p.sub===s.id).map(p=>`<li><a href="${shopHref('p-'+p.id)}">${p.name} <span style="color:var(--muted)">od ${fmt(Math.min(...weightsOf(p).map(g=>priceOf(p,g))))}</span></a></li>`).join('') +
      `<li><a href="${shopHref(s.id)}" style="font-weight:700;color:var(--leaf)">Zobraziť všetko →</a></li>`}</ul></div>`).join('');
  mega.style.top = (el.getBoundingClientRect().bottom + 6) + 'px';
  mega.hidden = false;
  $$('.cat[data-cat]').forEach(x=>{x.classList.toggle('open',x===el); x.firstElementChild.setAttribute('aria-expanded', x===el)});
}
function closeMega(){ if (!mega) return; mega.hidden = true; $$('.cat[data-cat]').forEach(x=>{x.classList.remove('open'); x.firstElementChild.setAttribute('aria-expanded','false')}); }
if (nav) {
  nav.addEventListener('mouseover', e => { const c = e.target.closest('.cat[data-cat]'); if (c && matchMedia('(hover:hover)').matches){ clearTimeout(megaT); openMega(c);} });
  nav.addEventListener('mouseleave', () => { megaT = setTimeout(closeMega, 220); });
  nav.addEventListener('click', e => { const c = e.target.closest('.cat[data-cat]'); if (c) { c.classList.contains('open') ? closeMega() : openMega(c); } });
  mega.addEventListener('mouseenter', () => clearTimeout(megaT));
  mega.addEventListener('mouseleave', () => { megaT = setTimeout(closeMega, 220); });
  mega.addEventListener('click', e => { if (e.target.closest('a')) closeMega(); });
  document.addEventListener('click', e => { if (!mega.hidden && !e.target.closest('#mega,#cats')) closeMega(); });
}

/* ================= QUICK VIEW (PiP) ================= */
const pip = $('#pip');
let pipFor = null, pipQty = 1, pipW = 100, hoverT, leaveT;
const touchMode = () => matchMedia('(hover:none),(max-width:760px)').matches;
function pipHTML(p){
  const pr = priceOf(p,pipW), deal = isDeal(p,pipW);
  return `<button class="close" type="button" aria-label="Zavrieť">✕</button>
  <div class="pimg" style="--tint:${p.tint}"><img src="${img(p.id)}" alt="${esc(p.name)}"><span class="live">Náhľad</span></div>
  <div><div style="font-size:.76rem;color:var(--muted);font-weight:600">${esc(p.kind)}</div><h3>${esc(p.name)}</h3>
    <div class="origin">Pôvod: <b>${esc(p.o)}</b>${ORIGINS[p.o]&&ORIGINS[p.o][2]!=='u nás'?' · '+ORIGINS[p.o][2]:''}</div>
    <p>${esc(p.desc)}</p></div>
  <div style="display:flex;gap:.3rem;flex-wrap:wrap;align-content:start">${p.bio?'<span class="tag bio">BIO</span>':''}${p.nosugar?'<span class="tag nosugar">bez cukru</span>':''}${p.promo?'<span class="tag deal">2 + 1</span>':''}</div>
  <div class="ctrl">
    <div class="chips">${weightsOf(p).map(w=>`<button type="button" class="chip" data-pw="${w}" aria-pressed="${w===pipW}">${wlabel(w)}${w>=XXL_MIN[p.sub]?' XXL':''}</button>`).join('')}</div>
    <div class="row"><div>${deal?`<s class="old">${fmt(listPrice(p,pipW)*pipQty)}</s>`:''}<span class="price">${fmt(pr*pipQty)}</span><div style="font-size:.78rem;color:var(--muted)">${fmt(pr/pipW*100)} za 100 g</div></div>
      <div class="qty"><button type="button" data-q="-1" aria-label="Menej">−</button><output>${pipQty}</output><button type="button" data-q="1" aria-label="Viac">+</button></div></div>
    <button class="btn berry" type="button" data-padd style="width:100%">${ICON_PLUS} Pridať do košíka</button>
    <div class="note" data-pnote>${pipNote(p)}</div>
  </div>`;
}
function pipNote(p){
  const t = totals().total, next = GIFTS.find(g=>t<g[0]);
  const after = t + priceOf(p,pipW)*pipQty;
  if (next && after >= next[0]) return `S týmto nákupom získaš ${next[2]}.`;
  if (next) return `Do darčeka ti chýba ${fmt(next[0]-t)}.`;
  return p.promo ? 'Vlož 3 vrecká ovocia, najlacnejšie máš zdarma.' : 'Máš všetky darčeky.';
}
function placePip(card){
  if (touchMode()) return;
  const r = card.getBoundingClientRect(), pw = pip.offsetWidth, ph = pip.offsetHeight, vw = innerWidth, vh = innerHeight;
  let left = r.right + 12, ox = 'left';
  if (left + pw > vw - 12) { left = r.left - pw - 12; ox = 'right'; }
  if (left < 12) { left = Math.max(12, r.left + (r.width-pw)/2); ox = 'center'; }
  const topPos = Math.min(Math.max(r.top, 12), vh - ph - 12);
  pip.style.left = left+'px'; pip.style.top = Math.max(12,topPos)+'px'; pip.style.setProperty('--ox', ox);
}
function showPip(card, fromClick){
  const p = byId(card.dataset.id);
  if (pipFor !== p.id) { pipQty = 1; pipW = shownWeight(p); }
  pipFor = p.id;
  pip.innerHTML = pipHTML(p);
  placePip(card);
  pip.classList.add('show');
  if (touchMode()) scrim(true);
  if (fromClick) pip.querySelector('[data-padd]').focus({preventScroll:true});
}
function hidePip(){ if (!pip) return; pip.classList.remove('show'); pipFor = null; if (!$('#drawer').classList.contains('show') && !($('#filters') && $('#filters').classList.contains('show'))) scrim(false); }
document.addEventListener('mouseover', e => {
  if (touchMode()) return;
  const card = e.target.closest('.card'); if (!card) return;
  clearTimeout(leaveT);
  if (pipFor === card.dataset.id && pip.classList.contains('show')) return;
  clearTimeout(hoverT);
  hoverT = setTimeout(()=>showPip(card), pip.classList.contains('show') ? 60 : 280);
});
document.addEventListener('mouseout', e => {
  if (touchMode()) return;
  const card = e.target.closest('.card'); if (!card || card.contains(e.relatedTarget)) return;
  clearTimeout(hoverT);
  if (e.relatedTarget && pip.contains(e.relatedTarget)) return;
  leaveT = setTimeout(hidePip, 180);
});
pip.addEventListener('mouseenter', () => clearTimeout(leaveT));
pip.addEventListener('mouseleave', e => { if (touchMode()) return; const c = e.relatedTarget && e.relatedTarget.closest && e.relatedTarget.closest('.card'); if (c && c.dataset.id===pipFor) return; leaveT = setTimeout(hidePip, 180); });
pip.addEventListener('click', e => {
  const p = byId(pipFor); if (!p) return;
  const b = e.target.closest('button'); if (!b) return;
  if (b.classList.contains('close')) { hidePip(); return; }
  if (b.dataset.pw) pipW = +b.dataset.pw;
  if (b.dataset.q) pipQty = Math.max(1, Math.min(20, pipQty + +b.dataset.q));
  if ('padd' in b.dataset) { addToCart(p.id, pipW, pipQty); if (touchMode()) { hidePip(); return; } pipQty = 1; }
  const card = document.querySelector(`.card[data-id="${p.id}"]`);
  pip.innerHTML = pipHTML(p); if (card) placePip(card);
});
addEventListener('scroll', () => { if (!touchMode() && pip.classList.contains('show')) hidePip(); }, {passive:true});
addEventListener('keydown', e => { if (e.key==='Escape') { hidePip(); closeCart(); closeMega(); if ($('#filters')) $('#filters').classList.remove('show'); scrim(false); } });

/* ================= CART ================= */
function addToCart(id, g, q=1){
  const p = byId(id); if (!p) return;
  if (!weightsOf(p).includes(g)) g = sel[id];
  const k = id+'|'+g; cart[k] = (cart[k]||0) + q; saveCart(); updateCart();
  toastMsg(`${p.name} ${wlabel(g)} v košíku · spolu ${fmt(totals().total)}`);
}
function addBundle(bid){
  const b = BUNDLES.find(x=>x.id===bid); const k = 'b:'+bid+'|0';
  cart[k] = (cart[k]||0) + 1; saveCart(); updateCart();
  toastMsg(`${b.name} v košíku · spolu ${fmt(totals().total)}`);
}
function totals(){
  const lines = Object.entries(cart).filter(([,q])=>q>0).map(([k,q])=>{
    const [id,g] = k.split('|');
    if (id.startsWith('b:')) { const b = BUNDLES.find(x=>'b:'+x.id===id); return b ? {k,b,q,g:0,unit:bundlePrice(b),name:b.name,img:img(b.items[0][0]),label:b.items.map(([i,w])=>byId(i).name+' '+wlabel(w)).join(', ')} : null; }
    const p = byId(id); if (!p || !weightsOf(p).includes(+g)) return null;
    return {k,p,g:+g,q,unit:priceOf(p,+g),name:p.name,img:img(p.id),label:wlabel(+g)};
  }).filter(Boolean);
  const promoUnits = lines.filter(l=>l.p && l.p.promo).flatMap(l=>Array(l.q).fill(l)).sort((a,b)=>a.unit-b.unit);
  const freeN = Math.floor(promoUnits.length/3);
  const freeMap = {}; let save = 0;
  promoUnits.slice(0,freeN).forEach(l=>{ freeMap[l.k]=(freeMap[l.k]||0)+1; save+=l.unit; });
  const sub = lines.reduce((a,l)=>a+l.unit*l.q,0);
  return {lines, sub, save, total: Math.max(0, sub-save), freeMap, count: lines.reduce((a,l)=>a+l.q,0), promoN: promoUnits.length};
}
function giftState(t){
  const next = GIFTS.find(g=>t<g[0]), got = GIFTS.filter(g=>t>=g[0]);
  const prev = got.length ? got[got.length-1][0] : 0;
  return {next, got, pct: Math.min(100, t/GIFTS[GIFTS.length-1][0]*100), stepPct: next ? (t-prev)/(next[0]-prev)*100 : 100};
}
let lastGot = null;
function updateCart(){
  const T = totals(), G = giftState(T.total);
  const set = (sel, fn) => $$(sel).forEach(fn);
  if ($('#cartSum')) { $('#cartSum').textContent = fmt(T.total); $('#cartCount').textContent = T.count; }
  const long = G.next ? `Do ďalšieho darčeka ti chýba <b>${fmt(G.next[0]-T.total)}</b>: ${G.next[2]}.` : `<b>Máš všetky darčeky.</b> Pribalíme ich k objednávke.`;
  set('[data-gift-short]', el => el.textContent = G.next ? `Ešte ${fmt(G.next[0]-T.total)} do darčeka` : 'Všetky darčeky získané');
  set('[data-gift-long]', el => el.innerHTML = (T.total ? `V košíku máš ${fmt(T.total)}. ` : '') + long);
  set('[data-gift-fill]', el => el.style.width = G.pct+'%');
  set('[data-gift-tiers]', el => el.innerHTML = GIFTS.map(g=>`<div class="tier ${T.total>=g[0]?'got':''}"><span class="price">${T.total>=g[0]?'✓ ':''}od ${g[0]} €</span><span>${g[1]}</span></div>`).join(''));
  $$('[data-gift-at]').forEach(el => { const at = +el.dataset.giftAt; el.classList.toggle('got', T.total >= at); });

  if ($('#dGift')) $('#dGift').innerHTML = `<div>${long}</div><div class="rail"><div class="fill" style="width:${G.pct}%"></div>${GIFTS.map(g=>`<i class="mark ${T.total>=g[0]?'got':''}" style="left:${g[0]/GIFTS[GIFTS.length-1][0]*100}%"></i>`).join('')}</div>
    <div class="dsteps">${GIFTS.map(g=>`<span class="${T.total>=g[0]?'got':''}">${T.total>=g[0]?'✓':ICON_GIFT} ${g[0]} €</span>`).join('')}</div>`;
  if ($('#lines')) $('#lines').innerHTML = T.lines.length ? T.lines.map(l=>`<div class="line" data-k="${l.k}">
      <img src="${l.img}" alt="">
      <div><b>${esc(l.name)}</b><small>${esc(l.label)} · ${fmt(l.unit)} / ks</small>
        <div class="qty" style="margin-top:.3rem;width:max-content"><button type="button" data-lq="-1" aria-label="Menej">−</button><output>${l.q}</output><button type="button" data-lq="1" aria-label="Viac">+</button></div></div>
      <div class="price">${fmt(l.unit*l.q - (T.freeMap[l.k]||0)*l.unit)}${T.freeMap[l.k]?`<span class="free">${T.freeMap[l.k]}× zdarma</span>`:''}</div>
    </div>`).join('') +
    G.got.map(g=>`<div class="line gift"><div class="gico" aria-hidden="true">${ICON_GIFT}</div><div><b>Darček zdarma</b><small>${g[1]}</small></div><div class="price" style="color:var(--leaf)">0,00 €</div></div>`).join('')
    : '<p style="color:var(--bark)">Košík je prázdny. Začni jahodami za 6,90 €.</p>';
  const left3 = 3 - T.promoN%3;
  const promoHint = T.promoN % 3 ? `<div class="r" style="color:var(--bark);font-size:.85rem">Pridaj ešte ${left3} ${left3===1?'vrecko':'vrecká'} ovocia a najlacnejšie máš zdarma.</div>` : '';
  const ship = T.total >= FREE_SHIP || T.total === 0 ? 0 : 2.9;
  if ($('#sumbox')) $('#sumbox').innerHTML = `
    <div class="r"><span>Medzisúčet</span><span>${fmt(T.sub)}</span></div>
    ${T.save?`<div class="r save"><span>Akcia 2 + 1 zdarma</span><span>−${fmt(T.save)}</span></div>`:''}${promoHint}
    <div class="r"><span>Doprava (Packeta)</span><span>${ship?fmt(ship):'zdarma'}</span></div>
    <div class="r total"><span>Spolu s DPH</span><span class="price">${fmt(T.total+ship)}</span></div>
    <button class="btn berry" type="button" id="checkout" ${T.count?'':'disabled'} style="width:100%;margin-top:.3rem">Pokračovať k platbe</button>
    <div class="inv"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>Faktúra príde automaticky e-mailom, pri dobierke aj doklad z eKasy.</div>`;
  if (lastGot !== null && G.got.length > lastGot) setTimeout(()=>toastMsg(`Získal si darček: ${G.got[G.got.length-1][1].toLowerCase()}`), 900);
  lastGot = G.got.length;
  const bump = $('#cartBtn'); if (bump && bump.animate && T.count) bump.animate([{transform:'scale(1)'},{transform:'scale(1.1)'},{transform:'scale(1)'}],{duration:300});
  if (pip && pipFor && pip.classList.contains('show')) { const n = pip.querySelector('[data-pnote]'); if (n) n.textContent = pipNote(byId(pipFor)); }
}
$('#lines').addEventListener('click', e => {
  const b = e.target.closest('[data-lq]'); if (!b) return;
  const k = b.closest('.line').dataset.k; cart[k] = (cart[k]||0) + +b.dataset.lq; if (cart[k]<=0) delete cart[k];
  saveCart(); updateCart();
});
$('#sumbox').addEventListener('click', e => { if (e.target.id==='checkout') toastMsg('V návrhu tu nasleduje pokladňa: doprava, platba, fakturačné údaje.'); });
function openCart(){ hidePip(); $('#drawer').classList.add('show'); scrim(true); }
function closeCart(){ const d = $('#drawer'); if (!d) return; d.classList.remove('show'); if (!pip.classList.contains('show')) scrim(false); }
$('#cartBtn').addEventListener('click', openCart);
$('#giftPill').addEventListener('click', openCart);
$('#closeCart').addEventListener('click', closeCart);
function scrim(on){ $('#scrim').classList.toggle('show', on); }
$('#scrim').addEventListener('click', () => { hidePip(); closeCart(); if ($('#filters')) $('#filters').classList.remove('show'); scrim(false); });
let toastT; function toastMsg(t){ const el=$('#toast'); el.textContent=t; el.classList.add('show'); clearTimeout(toastT); toastT=setTimeout(()=>el.classList.remove('show'),2600); }

document.addEventListener('click', e => {
  const a = e.target.closest('[data-add]:not(.card [data-add])'); if (a) { const p = byId(a.dataset.add); addToCart(p.id, +(a.dataset.g||100)); return; }
  const b = e.target.closest('[data-bundle]'); if (b) { addBundle(b.dataset.bundle); return; }
  if (e.target.closest('[data-open-cart]')) openCart();
});

/* ================= THEME + SEARCH ================= */
$('#themeT').addEventListener('click', () => {
  const r = document.documentElement, cur = r.dataset.theme || (matchMedia('(prefers-color-scheme:dark)').matches ? 'dark' : 'light');
  r.dataset.theme = cur === 'dark' ? 'light' : 'dark';
});
if (page !== 'shop') {
  $('#q').addEventListener('keydown', e => { if (e.key==='Enter') { const v = e.target.value.trim().toLowerCase(); const m = P.find(p=>(p.name+' '+p.kind).toLowerCase().includes(v)); location.href = 'obchod.html' + (m ? '#p-'+m.id : ''); } });
}

/* ================= ORIGINS (any page) ================= */
if ($('#originGrid')) {
  const byO = {}; P.forEach(p => (byO[p.o] ||= []).push(p.name));
  const order = ['Uganda','Uzbekistan','Vietnam','Turecko','Španielsko','Srbsko','Poľsko','Taliansko','Egypt','Argentína','Maďarsko','Slovensko'];
  $('#originGrid').innerHTML = order.filter(o=>byO[o]).map(o => `<div class="org"><span class="flag">${ORIGINS[o][0]}</span><h3>${o}</h3><span class="what">${byO[o].join(', ')}</span><span class="geo">${ORIGINS[o][1]} · ${ORIGINS[o][2]==='u nás'?'u nás':ORIGINS[o][2]+' od Bratislavy'}</span></div>`).join('');
}

const AD = window.AD = {P, CATS, W, BUNDLES, DEAL, GIFTS, F, sel, PROPS, WEIGHT_CHIPS, XXL_MIN, $, $$, fmt, wlabel, priceOf, listPrice, weightsOf, byId, subOf, esc, img, count,
  cardHTML, shownWeight, showPip, hidePip, scrim, closeMega, bundlePrice, bundleSum, totals, updateCart, toastMsg, onWeight:null};

/* ================= SHOP PAGE ================= */
if (page === 'shop') {
  $('#fCats').innerHTML = CATS.map(c => `<label><input type="checkbox" data-fcat="${c.id}"> <b>${c.name}</b></label>` +
    c.subs.filter(s=>!s.soon).map(s=>`<label class="sub"><input type="checkbox" data-fsub="${s.id}"> ${s.name}<span class="c">${count(s.id)}</span></label>`).join('')).join('');
  $('#fWeights').innerHTML = WEIGHT_CHIPS.map(g=>`<button type="button" class="chip" data-fw="${g}" aria-pressed="false">${wlabel(g)}</button>`).join('') +
    `<button type="button" class="chip xxl" data-fxxl aria-pressed="false">XXL</button>`;
  $('#fProps').innerHTML = PROPS.map(([k,l])=>`<label><input type="checkbox" data-fprop="${k}"> ${l}<span class="c">${P.filter(p=>p[k]).length}</span></label>`).join('');
  const origins = [...new Set(P.map(p=>p.o))].sort((a,b)=>a.localeCompare(b,'sk'));
  $('#fOrigin').innerHTML = origins.map(o=>`<label><input type="checkbox" data-forig="${esc(o)}"> ${o}<span class="c">${P.filter(p=>p.o===o).length}</span></label>`).join('');

  $('#filters').addEventListener('change', e => {
    const t = e.target;
    if (t.dataset.fcat) CATS.find(c=>c.id===t.dataset.fcat).subs.forEach(s=>{ if(!s.soon){ t.checked ? F.subs.add(s.id) : F.subs.delete(s.id);} });
    if (t.dataset.fsub) t.checked ? F.subs.add(t.dataset.fsub) : F.subs.delete(t.dataset.fsub);
    if (t.dataset.fprop) t.checked ? F.props.add(t.dataset.fprop) : F.props.delete(t.dataset.fprop);
    if (t.dataset.forig) t.checked ? F.origins.add(t.dataset.forig) : F.origins.delete(t.dataset.forig);
    syncFilterUI(); render();
  });
  $('#filters').addEventListener('click', e => {
    const b = e.target.closest('button'); if (!b) return;
    if (b.dataset.fw) { const g = +b.dataset.fw; F.weight = F.weight===g ? null : g; F.xxl = false; }
    if ('fxxl' in b.dataset) { F.xxl = !F.xxl; F.weight = null; }
    if (b.id === 'fReset') resetF(true);
    if (b.id === 'fClose') { $('#filters').classList.remove('show'); scrim(false); return; }
    syncFilterUI(); render();
  });
  $('#fPrice').addEventListener('input', e => { F.max = +e.target.value; syncFilterUI(); render(); });
  $('#q').addEventListener('input', e => { F.q = e.target.value.trim().toLowerCase(); render(); });
  $('#sort').addEventListener('change', e => { F.sort = e.target.value; render(); });
  $('#fOpen').addEventListener('click', () => { $('#filters').classList.add('show'); scrim(true); });

  function resetF(all){ F.subs.clear(); F.props.clear(); F.origins.clear(); F.weight=null; F.xxl=false; F.max=40; if (all){ F.q=''; $('#q').value=''; } }
  function syncFilterUI(){
    $$('[data-fsub]').forEach(i=>i.checked=F.subs.has(i.dataset.fsub));
    $$('[data-fcat]').forEach(i=>{ const s=CATS.find(c=>c.id===i.dataset.fcat).subs.filter(x=>!x.soon); i.checked = s.every(x=>F.subs.has(x.id)); i.indeterminate = !i.checked && s.some(x=>F.subs.has(x.id)); });
    $$('[data-fprop]').forEach(i=>i.checked=F.props.has(i.dataset.fprop));
    $$('[data-forig]').forEach(i=>i.checked=F.origins.has(i.dataset.forig));
    $$('[data-fw]').forEach(b=>b.setAttribute('aria-pressed', F.weight===+b.dataset.fw));
    $('[data-fxxl]').setAttribute('aria-pressed', F.xxl);
    $('#fPrice').value = F.max; $('#fPriceOut').textContent = F.max>=40 ? 'bez limitu' : F.max+' €';
    const act = [];
    F.subs.forEach(s=>act.push(['sub',s,subOf(s).name]));
    if (F.weight) act.push(['w',F.weight,wlabel(F.weight)]);
    if (F.xxl) act.push(['xxl',1,'XXL']);
    F.props.forEach(k=>act.push(['prop',k,PROPS.find(x=>x[0]===k)[1]]));
    F.origins.forEach(o=>act.push(['orig',o,o]));
    if (F.max<40) act.push(['max',1,'do '+F.max+' €']);
    $('#activeF').innerHTML = act.map(([t,v,l])=>`<button type="button" data-rm="${t}" data-v="${esc(v)}" aria-label="Zrušiť filter ${esc(l)}">${esc(l)} ✕</button>`).join('');
  }
  $('#activeF').addEventListener('click', e => {
    const b = e.target.closest('button'); if (!b) return;
    const {rm, v} = b.dataset;
    if (rm==='sub') F.subs.delete(v); if (rm==='w') F.weight=null; if (rm==='xxl') F.xxl=false;
    if (rm==='prop') F.props.delete(v); if (rm==='orig') F.origins.delete(v); if (rm==='max') F.max=40;
    syncFilterUI(); render();
  });
  function visible(){
    const list = P.filter(p => {
      if (F.subs.size && !F.subs.has(p.sub)) return false;
      if (F.weight && !weightsOf(p).includes(F.weight)) return false;
      for (const k of F.props) if (!p[k]) return false;
      if (F.origins.size && !F.origins.has(p.o)) return false;
      if (F.q && !(p.name+' '+p.kind+' '+p.o+' '+subOf(p.sub).name).toLowerCase().includes(F.q)) return false;
      if (F.max < 40 && priceOf(p,shownWeight(p)) > F.max) return false;
      return true;
    });
    const key = { cheap: p=>priceOf(p,shownWeight(p)), exp: p=>-priceOf(p,shownWeight(p)), p100: p=>priceOf(p,shownWeight(p))/shownWeight(p) };
    return list.sort((a,b)=> F.sort==='name' ? a.name.localeCompare(b.name,'sk') : key[F.sort](a)-key[F.sort](b));
  }
  function render(){
    const list = visible();
    $('#grid').innerHTML = list.length ? list.map(cardHTML).join('') : '<div class="empty"><b>Nič sme nenašli.</b><br>Skús zrušiť niektorý filter.</div>';
    $('#found').textContent = list.length + (list.length===1?' produkt':list.length<5&&list.length>1?' produkty':' produktov');
  }
  AD.onWeight = () => render();
  function applyHash(){
    const h = decodeURIComponent(location.hash.slice(1));
    if (!h) return;
    resetF(false);
    let openId = null;
    if (h.startsWith('p-')) openId = h.slice(2);
    else if (CATS.some(c=>c.id===h)) CATS.find(c=>c.id===h).subs.forEach(s=>{ if(!s.soon) F.subs.add(s.id); });
    else if (subOf(h)) F.subs.add(h);
    else if (h==='akcia') F.props.add('promo');
    else if (h==='xxl') F.xxl = true;
    else if (h==='vzorky') F.weight = 30;
    else if (h==='bio') { F.props.add('bio'); F.props.add('nosugar'); }
    syncFilterUI(); render();
    $('#obchod').scrollIntoView();
    if (openId && byId(openId)) setTimeout(()=>{ const c = document.querySelector(`.card[data-id="${openId}"]`); if (c) { c.scrollIntoView({block:'center'}); showPip(c, true); } }, 60);
  }
  addEventListener('hashchange', applyHash);
  syncFilterUI(); render(); applyHash();
}

updateCart();
document.dispatchEvent(new CustomEvent('ad:ready'));
})();
