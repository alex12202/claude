# Čistímeklimy.sk – návrh webu

Návrh webu pre čistenie klimatizácií (a novo aj radiátorov), doména **cistimeklimy.sk** (Websupport).

- **Homepage:** `index.html` (otvor v prehliadači)
- **Podstránka:** `radiatory.html` – čistenie zaprášených radiátorov / vykurovacích telies
- **Náhľady:** `previews/` (desktop 1440 px, mobil 390 px)

## Sekcie homepage (poradie)

1. Hlavička – logo, menu, telefón
2. Hero – **slider cez celú sekciu** (obrázky sa striedajú a pomaly približujú), vľavo tmavý overlay kvôli čitateľnosti textu, odznak **99,9 % baktérií a plesní**; sekundárne tlačidlá sú oranžové
3. Čierny pás výhod (bez plesní, zásah do 60 min, Bratislava a okolie, odborníci)
4. **Prečo čistiť** – interaktívne porovnanie *pred / po* (posúvač) + zoznam rizík
5. **Nestačí vyčistiť len filtre** – filter vs. rotor
6. Služby (nástenné, kazetové/kanálové, dezinfekcia, **radiátory – nové**)
7. **Ako prebieha čistenie** – 4 kroky s ikonkami (lupa, rozobratá jednotka, sprej, test) + fotky pred / po „Rozdiel, ktorý je vidieť“
8. **Kedy je čas na čistenie / Ako často čistiť**
9. **Referencie**
10. **Mapa pôsobnosti** (Bratislava a okolie, statický špendlík) + rýchla objednávka
11. **Pás nad pätičkou** (CTA) a **pätička**

## Farby (z loga)

| Názov | HEX | Použitie |
|---|---|---|
| Čierna | `#0c0d0d` | nadpisy, „Čistíme“ v logu, tmavé pásy |
| Modrá | `#4b96d1` | „klimy“ v logu, zvýraznené slová, ikony |
| Modrá tmavá | `#1f6aae` | tlačidlá, odkazy (biely text je čitateľný) |
| Nočná modrá | `#0e2c4a` | referencie, pätička |
| Ľadová | `#eef5fb` | svetlé pozadie sekcií |
| Oranžová | `#ec7b2e` | čiara z loga – iba akcenty (linky, ikonky, posúvač) |

Podpisový prvok: **modrá čiara – TEXT – oranžová čiara** nad nadpismi, rovnako ako slogan v logu.

## Písma

**Nadpisy – `Cistime Display`** (`assets/fonts/`, woff2 v rezoch 600/700/800).
V PDF loga je text prevedený na krivky a Illustrator v súbore neuchováva názov písma (sú tam iba predvolené Myriad a Times), preto sa pôvodné písmo nedá z loga vyčítať.
Písmo som určil porovnaním tvarov s ~100 kandidátmi. Najbližšie je **Saira** v najširšom reze (šírka 125 %). Logo má sklon ~22°, čo žiadna bežná kurzíva nemá, preto je `Cistime Display` Saira so sklonom presne 22°, upravená pre tento web (licencia OFL, `assets/fonts/OFL.txt`).
Ak grafička pozná presný názov písma loga a má naň licenciu na web, stačí ho vložiť do `assets/fonts/` a zmeniť `@font-face` v `assets/css/style.css`.

**Text:** Manrope (Google Fonts).

## Logo

`assets/logo/` – `cistimeklimy-logo.svg` (na svetlé pozadie), `cistimeklimy-logo-white.svg` (na tmavé), `cistimeklimy-logo-original.pdf`.

## Čo treba doplniť pred spustením

- **Fotky:** obrázky v `assets/img/` sú len zástupné – vystrihnuté z referenčných návrhov a 4× zväčšené cez AI (Real-ESRGAN). Na technikovom tričku je ešte logo z referenčného návrhu. Treba vlastné fotky z realizácií – ideálne rovnaký uhol pred a po čistení (pre posúvač).
- **Referencie:** texty a mená sú ukážkové – nahradiť skutočnými recenziami (Google).
- **Telefón, e-mail, otváracie hodiny, oblasť** – overiť s klientom.
- **Formulár** v návrhu nič neodosiela – na webe sa napojí na e-mail (napr. Contact Form 7 / WPForms).
- **Mapa** je kreslená (SVG). Na ostrom webe môže zostať, alebo sa nahradí Google Maps.
- Ceny zatiaľ na webe nie sú (klient nechce preplnený web) – ak ich bude chcieť, pridá sa sekcia „Cenník“.
