# BROMAR s. r. o. – návrh webu (tieniaca technika)

Návrh novej stránky **bromar.sk**: *Kompletné riešenia tienenia – pergoly, žalúzie, rolety, siete, zimné záhrady a zasklenia. Všetko vyrábame a montujeme presne na mieru, s dôrazom na kvalitu, dizajn a dlhú životnosť. BROMAR – komfort, kvalita, detail.*

Na stránke sú vonkajšie žalúzie (aj podomietkové), screenové rolety, plastové a hliníkové rolety, bioklimatické hliníkové pergoly, vnútorné tienenie, siete proti hmyzu, zimné záhrady, zasklenia, automatika Somfy a servis okien. Stavia na šablóne **Domi** (WordPress + Elementor).

- **Náhľad homepage:** `design/bromar-homepage.html` (otvor v prehliadači, všetko je v jednom súbore)
- **Screenshoty:** `design/previews/` (desktop, mobil, celá stránka)
- **Child téma pre Domi:** `bromar-child/`

## Čo je na stránke nové (efekt „wow“)

1. **Prechod medzi snímkami ako žalúzia.** Pri zmene snímky sa hero zatiahne lamelami a znova sa otvorí. Pri načítaní stránky sa lamely otvoria a odhalia prvú fotku. Súvisí to priamo s tým, čo firma predáva.
2. **Ken Burns efekt**: pomalé priblíženie a posun fotky na pozadí, snímky sa prelínajú. Pod nimi je časová lišta so 4 produktmi.
3. **Živý „Somfy“ widget** v hero. Šípkami sa dá žalúzia vytiahnuť alebo spustiť.
4. **Interaktívne okno so žalúziou.** Zákazník si posuvníkom natočí lamely a tlačidlami ▲ ■ ▼ žalúziu vytiahne alebo spustí, podobne ako na ovládači. Kliknutím na typ lamely (C-80, Z-90, S-90, F-80) sa natočenie nastaví podľa typu.
5. **Pergola reaguje na scroll.** Pri posúvaní stránky sa lamely pergoly otáčajú a medzi nimi prechádza slnko.
6. **Plynulé scrollovanie myšou** (so zotrvačnosťou), parallax fotiek, postupné zobrazovanie textov a čiara postupu, ktorá sa pri scrollovaní „vyplní“.
7. Mega menu s náhľadmi produktov a na mobile spodná lišta **Zavolať / Cenová ponuka** (dôležité pre konverzie z Google Ads).

## Štruktúra homepage

1. Horná lišta (telefón, e-mail) a hlavička. Pri scrollovaní sa zmení na bielu so sklenným efektom.
2. Hero slider: 4 snímky (žalúzie, pergola, screeny, interiér), každá s vlastným textom a tlačidlami.
3. Výhody: zameranie zdarma, vlastná montáž, Somfy, záruka a servis
4. Predstavenie firmy: *Kompletné riešenia tienenia…* a heslo **Komfort · Kvalita · Detail**
5. Produktové karty (ako na climax.cz): 6 hlavných kategórií, pod nimi siete proti hmyzu, zimné záhrady a zasklenia terás
6. **Vonkajšie žalúzie:** typy lamiel, typ boxu (predokenný / podomietkový / v preklade), ovládanie (kľuka, motor, ovládač, mobil)
7. **Screenové rolety:** základný typ (ZIP), typ boxu, ovládanie, tkaniny s ukážkou farieb
8. **Bioklimatické pergoly** (tmavomodrá sekcia): otočné lamely, senzor dažďa, LED, bočné screeny, odvod vody
9. **Rolety:** porovnanie plastové vs. hliníkové
10. **Vnútorné tienenie:** horizontálne žalúzie, látkové rolety, deň a noc, plisé, vertikálne žalúzie
11. **Somfy / smart home:** mobil s aplikáciou, scény, senzory vetra a slnka
12. **Servis okien:** nastavenie, tesnenia, kovanie, kľučky, sezónna prehliadka, servis tienenia
13. Postup v 5 krokoch (od konzultácie po servis)
14. Realizácie: galéria so zväčšením fotiek
15. Časté otázky
16. Formulár na **nezáväznú cenovú ponuku**: výber produktov, meno, telefón, e-mail, obec, poznámka a súhlas GDPR
17. Pätička s kontaktmi a údajmi firmy

Každá sekcia má vlastnú kotvu (`#zaluzie`, `#screeny`, `#pergoly`, `#rolety`, `#interier`, `#smart`, `#servis`, `#kontakt`). Neskôr z nich môžu byť samostatné podstránky, na ktoré sa nasmeruje reklama v Google Ads (napr. kampaň „vonkajšie žalúzie“ → stránka o žalúziách s formulárom).

## Farby

Neutrálny základ, červená iba ako akcent (hlavné tlačidlo „Nezáväzná ponuka“, čiarky nad nadpismi, hover efekty). Tmavomodrá a antracitová ladia s firemnými tričkami.

| Názov | HEX | Použitie |
|---|---|---|
| Kriedová | `#f5f2ed` | pozadie stránky |
| Papier | `#fbfaf7` | karty, formuláre |
| Béžová | `#e9e2d7` | striedanie sekcií |
| Greige | `#cfc6b8` | linky, rámiky |
| Taupe | `#8c8377` | doplnkový text |
| Text | `#4a4d52` | bežný text |
| Antracit | `#2e3136` | rámy, ovládače, tmavé karty |
| Tmavomodrá | `#1c2a3e` | nadpisy, tlačidlá, tmavé sekcie |
| Červená (logo) | `#c0141c` | štít v logu, akcent, hlavné CTA |

**Písma:** Stack Sans Headline (nadpisy) a Inter (text). Sú to presne tie písma, ktoré používa téma Domi, takže sa nemusí nič meniť.

## Čo treba doplniť od klienta

- **Logo** – v návrhu je logo **prekreslené do SVG** podľa dodaného obrázka (štít s „B“, BROMAR, TIENIACA TECHNIKA): `bromar-child/assets/img/bromar-logo.svg` (na svetlé pozadie) a `bromar-logo-negative.svg` (na tmavé). Písmo nápisu je približné. Ak existuje originálny vektor od grafika (SVG/PDF/AI), treba ho použiť.
- **Kontakty** – telefón `+421 900 000 000`, adresa a IČO sú **vymyslené zástupné údaje**. E-mail `info@bromar.sk` treba overiť.
- **Fotky** – obrázky v návrhu sú **3D vizualizácie** (three.js), nie skutočné realizácie. Pred spustením ich treba nahradiť fotkami z vlastných montáží alebo fotkami od dodávateľa (CLIMAX, Somfy) so súhlasom na použitie. Galéria „Realizácie“ má zmysel len so skutočnými fotkami.
- **Texty o produktoch** sú všeobecné. Parametre (max. rozmery, farby RAL, typy boxov, záruky, dodacie lehoty) treba zosúladiť s tým, čo BROMAR od CLIMAXu reálne predáva. Obsah sa dá prevziať z climax.cz (so súhlasom), ale nie doslovne skopírovať.
- **Hodnotenia v návrhu** (zatemnenie / odolnosť vetru pri lamelách) sú orientačné. Treba ich overiť podľa katalógu.
- **Formulár** v náhľade nič neodosiela, je len na ukážku. Vo WordPresse ho nahradí Elementor Form / MetForm (Domi ho má v zozname pluginov) s odoslaním na e-mail a meraním konverzie pre Google Ads.
- Stránky **Ochrana osobných údajov** a **Cookies** a cookie lišta (napr. Complianz / CookieYes) sú potrebné pre GDPR a Google Ads.

## Inštalácia do WordPressu

1. Nainštaluj a aktivuj rodičovskú tému **Domi** (`domi.zip`) a požadované pluginy (ThemeREX Addons, Elementor…).
2. Voliteľne naimportuj demo obsah Domi, aby boli hotové stránky a slider.
3. Zabaľ priečinok `bromar-child` do ZIP (`zip -r bromar-child.zip bromar-child`) a nahraj cez **Vzhľad → Témy → Pridať novú → Nahrať**. Aktivuj **Bromar**.
4. Child téma nastaví predvolenú farebnú schému Domi na paletu BROMAR (`functions.php`). Ak už boli farby v Customizeri zmenené, uložené hodnoty majú prednosť. Vtedy ich treba prepísať ručne podľa tabuľky (*Vzhľad → Prispôsobiť → Colors*).
5. **Elementor → Site Settings → Global Colors**: nastav farby podľa tabuľky.
6. Hero: v Elementore sekcia so slideshow pozadím a triedou `bm-kenburns`. Prechod „žalúzia“ z náhľadu sa dá vložiť ako HTML widget (kód je v `design/src/homepage.template.html`, časť `hero`).

### CSS triedy pre Elementor (Advanced → CSS Classes)

`bm-section-cream`, `bm-section-paper`, `bm-section-sand`, `bm-section-navy` (pozadie sekcie), `bm-eyebrow` (malý nadpis s červenou čiarkou), `bm-btn` / `bm-btn-red` (tlačidlo s prelivom), `bm-card` (karta produktu), `bm-rv` + `bm-d1…bm-d4` (zobrazenie pri scrollovaní), `bm-kenburns` (pomalý zoom pozadia).

## Nástroje (ako vznikli obrázky)

- `tools/render-scenes.html`: 3D scény v three.js (dom s vonkajšími žalúziami, pergola, screeny, rolety, interiér, servis okna). Parametre: `?scene=house&view=heroR&time=dusk&w=1920&h=1080`
- `tools/render.mjs`: vyrenderuje scény v headless Chromiu do PNG (treba `npm i three@0.170.0 playwright` v priečinku so skopírovaným HTML)
- `tools/build_assets.py`: z PNG urobí orezané WebP do `design/assets/`
- `tools/build_mockup.py`: zo šablóny `design/src/homepage.template.html` poskladá `design/bromar-homepage.html` s vloženými obrázkami

```
python3 tools/build_assets.py cesta/k/renderom
python3 tools/build_mockup.py
```
