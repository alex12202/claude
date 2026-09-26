# Čistímeklimy.sk – návrh webu

Návrh webu pre čistenie klimatizácií (a novo aj radiátorov), doména **cistimeklimy.sk** (Websupport).

- **Homepage:** `index.html` (otvor v prehliadači)
- **Podstránka:** `radiatory.html` – čistenie zaprášených radiátorov / vykurovacích telies
- **Náhľady:** `previews/` (desktop 1440 px, mobil 390 px)

## Sekcie homepage (poradie)

1. Hlavička – logo, menu, telefón
2. Hero so **sliderom** (obrázky sa striedajú a pomaly približujú) + odznak **99,9 % baktérií a plesní**
3. Čierny pás výhod (bez plesní, zásah do 60 min, Bratislava a okolie, odborníci)
4. **Prečo čistiť** – interaktívne porovnanie *pred / po* (posúvač) + zoznam rizík
5. **Nestačí vyčistiť len filtre** – filter vs. rotor
6. Služby (nástenné, kazetové/kanálové, dezinfekcia, **radiátory – nové**)
7. **Ako prebieha čistenie** – 4 kroky + fotky pred / po „Rozdiel, ktorý je vidieť“
8. **Kedy je čas na čistenie / Ako často čistiť**
9. **Referencie**
10. **Mapa pôsobnosti** (Bratislava a okolie) + rýchla objednávka
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

Logo je vektorové (písmo je prevedené na krivky, jeho názov sa z PDF nedá zistiť).
Na nadpisy je použitý **Exo 2 ExtraBold Italic** (Google Fonts) – šikmé, zaoblené, technické, najbližšie k logu a s plnou podporou slovenčiny.
Text: **Manrope**. Ak grafik povie presný názov písma z loga, stačí zmeniť `--f-display` v `assets/css/style.css`.

## Logo

`assets/logo/` – `cistimeklimy-logo.svg` (na svetlé pozadie), `cistimeklimy-logo-white.svg` (na tmavé), `cistimeklimy-logo-original.pdf`.

## Čo treba doplniť pred spustením

- **Fotky:** obrázky v `assets/img/` sú len zástupné (vystrihnuté z referenčných návrhov, nízke rozlíšenie). Treba vlastné fotky z realizácií – ideálne rovnaký uhol pred a po čistení (pre posúvač).
- **Referencie:** texty a mená sú ukážkové – nahradiť skutočnými recenziami (Google).
- **Telefón, e-mail, otváracie hodiny, oblasť** – overiť s klientom.
- **Formulár** v návrhu nič neodosiela – na webe sa napojí na e-mail (napr. Contact Form 7 / WPForms).
- **Mapa** je kreslená (SVG). Na ostrom webe môže zostať, alebo sa nahradí Google Maps.
- Ceny zatiaľ na webe nie sú (klient nechce preplnený web) – ak ich bude chcieť, pridá sa sekcia „Cenník“.
