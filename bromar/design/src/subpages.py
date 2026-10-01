#!/usr/bin/env python3
"""Content of the product subpages. Writes design/src/pages/<slug>.html (run by tools/build_site.py)."""
import pathlib

PAGES = pathlib.Path(__file__).resolve().parent / "pages"
ARR = '<svg width="14" height="14"><use href="#i-arr"/></svg>'
CHECK = '<svg width="15" height="15"><use href="#i-check"/></svg>'


def hero(crumb, eyebrow, title, lead, media, checks, cta="Nezáväzná ponuka"):
    checks_html = "".join(f"<span>{CHECK}{c}</span>" for c in checks)
    return f"""<section class="ph-hero">
  <div class="wrap ph-grid">
    <div>
      <nav class="crumbs" aria-label="Omrvinky"><a href="index.html">Úvod</a><span>/</span><span>{crumb}</span></nav>
      <span class="eyebrow">{eyebrow}</span>
      <h1>{title}</h1>
      <p class="lead">{lead}</p>
      <div class="ph-btns"><a class="btn btn-red" href="#kontakt">{cta} <span class="arr">{ARR}</span></a><a class="btn btn-out" href="tel:+421900000000">Zavolať +421 900 000 000</a></div>
      <div class="ph-checks">{checks_html}</div>
    </div>
    {media}
  </div>
</section>
"""


def photo(img, alt, tag_title, tag_text, pos="50% 50%"):
    return f"""<div class="ph-img"><img src="%%IMG:{img}%%" alt="{alt}" style="object-position:{pos}"><div class="blinds closed" data-reveal aria-hidden="true"></div><div class="tagline"><svg width="26" height="26" style="color:var(--red);flex-shrink:0"><use href="#i-check"/></svg><div><b>{tag_title}</b><small>{tag_text}</small></div></div></div>"""


def feats(eyebrow, title, items, lead="", bg=""):
    cards = "".join(f'<div class="feat rv d{i % 4}"><div class="ic"><svg width="24" height="24"><use href="#i-{ic}"/></svg></div><h4>{h}</h4><p>{p}</p></div>' for i, (ic, h, p) in enumerate(items))
    lead_html = f'<p class="lead rv d2">{lead}</p>' if lead else "<div></div>"
    return f"""<section class="sec-sm{' on-sand' if bg else ''}" style="{f'background:var(--{bg})' if bg else ''}">
  <div class="wrap">
    <div class="sec-head"><div><span class="eyebrow rv">{eyebrow}</span><h2 class="h2 rv d1">{title}</h2></div>{lead_html}</div>
    <div class="feat-grid">{cards}</div>
  </div>
</section>
"""


def types(eyebrow, title, items, lead="", bg=""):
    cards = ""
    for i, (visual, h, p, bullets) in enumerate(items):
        lis = "".join(f"<li>{b}</li>" for b in bullets)
        cards += f'<div class="type rv d{i % 4}"><div class="tv">{visual}</div><div class="bd"><h3>{h}</h3><p>{p}</p><ul>{lis}</ul></div></div>'
    lead_html = f'<p class="lead rv d2">{lead}</p>' if lead else "<div></div>"
    return f"""<section class="sec-sm" style="{f'background:var(--{bg})' if bg else ''}">
  <div class="wrap">
    <div class="sec-head"><div><span class="eyebrow rv">{eyebrow}</span><h2 class="h2 rv d1">{title}</h2></div>{lead_html}</div>
    <div class="types">{cards}</div>
  </div>
</section>
"""


def img(name, alt, pos="50% 50%"):
    return f'<img src="%%IMG:{name}%%" alt="{alt}" style="object-position:{pos}">'


def gallery(title, items):
    figs = ""
    for name, cap, *extra in items:
        cls = ' class="tall"' if extra and extra[0] == "tall" else ""
        if name.endswith(".mp4"):
            base = name[:-4]
            figs += f'<figure class="gv"><video autoplay muted loop playsinline preload="auto" aria-label="{cap}"><source src="%%IMG:{base}.webm%%" type="video/webm"><source src="%%IMG:{name}%%" type="video/mp4"></video><figcaption>Video: {cap}</figcaption></figure>'
        else:
            figs += f'<figure{cls}><img src="%%IMG:{name}%%" alt="{cap}"><figcaption>{cap}</figcaption></figure>'
    return f"""<section class="sec-sm">
  <div class="wrap">
    <div class="sec-head"><div><span class="eyebrow rv">Realizácie</span><h2 class="h2 rv d1">{title}</h2></div><p class="lead rv d2">Fotky z našich montáží. Po kliknutí sa fotka zväčší.</p></div>
    <div class="pgal rv">{figs}</div>
  </div>
</section>
"""


def faq(items):
    det = "".join(f'<details class="rv"{" open" if i == 0 else ""}><summary>{q}</summary><p>{a}</p></details>' for i, (q, a) in enumerate(items))
    return f"""<section class="sec-sm" style="background:var(--paper)">
  <div class="wrap faq-grid">
    <div><span class="eyebrow rv">Časté otázky</span><h2 class="h2 rv d1" style="margin:18px 0 20px">Na čo sa pýtate</h2><p class="rv d2">Nenašli ste odpoveď? Zavolajte nám na <a class="link" href="tel:+421900000000">+421 900 000 000</a></p></div>
    <div>{det}</div>
  </div>
</section>
"""


def box_svg(kind):
    """Small wall cross-section with the box position (predokenný / podomietkový / preklad)."""
    box = {"pred": '<rect x="116" y="42" width="24" height="30" rx="3" fill="#1c2a3e"/><path d="M128 72v58" stroke="#b5302a" stroke-width="3" stroke-dasharray="3 3"/>',
           "pod": '<rect x="88" y="34" width="30" height="26" rx="3" fill="#1c2a3e"/><path d="M103 60v70" stroke="#c0141c" stroke-width="3" stroke-dasharray="3 3"/>',
           "nad": '<rect x="72" y="32" width="36" height="26" rx="3" fill="#1c2a3e"/><path d="M90 58v72" stroke="#c0141c" stroke-width="3" stroke-dasharray="3 3"/>'}[kind]
    ins = 44 if kind == "pod" else 30
    return f'<svg viewBox="0 0 150 130" aria-hidden="true"><rect x="20" y="0" width="60" height="130" fill="#d9d2c6"/><rect x="80" y="0" width="{ins}" height="130" fill="#efe9df"/><rect x="{80 + ins}" y="0" width="4" height="130" fill="#cfc6b8"/><rect x="20" y="{30 if kind == "nad" else 42}" width="{94 if kind != "pod" else 60}" height="{30 if kind == "nad" else 18}" fill="#b9b0a2"/><rect x="40" y="60" width="26" height="70" fill="#2e3136"/><rect x="46" y="60" width="14" height="70" fill="#9fb3c2"/>{box}</svg>'


def page(slug, title, description, product, body):
    head = f'<!--page title="{title}" description="{description}" product="{product}" -->\n'
    (PAGES / f"{slug}.html").write_text(head + body + "{{> partials/form}}\n{{> partials/next}}\n", encoding="utf-8")


RAL = """<section class="sec-sm" style="padding-top:0">
  <div class="wrap">
    <div class="sec-head"><div><span class="eyebrow rv">Farby</span><h2 class="h2 rv d1">Farba lamiel k fasáde aj oknám</h2></div><p class="lead rv d2">Najčastejšie volíme antracit k tmavým oknám a striebornú k bielym. Vzorkovník s ďalšími odtieňmi RAL vám prinesieme na zameranie.</p></div>
    <div class="ral rv"><div><i style="background:#383e42"></i>RAL 7016<br>antracit</div><div><i style="background:#a5a5a5"></i>RAL 9006<br>strieborná</div><div><i style="background:#8f8f8c"></i>RAL 9007<br>sivý hliník</div><div><i style="background:#c5c7c4"></i>RAL 7035<br>svetlosivá</div><div><i style="background:#f1ece1"></i>RAL 9010<br>biela</div><div><i style="background:#4a3526"></i>RAL 8014<br>hnedá</div><div><i style="background:#1d1e20"></i>RAL 9005<br>čierna</div></div>
  </div>
</section>
"""

page("zaluzie", "Vonkajšie žalúzie na mieru | BROMAR", "Vonkajšie žalúzie s podomietkovým alebo predokenným boxom, lamely C-80, Z-90, S-90, F-80 a motory Somfy. Zameranie zdarma, 5 rokov servis zdarma.", "zaluzie",
     hero("Vonkajšie žalúzie", "Vonkajšie žalúzie", "Vonkajšie žalúzie <em>na mieru</em>",
          "Zastavia slnko ešte pred sklom, takže v lete je doma citeľne chladnejšie. Natočením lamiel si nastavíte svetlo aj súkromie. Box ukryjeme pod omietku alebo ho namontujeme na hotovú fasádu.",
          photo("real-terrace.webp", "Antracitové vonkajšie žalúzie na terase – realizácia BROMAR", "Realizácia BROMAR", "antracit, podomietkový box", "50% 30%"),
          ["Podomietkové aj predokenné", "Motory Somfy", "5 rokov servis zdarma"])
     + feats("Prečo vonkajšie žalúzie", "Najúčinnejšie tienenie, aké na okno dáte", [
         ("sun", "Chladnejší dom", "Žalúzia zachytí slnko pred oknom. Teplo sa k sklu ani nedostane."),
         ("blind", "Svetlo podľa vás", "Lamely natočíte presne tak, ako potrebujete: od plného svetla po tmu."),
         ("home", "Súkromie", "Cez natočené lamely vidíte von, no zvonka do domu nie."),
         ("wind", "Odolné", "Hliníkové lamely v bočnom vedení. So senzorom vetra sa pri víchrici samy vytiahnu.")])
     + "{{> sections/zaluzie}}\n" + RAL
     + gallery("Vonkajšie žalúzie z našich montáží", [("real-corner.webp", "Rohové žalúzie na terase"), ("real-bungalow.webp", "Novostavba so žalúziami"), ("real-terrace.webp", "Žalúzie na terase", "tall"), ("real-loggia.webp", "Žalúzie na lodžii"), ("real-brown.webp", "Hnedé žalúzie k dreveným oknám"), ("real-carport.webp", "Žalúzie na terasovej stene"), ("real-black.webp", "Čierne žalúzie"), ("real-silver.webp", "Strieborné lamely"), ("real-blinds-card.webp", "Rodinný dom, predokenný box")])
     + faq([("Dajú sa vonkajšie žalúzie namontovať aj do hotového domu?", "Áno. Na hotovú fasádu sa montuje predokenný box. Ak plánujete zatepľovanie, je to ideálny čas na podomietkový box, ktorý ostane skrytý."),
            ("Koľko stojí vonkajšia žalúzia?", "Cena závisí od rozmeru okna, typu lamely, boxu a ovládania. Po bezplatnom zameraní dostanete presnú ponuku bez skrytých položiek."),
            ("Čo sa stane pri silnom vetre?", "So senzorom vetra Somfy sa žalúzie pri nárazovom vetre samy vytiahnu do boxu, aj keď nie ste doma."),
            ("Ktorú lamelu si vybrať?", "C-80 je obľúbená klasika, Z-90 s tesnením najlepšie zatemní a je najtichšia. Ukážeme vám vzorky a poradíme podľa toho, na čo miestnosť používate.")]))

page("screeny", "Screenové rolety ZIP | BROMAR", "Screenové rolety so ZIP vedením na veľké okná a terasy. Tienenie s výhľadom, ochrana pred hmyzom, motory Somfy.", "screen",
     hero("Screenové rolety", "Screenové rolety ZIP", "Tienenie, cez ktoré <em>vidíte von</em>",
          "Technická tkanina vo ZIP vedení zachytí väčšinu slnečného tepla a pritom zachová výhľad. Ideálne na veľké presklené steny, posuvné dvere a terasy.",
          photo("real-screen-terrace.webp", "ZIP screen na terase s posedením – realizácia BROMAR", "Realizácia BROMAR", "ZIP screen, antracit", "45% 50%"),
          ["ZIP vedenie", "Aj na veľké plochy", "Motory Somfy"])
     + feats("Prečo screen", "Jemné tienenie pre veľké okná", [
         ("sun", "Menej tepla", "Tkanina zastaví slnko pred sklom, miestnosť sa neprehrieva."),
         ("home", "Výhľad zostáva", "Cez priehľadnú tkaninu vidíte von, zvonka dnu takmer nie."),
         ("wind", "Odolné vetru", "Okraje látky sú zasunuté v bočných lištách, látka nevylieta."),
         ("net", "Bez hmyzu", "Zatiahnutý screen funguje aj ako sieť proti komárom.")])
     + types("Typ boxu", "Box podľa fasády", [
         (box_svg("pred"), "Hranatý box", "Moderný vzhľad k rovným líniám fasády. Montuje sa na fasádu alebo do ostenia.", ["aj do hotového domu", "farba podľa RAL"]),
         (box_svg("pred"), "Zaoblený box", "Mäkší tvar ku klasickým domom.", ["aj do hotového domu", "nenápadný"]),
         (box_svg("pod"), "Podomietkový box", "Box ukrytý v zateplení, na fasáde ostane len štrbina.", ["novostavba alebo zatepľovanie", "najčistejší vzhľad"])], bg="sand")
     + """<section class="sec-sm"><div class="wrap split"><div><span class="eyebrow rv">Tkaniny</span><h2 class="h2 rv d1" style="margin:18px 0 20px">Priehľadné alebo zatemňovacie</h2><p class="lead rv d2">Priehľadná tkanina tieni a nechá výhľad. Zatemňovacia (blackout) spraví v miestnosti tmu, hodí sa do spální. Farbu vyberiete zo vzorkovníka.</p>
       <span class="swatches rv" style="margin-top:22px"><span style="background-color:#3b3e42" data-n="Antracit"></span><span style="background-color:#6d6e6c" data-n="Sivá"></span><span style="background-color:#a79c8a" data-n="Piesková"></span><span style="background-color:#6f5f4f" data-n="Bronzová"></span><span style="background-color:#e6e2da" data-n="Perlová"></span><span style="background-color:#1f2c3f" data-n="Tmavomodrá"></span></span></div>
       <div class="spec-wrap rv"><table class="spec"><thead><tr><th>Vlastnosť</th><th>Priehľadná</th><th>Blackout</th></tr></thead><tbody><tr><td>Výhľad von</td><td>áno</td><td>nie</td></tr><tr><td>Tienenie</td><td>vysoké</td><td>úplné</td></tr><tr><td>Vhodné do</td><td>obývačky, kuchyne, kancelárie</td><td>spálne, detské izby</td></tr><tr><td>Ovládanie</td><td colspan="2">motor Somfy s ovládačom alebo vypínačom</td></tr></tbody></table></div></div></section>
"""
     + gallery("Screeny z našich montáží", [("real-screen-terrace.webp", "Screen vytiahnutý, terasa otvorená"), ("real-screen.webp", "Screen zatiahnutý")])
     + faq([("Aký je rozdiel medzi žalúziou a screenovou roletou?", "Žalúzia má natáčacie lamely a dá sa takmer úplne zatemniť. Screen je tkanina, tieni rovnomerne, pôsobí jemne a zachová výhľad von."),
            ("Vydrží screen vietor?", "Vďaka ZIP vedeniu je látka po celej výške uchytená v bočných lištách, preto je odolnejšia ako bežná roleta. Pri víchrici ho odporúčame vytiahnuť, so senzorom vetra sa to stane samo."),
            ("Dá sa screen namontovať aj na existujúce okno?", "Áno, hranatý alebo zaoblený box sa montuje na fasádu alebo do ostenia aj na hotový dom.")]))

page("rolety", "Vonkajšie rolety plastové a hliníkové | BROMAR", "Vonkajšie rolety z plastu alebo hliníka s PUR penou. Zatemnenie, izolácia a bezpečnosť. Zameranie zdarma.", "rolety",
     hero("Vonkajšie rolety", "Vonkajšie rolety", "Tma na spanie, ticho <em>a pokoj</em>",
          "Rolety úplne zatemnia miestnosť, stlmia hluk z ulice a v zime pomáhajú udržať teplo. Vyberiete si plastové alebo hliníkové, s ručným ovládaním alebo motorom Somfy.",
          photo("real-rollers.webp", "Biele vonkajšie rolety na prízemí domu – realizácia BROMAR", "Realizácia BROMAR", "biele rolety, prízemie", "40% 50%"),
          ["Plastové aj hliníkové", "Úplné zatemnenie", "5 rokov servis zdarma"])
     + "{{> sections/rolety}}\n"
     + types("Typ boxu", "Kam ukryjeme box rolety", [
         (box_svg("pred"), "Predokenný box", "Box na fasáde nad oknom. Najjednoduchšie riešenie pre hotové domy.", ["aj do hotového domu", "rýchla montáž"]),
         (box_svg("pod"), "Podomietkový box", "Box skrytý v zateplení, viditeľná ostane len štrbina.", ["pri zatepľovaní", "čistý vzhľad"]),
         (box_svg("nad"), "Nadokenný box", "Box nad oknom v preklade alebo ako súčasť okna.", ["novostavby", "pri výmene okien"])], bg="sand")
     + feats("Ovládanie", "Ako budete roletu ovládať", [
         ("hand", "Popruh", "Najjednoduchšie ručné ovládanie, vhodné na menšie okná."),
         ("hand", "Kľuka", "Ručné ovládanie aj pre väčšie a ťažšie rolety."),
         ("motor", "Motor Somfy", "Tichý motor s vypínačom pri okne alebo ovládačom."),
         ("remote", "Skupiny okien", "Jedným tlačidlom zatiahnete všetky rolety na poschodí.")])
     + gallery("Rolety z našich montáží", [("real-rollers.webp", "Nové rolety na prízemí"), ("video-rollers.mp4", "nové rolety"), ("real-flats.webp", "Bytový dom")])
     + faq([("Plastové alebo hliníkové?", "Plastové sú cenovo priaznivejšie a stačia na menšie a stredné okná. Hliníkové s PUR penou lepšie izolujú, sú pevnejšie a zvládnu aj veľké okná a dvere."),
            ("Dá sa roleta dorobiť k existujúcemu oknu?", "Áno, s predokenným boxom aj na hotový dom. Pri výmene okien sa dá roleta objednať rovno s oknom."),
            ("Dá sa ručná roleta neskôr zmotorizovať?", "Vo väčšine prípadov áno. Posúdime to pri obhliadke a namontujeme motor Somfy.")]))

page("pergoly", "Hliníkové pergoly | BROMAR", "Hliníkové pergoly s pevnou strechou aj bioklimatické s otočnými lamelami. LED, screeny a zasklenie. Zameranie zdarma.", "pergola",
     hero("Hliníkové pergoly", "Hliníkové pergoly", "Terasa, ktorá sa prispôsobí <em>počasiu</em>",
          "Hliníkovú pergolu postavíme k domu aj samostatne. Vyberiete si pevnú strechu alebo bioklimatické otočné lamely a doplníte LED osvetlenie, bočné screeny či posuvné zasklenie.",
          photo("real-pergola-side.webp", "Hliníková pergola s pevnou strechou pri rodinnom dome – realizácia BROMAR", "Realizácia BROMAR", "hliníková pergola, antracit", "50% 40%"),
          ["Hliník bez údržby", "Na mieru k domu", "Montáž vlastnými ľuďmi"])
     + types("Typy pergol", "Pevná strecha alebo otočné lamely", [
         (img("real-pergola-wide.webp", "Pergola s pevnou strechou", "60% 50%"), "Pergola s pevnou strechou", "Hliníková konštrukcia so strechou z polykarbonátu alebo skla. Spoľahlivo chráni pred dažďom aj slnkom.", ["cenovo dostupnejšia", "strecha z polykarbonátu alebo skla", "realizácia na fotke"]),
         (img("card-pergola.webp", "Bioklimatická pergola – vizualizácia"), "Bioklimatická pergola", "Strechu tvoria hliníkové lamely, ktoré motorom natočíte. Otvoríte ich na slnko a vzduch, zatvoríte pred dažďom.", ["otočné lamely s motorom", "senzor dažďa", "obrázok je vizualizácia"])], bg="sand")
     + "{{> sections/pergoly}}\n"
     + feats("Doplnky", "S čím pergolu doplniť", [
         ("sun", "LED osvetlenie", "Stmievateľné LED pásy v ráme pre večery na terase."),
         ("blind", "Bočné ZIP screeny", "Ochrana pred vetrom, nízkym slnkom aj pohľadmi."),
         ("glass", "Posuvné zasklenie", "Z pergoly spravíte uzavretú terasu na jar aj jeseň."),
         ("motor", "Motory Somfy", "Lamely aj screeny ovládate jedným ovládačom.")])
     + gallery("Pergoly z našich montáží", [("real-pergola-wide.webp", "Pergola s pevnou strechou"), ("real-pergola-side.webp", "Pergola z boku")])
     + faq([("Potrebujem na pergolu povolenie?", "Záleží od veľkosti pergoly a od obce. Pri zameraní vám povieme, čo bude treba, a s podkladmi pomôžeme."),
            ("Aký je rozdiel medzi pevnou a bioklimatickou strechou?", "Pevná strecha z polykarbonátu alebo skla je stále zatvorená. Bioklimatická má otočné lamely, takže si sami určíte, koľko slnka a vzduchu pustíte dnu."),
            ("Dá sa pergola neskôr doplniť o screeny alebo zasklenie?", "Áno. Pri návrhu s tým vieme počítať, aby sa doplnky dali neskôr jednoducho namontovať.")]))

page("zasklenia", "Hliníkové zasklenia a zimné záhrady | BROMAR", "Posuvné hliníkové zasklenie terás a pergol, zasklenie balkónov a lodžií, zimné záhrady. Zameranie zdarma.", "zahrada",
     hero("Zasklenia", "Hliníkové zasklenia", "Terasa, ktorú využijete <em>aj v októbri</em>",
          "Hliníkové posuvné zasklenie uzavrie pergolu, terasu alebo balkón pred vetrom, dažďom a prachom. Keď je teplo, sklá posuniete nabok a priestor je opäť otvorený.",
          '<div class="ph-img illu">{{> partials/glass-illu}}</div>',
          ["Hliníkové profily", "Bezpečnostné sklo", "Zameranie zdarma"])
     + types("Čo zasklievame", "Tri spôsoby, ako získať priestor navyše", [
         ('<svg viewBox="0 0 200 120" aria-hidden="true"><rect x="10" y="20" width="180" height="8" fill="#2e3136"/><rect x="14" y="28" width="6" height="84" fill="#2e3136"/><rect x="180" y="28" width="6" height="84" fill="#2e3136"/><g fill="#cfe0ec" fill-opacity=".6" stroke="#3b3f45" stroke-width="2"><rect x="22" y="30" width="40" height="80"/><rect x="60" y="30" width="40" height="80"/><rect x="98" y="30" width="40" height="80"/><rect x="136" y="30" width="42" height="80"/></g></svg>', "Zasklenie terasy a pergoly", "Posuvné sklenené steny pod pergolu, prístrešok alebo presah strechy.", ["profily vo farbe pergoly", "sklá sa zasunú za seba"]),
         ('<svg viewBox="0 0 200 120" aria-hidden="true"><rect x="30" y="10" width="140" height="100" fill="#e3dccf"/><rect x="40" y="60" width="120" height="44" fill="#cfe0ec" fill-opacity=".7" stroke="#3b3f45" stroke-width="2"/><path d="M70 60v44M100 60v44M130 60v44" stroke="#3b3f45" stroke-width="2"/><rect x="40" y="20" width="120" height="36" fill="#cfe0ec" fill-opacity=".5" stroke="#3b3f45" stroke-width="2"/></svg>', "Balkóny a lodžie", "Zasklenie balkónov na rodinných aj bytových domoch.", ["bezpečnostné sklo", "pri bytovke poradíme so správcom"]),
         ('<svg viewBox="0 0 200 120" aria-hidden="true"><path d="M20 50 L100 20 L180 50 Z" fill="#cfe0ec" fill-opacity=".6" stroke="#2e3136" stroke-width="3"/><rect x="20" y="50" width="160" height="60" fill="#cfe0ec" fill-opacity=".45" stroke="#2e3136" stroke-width="3"/><path d="M60 50v60M100 50v60M140 50v60" stroke="#2e3136" stroke-width="2"/></svg>', "Zimné záhrady", "Hliníková konštrukcia so zasklením, ktorá rozšíri obývačku o svetlú miestnosť.", ["na mieru k domu", "doplníte tienením"])], bg="sand")
     + feats("Prečo zasklenie", "Čo vám zasklenie prinesie", [
         ("wind", "Bez vetra a dažďa", "Terasu používate aj v zlom počasí, nábytok zostane suchý."),
         ("sun", "Dlhšia sezóna", "Na jar a na jeseň je za sklom príjemne teplo."),
         ("shield", "Bezpečnostné sklo", "Používame tvrdené bezpečnostné sklo."),
         ("tool", "Hliník bez údržby", "Profily netreba natierať, stačí ich občas umyť.")])
     + faq([("Dá sa zasklenie kombinovať s pergolou?", "Áno, posuvné zasklenie je bežný doplnok k pergole. Pri návrhu pergoly s ním vieme počítať."),
            ("Dá sa zasklený priestor aj tieniť?", "Áno, ku zaskleniu sa dajú doplniť screeny, žalúzie alebo vnútorné tienenie."),
            ("Potrebujem na zasklenie balkóna súhlas?", "Pri bytovom dome zvyčajne áno, od správcu alebo spoločenstva vlastníkov. Poradíme vám, aké podklady pripraviť.")]))

page("interier", "Vnútorné tienenie | BROMAR", "Vnútorné žalúzie, látkové rolety, deň a noc, plisé a vertikálne žalúzie na mieru. Zameranie zdarma.", "interier",
     hero("Vnútorné tienenie", "Vnútorné tienenie", "Posledný detail, ktorý <em>dotvorí interiér</em>",
          "Horizontálne a vertikálne žalúzie, látkové rolety, deň a noc aj plisé. Pomôžeme vybrať farbu a materiál k vášmu interiéru a všetko presne zameriame.",
          photo("real-interior.webp", "Vertikálne žalúzie v obývačke – realizácia BROMAR", "Realizácia BROMAR", "vertikálne žalúzie", "50% 30%"),
          ["Na mieru", "Veľký výber látok", "Zameranie zdarma"])
     + "{{> sections/interier}}\n"
     + feats("Ako vybrať", "Na čo sa pri výbere pozrieť", [
         ("sun", "Koľko svetla", "Do spálne zatemňovaciu látku, do obývačky radšej priesvitnú."),
         ("blind", "Typ okna", "Na strešné a atypické okná sa najlepšie hodí plisé."),
         ("home", "Štýl interiéru", "Drevené žalúzie pôsobia teplo, látkové rolety jemne a moderne."),
         ("remote", "Ovládanie", "Retiazka, šnúra alebo motor, aj na ťažko dostupné okná.")])
     + faq([("Stačí mi vnútorné tienenie, alebo potrebujem vonkajšie?", "Vnútorné tienenie upraví svetlo a súkromie, ale teplo už je za sklom. Ak sa dom v lete prehrieva, pomôžu vonkajšie žalúzie alebo screeny."),
            ("Dajú sa látky prať?", "Pri väčšine látkových roliet a vertikálnych žalúzií áno. Pri výbere vám povieme, ako sa o konkrétnu látku starať.")]))

page("somfy", "Motory Somfy | BROMAR", "Motory a ovládanie Somfy pre žalúzie, rolety, screeny a pergoly. Tiché, spoľahlivé, s dlhou životnosťou.", "somfy",
     hero("Motory Somfy", "Motory Somfy", "Kvalitný motor je základ, ktorý <em>nevidno</em>",
          "Do všetkého, čo motorizujeme, dávame pohony Somfy. Sú tiché, presné a vydržia roky. Radšej použijeme kvalitný motor, než aby sme sa k vám vracali opravovať lacný.",
          photo("real-corner.webp", "Vonkajšie žalúzie s motormi Somfy – realizácia BROMAR", "Motory Somfy", "v každej našej žalúzii s motorom", "60% 50%"),
          ["Tichý chod", "Ovládač alebo vypínač", "Senzor vetra"])
     + "{{> sections/somfy}}\n"
     + feats("Prečo Somfy", "Prečo nedávame lacnejšie motory", [
         ("motor", "Tradícia od 1969", "Somfy vyrába pohony pre tienenie viac ako 50 rokov."),
         ("check", "Presné polohy", "Motor sa zastaví presne hore aj dole, žalúzia sa nepoškodí."),
         ("remote", "Obľúbená poloha my", "Jedným tlačidlom nastavíte žalúziu do vašej obľúbenej polohy."),
         ("tool", "Servis a diely", "Na Somfy sú dostupné náhradné diely aj po rokoch.")], bg="sand")
     + types("Ovládanie", "Ako môžete tienenie ovládať", [
         ('<svg viewBox="0 0 200 120" aria-hidden="true"><rect x="70" y="20" width="60" height="80" rx="8" fill="#fff" stroke="#cfc6b8" stroke-width="3"/><rect x="84" y="36" width="32" height="20" rx="4" fill="#e9e2d7"/><rect x="84" y="62" width="32" height="20" rx="4" fill="#e9e2d7"/></svg>', "Nástenný vypínač", "Vypínač pri okne, ako na svetlo. Jednoduché a spoľahlivé.", ["bez batérií", "pre jedno okno alebo skupinu"]),
         ('<svg viewBox="0 0 200 120" aria-hidden="true"><rect x="80" y="10" width="40" height="100" rx="20" fill="#fff" stroke="#cfc6b8" stroke-width="3"/><circle cx="100" cy="38" r="9" fill="#e9e2d7"/><circle cx="100" cy="60" r="9" fill="#fbe3e2" stroke="#c0141c"/><circle cx="100" cy="82" r="9" fill="#e9e2d7"/></svg>', "Diaľkový ovládač", "Jednokanálový pre jedno okno alebo viackanálový pre celý dom.", ["tlačidlo my", "skupiny okien"]),
         ('<svg viewBox="0 0 200 120" aria-hidden="true"><circle cx="100" cy="60" r="34" fill="#e9e2d7"/><path d="M78 52h28a8 8 0 1 0-8-8M78 64h38a8 8 0 1 1-8 8" fill="none" stroke="#1c2a3e" stroke-width="4" stroke-linecap="round"/></svg>', "Senzor vetra a slnka", "Pri silnom vetre žalúzie samy vytiahne, pri slnku zatieni.", ["chráni žalúzie aj screeny", "dá sa doplniť neskôr"])])
     + faq([("Dá sa motor doplniť k žalúzii alebo rolete s kľukou?", "Vo väčšine prípadov áno. Pri obhliadke posúdime, či sa dá pôvodné tienenie zmotorizovať."),
            ("Čo keď vypadne elektrina?", "Žalúzia zostane v polohe, v ktorej bola. Po obnovení prúdu ju ovládate ako predtým."),
            ("Prečo je motor Somfy drahší?", "Platíte za tichý chod, presné zastavenie a dlhú životnosť. Lacný motor sa často pokazí skôr a výmena stojí viac, než bol rozdiel v cene.")]))

page("servis", "Servis okien a 5 rokov servis zdarma | BROMAR", "Servis okien: nastavenie, tesnenia, kovanie, kľučky. Na našu montáž 5 rokov servis zdarma.", "servis",
     hero("Servis okien", "Servis okien a tienenia", "Okná, ktoré opäť <em>tesnia</em>",
          "Nastavíme krídla, vymeníme tesnenia a kovanie, opravíme žalúzie aj motory. Na všetko, čo u vás namontujeme, máte 5 rokov servis zdarma.",
          photo("card-service-tall.webp", "Servis plastového okna – vizualizácia", "5 rokov servis zdarma", "na každú našu montáž"),
          ["5 rokov servis zdarma", "Plastové, drevené aj hliníkové", "Servis Somfy"])
     + "{{> sections/servis}}\n"
     + feats("Ako to prebieha", "Servis v troch krokoch", [
         ("phone", "Zavoláte", "Popíšete, čo s oknom alebo žalúziou nie je v poriadku."),
         ("clock", "Dohodneme termín", "Prídeme v termíne, ktorý vám vyhovuje."),
         ("tool", "Opravíme na mieste", "Väčšinu opráv vybavíme hneď, bez výmeny celého okna."),
         ("shield", "5 rokov zdarma", "Pri našej montáži za servis neplatíte.")], bg="sand")
     + faq([("Na čo sa vzťahuje 5 rokov servis zdarma?", "Na všetko, čo u vás namontujeme: kontrolu, nastavenie a drobné opravy bez poplatku za výjazd a prácu. Materiál pri poškodení (napr. po búrke) sa účtuje zvlášť."),
            ("Robíte servis aj na oknách, ktoré ste nemontovali?", "Áno, na bežných plastových, drevených aj hliníkových oknách. Takýto servis je platený, cenu vám povieme vopred."),
            ("Ako často treba okná nastaviť?", "Odporúčame raz za rok skontrolovať a premazať kovanie a na jeseň prepnúť okná do zimného režimu.")]))

print("subpages written")
