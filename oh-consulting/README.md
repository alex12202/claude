# OH & Consulting – web na WordPresse

Vlastná WordPress téma pre **OH & Consulting s.r.o.** (účtovníctvo, dane, mzdy, poradenstvo). Nepotrebuje žiadny page builder ani platenú tému.

| Čo | Kde |
|---|---|
| Téma (priečinok) | `wordpress/oh-consulting/` |
| Téma (na nahratie) | `oh-consulting-tema.zip` |
| Logá (SVG + PNG) | `logo/` |
| Návrh v Claude Design | https://claude.ai/artifact/4mxCyXoszTNHrFzhw6PQFx |

## Inštalácia

1. **Vzhľad → Témy → Pridať novú → Nahrať tému** → `oh-consulting-tema.zip` → **Aktivovať**.
2. **Nastavenia → Čítanie** → „Úvodná stránka zobrazuje“: stačí nechať „Najnovšie príspevky“ – téma má vlastnú úvodnú stránku (`front-page.php`), ktorá sa zobrazí v oboch prípadoch.
3. **Vzhľad → Prispôsobiť → OH Consulting** – telefón, e-mail, adresy, IČO/DIČ, kam chodia dopyty z formulára, farba tlačidiel a rýchlosť slidera.
4. **Vzhľad → Prispôsobiť → Identita webu → Ikona webu** – nahrať `logo/oh-ikona.png` (512 × 512).
5. **Nastavenia → Ochrana osobných údajov** – vytvoriť/zvoliť stránku. Odkaz sa automaticky zobrazí v pätičke a pri súhlase vo formulári.
6. Voliteľne **Vzhľad → Menu** – vytvoriť menu a priradiť ho na „Hlavné menu“. Kým žiadne nie je, zobrazuje sa predvolené (Služby, O nás, Ako to funguje, Cenník, Kontakt).

## Kontaktný formulár

Funguje hneď bez pluginu – dopyt príde e-mailom na adresu z nastavení (chránený proti spamu skrytým poľom a nonce).

- WordPress posiela e-maily cez funkciu `wp_mail`. Na mnohých hostingoch sa takéto e-maily dostanú do spamu, preto odporúčame plugin **WP Mail SMTP** (nastaviť cez Gmail alebo SMTP hostingu). Po nastavení si formulár vyskúšajte.
- Ak chcete radšej **Contact Form 7**, vložte jeho shortcode do *Prispôsobiť → OH Consulting → Shortcode iného formulára*. Štýl formulára ostane rovnaký.

## Úpravy textov

Texty úvodnej stránky (slidy, služby, referencie, …) sú v súbore `front-page.php` – v poliach `$oh_slides`, `$oh_services`, `$oh_refs` hore a v jednotlivých sekciách nižšie. Dajú sa upraviť cez **Nástroje → Editor súborov témy** alebo FTP.

Obrázky sú v `assets/img/` – stačí nahradiť súbor s rovnakým názvom (hero na šírku cca 2000 px, služby 800 px).

> **Referencie sú ukážkové.** Pred spustením ich nahraďte skutočnými vyjadreniami klientov (so súhlasom so zverejnením mena).

## Logo

| Súbor | Na čo |
|---|---|
| `oh-logo-horizontalne.svg/.png` | hlavička webu, e-mailový podpis, faktúry |
| `oh-logo-horizontalne-biele.svg/.png` | na tmavé pozadie |
| `oh-logo-vertikalne.svg/.png` | vizitky, dokumenty, sociálne siete |
| `oh-logo-vertikalne-biele.svg/.png` | na tmavé pozadie |
| `oh-lotos.svg/.png` | samotný lotos (značka) |
| `oh-ikona.svg/.png` | ikona webu / favicon, profilová fotka |

Texty v SVG sú prevedené na krivky, takže sa zobrazia rovnako aj bez nainštalovaného písma (vhodné aj do tlače). Ak chcete mať v hlavičke webu obrázok namiesto textového loga, nahrajte `oh-logo-horizontalne.png` v **Prispôsobiť → Identita webu → Logo**.

## Technické poznámky

- Písmo **Montserrat** je uložené priamo v téme (`assets/fonts/`), nenačítava sa z Google Fonts – web tak neposiela IP adresy návštevníkov do Googlu (GDPR).
- Fotky sú z **Unsplash** (licencia Unsplash – bezplatné komerčné použitie, bez povinnosti uvádzať autora).
- Slider: automatické prepínanie (pauza pri prejdení myšou), šípky, bodky, potiahnutie prstom na mobile; pri zapnutom „obmedziť pohyb“ v systéme sa neprepína sám.
- Požiadavky: WordPress 6.0+, PHP 7.4+.
