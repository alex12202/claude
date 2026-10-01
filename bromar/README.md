# BROMAR s. r. o. – návrh webu (tieniaca technika)

Návrh novej stránky **bromar.sk**: *Kompletné riešenia tienenia – pergoly, žalúzie, rolety, siete, zimné záhrady a zasklenia. Všetko vyrábame a montujeme presne na mieru, s dôrazom na kvalitu, dizajn a dlhú životnosť. BROMAR – komfort, kvalita, detail.*

Na stránke sú vonkajšie žalúzie (aj podomietkové), screenové rolety, plastové a hliníkové rolety, hliníkové pergoly (s pevnou strechou aj bioklimatické), hliníkové zasklenia a zimné záhrady, vnútorné tienenie, siete proti hmyzu, motory Somfy a servis okien. Na každú montáž BROMAR je **5 rokov servis zdarma**. Stavia na šablóne **Domi** (WordPress + Elementor).

- **Náhľad webu:** `design/site/index.html` (otvor v prehliadači; podstránky sú v tom istom priečinku)
- **Online náhľad:** https://claude.ai/artifact/GfTFYXMdTcGneP89imP9ZM
- **Screenshoty:** `design/previews/` (desktop, mobil, celá stránka)
- **Child téma pre Domi:** `bromar-child/`

## Čo je na stránke nové (efekt „wow“)

1. **Prechod medzi snímkami ako žalúzia.** Pri zmene snímky sa hero zatiahne lamelami a znova sa otvorí. Pri načítaní stránky sa lamely otvoria a odhalia prvú fotku. Súvisí to priamo s tým, čo firma predáva.
2. **Ken Burns efekt**: pomalé priblíženie a posun fotky na pozadí, snímky sa prelínajú. Pod nimi je časová lišta so 4 produktmi.
3. **Widget „Motor Somfy“** v hero. Šípkami sa dá žalúzia vytiahnuť alebo spustiť. V sekcii Somfy je interaktívny ovládač s tlačidlom *my*.
4. **Interaktívne okno so žalúziou.** Zákazník si posuvníkom natočí lamely a tlačidlami ▲ ■ ▼ žalúziu vytiahne alebo spustí, podobne ako na ovládači. Kliknutím na typ lamely (C-80, Z-90, S-90, F-80) sa natočenie nastaví podľa typu.
5. **Pergola reaguje na scroll.** Pri posúvaní stránky sa lamely pergoly otáčajú a medzi nimi prechádza slnko.
6. **Plynulé scrollovanie myšou** (so zotrvačnosťou), parallax fotiek, postupné zobrazovanie textov a čiara postupu, ktorá sa pri scrollovaní „vyplní“.
7. Mega menu s náhľadmi produktov a na mobile spodná lišta **Zavolať / Cenová ponuka** (dôležité pre konverzie z Google Ads).

## Podstránky

Každý produkt má vlastnú podstránku s fotkou, výhodami, typmi, galériou, častými otázkami a formulárom, v ktorom je daný produkt už označený. Na podstránky sa dá nasmerovať reklama v Google Ads.

| Súbor | Obsah |
|---|---|
| `zaluzie.html` | Vonkajšie žalúzie: výhody, interaktívne okno, typy lamiel, boxov a ovládania, farby RAL, galéria |
| `screeny.html` | Screenové rolety ZIP: výhody, typy boxu, tkaniny (priehľadné / blackout) |
| `rolety.html` | Vonkajšie rolety: plastové vs. hliníkové, typy boxu, ovládanie, video |
| `pergoly.html` | Hliníkové pergoly: pevná strecha vs. bioklimatická, doplnky (LED, screeny, zasklenie) |
| `zasklenia.html` | Hliníkové zasklenia terás a pergol, balkóny a lodžie, zimné záhrady |
| `interier.html` | Vnútorné tienenie: typy, ako vybrať |
| `somfy.html` | Motory Somfy: prečo Somfy, ovládač / vypínač / senzor, demo ovládača |
| `servis.html` | Servis okien a tienenia, 5 rokov servis zdarma na montáž |

## Štruktúra homepage

1. Horná lišta (telefón, e-mail) a hlavička. Pri scrollovaní sa zmení na bielu so sklenným efektom.
2. Hero slider: 4 snímky (žalúzie, pergola, screeny, bytové domy), každá s vlastným textom a tlačidlami.
3. Výhody: zameranie zdarma, vlastná montáž, motory Somfy, 5 rokov servis zdarma
4. Predstavenie firmy: *Kompletné riešenia tienenia…* a heslo **Komfort · Kvalita · Detail**
5. Produktové karty (ako na climax.cz): 6 hlavných kategórií s odkazmi na podstránky, pod nimi siete proti hmyzu, zasklenia a motory Somfy
6. **Vonkajšie žalúzie:** typy lamiel, typ boxu (predokenný / podomietkový / v preklade), ovládanie (kľuka, motor, ovládač, senzory)
7. **Screenové rolety:** základný typ (ZIP), typ boxu, ovládanie, tkaniny s ukážkou farieb
8. **Hliníkové pergoly** (tmavomodrá sekcia): fotka realizácie, animácia otočných lamiel, LED, bočné screeny, odvod vody
9. **Zasklenia:** animované posuvné sklá, zasklenie terás a pergol, balkóny, zimné záhrady
10. **Rolety:** porovnanie plastové vs. hliníkové
11. **Vnútorné tienenie:** horizontálne žalúzie, látkové rolety, deň a noc, plisé, vertikálne žalúzie
12. **Motory Somfy:** prečo Somfy (kvalita, tichý a presný chod), interaktívny ovládač, vypínač, senzory. Aplikácia v návrhu nie je, BROMAR ju neponúka.
13. **Servis okien:** nastavenie, tesnenia, kovanie, kľučky, sezónna prehliadka, servis tienenia, blok **5 rokov servis zdarma**
14. Postup v 5 krokoch (od konzultácie po servis)
15. Realizácie: galéria so zväčšením fotiek
16. Časté otázky
17. Formulár na **nezáväznú cenovú ponuku**: výber produktov, meno, telefón, e-mail, obec, poznámka a súhlas GDPR
18. Pätička s kontaktmi a údajmi firmy

Sekcie na homepage sú krátke ukážky, odkaz „Všetko o …“ vedie na podstránku produktu.

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
- **Fotky a videá** – hero slider (žalúzie, screeny, bytové domy), karty produktov, sekcie Screeny a Rolety a galéria Realizácie (12 fotiek a 2 videá) používajú **skutočné zábery z montáží BROMAR**. Fotky sú orezané bez ŠPZ áut a bez materiálu po montáži (`tools/build_photos.py`), videá sú skrátené a orezané cez ffmpeg (`design/assets/video-*.mp4` + `.webm`). Pergola je už tiež skutočná fotka (pevná strecha). Ako **3D vizualizácie** zostali len bioklimatická pergola, servis okien a pohľad cez interaktívne okno. Na video do hero by sa hodil vodorovný záber v 4K.
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
6. Hero: v Elementore sekcia so slideshow pozadím a triedou `bm-kenburns`. Prechod „žalúzia“ z náhľadu sa dá vložiť ako HTML widget (kód je v `design/src/sections/hero.html`, `style.css` a `main.js`).

### CSS triedy pre Elementor (Advanced → CSS Classes)

`bm-section-cream`, `bm-section-paper`, `bm-section-sand`, `bm-section-navy` (pozadie sekcie), `bm-eyebrow` (malý nadpis s červenou čiarkou), `bm-btn` / `bm-btn-red` (tlačidlo s prelivom), `bm-card` (karta produktu), `bm-rv` + `bm-d1…bm-d4` (zobrazenie pri scrollovaní), `bm-kenburns` (pomalý zoom pozadia).

## Nástroje (ako vznikli obrázky)

- `tools/render-scenes.html`: 3D scény v three.js (dom s vonkajšími žalúziami, pergola, screeny, rolety, interiér, servis okna). Parametre: `?scene=house&view=heroR&time=dusk&w=1920&h=1080`
- `tools/render.mjs`: vyrenderuje scény v headless Chromiu do PNG (treba `npm i three@0.170.0 playwright` v priečinku so skopírovaným HTML)
- `tools/build_assets.py`: z PNG urobí orezané WebP do `design/assets/`
- `tools/build_photos.py`: z fotiek z montáží urobí orezané WebP
- `tools/build_site.py`: poskladá web do `design/site/` z `design/src/` (spoločné časti `partials/`, sekcie homepage `sections/`, stránky `pages/`, obsah podstránok `subpages.py`, štýly `style.css`, skript `main.js`)

```
python3 tools/build_assets.py cesta/k/renderom
python3 tools/build_photos.py cesta/k/fotkam
python3 tools/build_site.py
```
