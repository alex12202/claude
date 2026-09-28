# WordPress téma Čistímeklimy

Vlastná téma s rovnakým vzhľadom ako návrh (`../index.html`, `../radiatory.html`) – slider, animácie, písma, formulár.
Nepotrebuje Elementor ani žiadny iný plugin.

- **Hotová téma na nahratie:** `dist/cistimeklimy.zip`
- **Zostavenie:** `python3 wordpress/build_theme.py` – šablóny (`header.php`, `footer.php`, `front-page.php`, `template-radiatory.php`) sa generujú zo statického návrhu, takže úpravy robíme v návrhu a tému znova zostavíme.
- **Ručne písané PHP:** `src/` (`functions.php`, `inc/…`)

## Čo sa dá upravovať v administrácii

| Kde | Čo |
|---|---|
| **Vzhľad → Prispôsobiť → Čistímeklimy → Kontakty** | telefón, e-mail, kam chodia objednávky, otváracie hodiny, oblasť, Facebook, Instagram |
| **Vzhľad → Prispôsobiť → Čistímeklimy → Úvodný slider** | 4 fotky, nadpisy (modré slová cez `<em>…</em>`) a popisy |
| **Stránky → Čistenie radiátorov** | text článku o radiátoroch (blok „Vlastné HTML“) |
| **Vzhľad → Menu** | hlavné menu (kým nie je vytvorené, zobrazuje sa predvolené) |
| **Nástroje → Objednávky** | záloha všetkých objednávok z formulára |

Ostatné texty úvodnej stránky sú v šablóne `front-page.php` (menia sa v návrhu a téma sa zostaví znova).

Po aktivácii téma sama vytvorí stránky **Úvod** (nastaví ju ako úvodnú) a **Čistenie radiátorov** s hotovým textom a zapne pekné odkazy (`/cistenie-radiatorov/`).

## Formulár objednávky

Odosiela e-mail cez `wp_mail` na adresu z Customizera a každú objednávku uloží aj do **Nástroje → Objednávky**.
Proti spamu: skryté pole a kontrola času (robot odošle hneď). Funguje aj s cache.
Odporúčanie: nainštalovať plugin **WP Mail SMTP** a nastaviť odosielanie cez e-mail schránku na Websupporte, aby maily nekončili v spame.

## Spustenie na Websupporte (cistimeklimy.sk)

1. **WebAdmin → cistimeklimy.sk → Hosting:** nainštalovať WordPress (inštalácia na 1 klik) a zapnúť SSL (Let's Encrypt).
2. **Nahrať tému** – jedna z možností:
   - **cez administráciu:** Vzhľad → Témy → Pridať novú → Nahrať tému → `dist/cistimeklimy.zip` → Aktivovať
   - **cez SSH:** v WebAdmine zapnúť SSH prístup, potom
     ```
     SSH_TARGET="login@server" WP_PATH="/cesta/k/webu" ./wordpress/deploy.sh
     ```
     (skript tému zostaví, nahrá cez `rsync` a aktivuje cez WP-CLI, ak ho server má)
3. **Vzhľad → Prispôsobiť → Čistímeklimy:** skontrolovať telefón a e-mail.
4. **Nastavenia → Všeobecné:** názov webu, jazyk Slovenčina, časové pásmo Bratislava.
5. SEO plugin (Rank Math alebo Yoast) podľa SEO špecialistu – téma nemá vlastné meta popisy, aby sa s pluginom nebila.

## Overené

Téma bola vyskúšaná na čistom WordPresse 6.x (PHP 8.4): úvod, podstránka o radiátoroch, 404, mobil, odoslanie formulára (úspech, príliš rýchle odoslanie, zlý telefón), vytvorenie stránok po aktivácii. PHP bez chýb a varovaní.
