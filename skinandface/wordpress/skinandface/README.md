# Skin & Face – WordPress téma

Samostatná téma (bez Elementora a bez platených doplnkov) pre kliniku Skin & Face Dermaesthetic – Stupava a Bratislava-Rača.

## Inštalácia

1. **Vzhľad › Témy › Pridať novú › Nahrať tému** → `skinandface.zip` → Aktivovať.
2. Po aktivácii sa automaticky vytvorí:
   - stránky **Domov** (úvodná), **Cenník**, **O nás**, **Kontakt**, **Rača** (`/raca/`),
   - **13 služieb** s cenami z cenníka (adresy `/sluzba/...` sú rovnaké ako na pôvodnom webe – napr. `/sluzba/pery/`, `/sluzba/tvar/`, `/sluzba/dermatovenerologia/` – takže nič netreba presmerovať),
   - **lekárky** (MUDr. Vargová, MUDr. Michael) s fotkami,
   - **12 recenzií** (8 z webu, 4 z NavstevaLekara.sk), **6 častých otázok**, **hlavné menu**,
   - pekné adresy (`/%postname%/`), ak boli vypnuté.
   Ak treba obsah doplniť znova: **Nástroje › Skin & Face obsah** (existujúci obsah neprepíše).
3. **Vzhľad › Prispôsobiť › Skin & Face** – skontrolovať kontakty, pobočky, ordinačné hodiny, slider.

## Kde sa čo upravuje

| Čo | Kde |
|---|---|
| Telefón, e-mail, rezervácia, sociálne siete, IČO | Prispôsobiť › Skin & Face › Kontakt a odkazy |
| Adresa a hodiny Stupava | Prispôsobiť › Skin & Face › Pobočka Stupava |
| Rača – štítok „Otvárame…“, adresa, hodiny, rezervácia, prepínač „otvorená“ | Prispôsobiť › Skin & Face › Pobočka Rača |
| Nadpis H1, text, 4 snímky slidera (texty + fotky) | Prispôsobiť › Skin & Face › Úvod a slider |
| Hodnotenie 4,7, odkazy na Google a NavstevaLekara.sk, počet recenzií | Prispôsobiť › Skin & Face › Recenzie a hodnotenie |
| Služby (text, cena, „V skratke“, kategória, poradie) | menu **Služby** |
| Lekárky (fotka = obrázok príspevku, rola, odkaz na rezerváciu) | menu **Lekári** |
| Recenzie, časté otázky | menu **Recenzie**, **Časté otázky** (poradie = Atribúty › Poradie) |
| Dopyty z formulára „Chcem termín“ | menu **Dopyty z webu** (prídu aj e-mailom) |
| Cenník | Stránky › Cenník (tabuľky v editore) |

## Odporúčané pluginy (bezplatné)

| Plugin | Prečo |
|---|---|
| **Complianz** (alebo CookieYes) | Cookies lišta so súhlasom podľa GDPR, Google Consent Mode v2, stránka o cookies. Complianz vytvorí aj `/zasady-pouzivania-suborov-cookie-eu/` – rovnakú adresu ako starý web. |
| **WP Mail SMTP** | Aby e-maily z formulára spoľahlivo chodili (cez SMTP schránky rezervacie@…). **Dôležité.** |
| **Rank Math SEO** alebo **Yoast SEO** | Mapa stránok pre Google, meta popisy. Téma má vlastné štruktúrované údaje pre kliniku, pobočky, lekárky, služby a FAQ – ak ich chcete riešiť pluginom, vypnite ich v Prispôsobiť › Technické. |
| **Site Kit by Google** alebo **GTM4WP** | Google Analytics 4 / Tag Manager pre firmu, ktorá robí kampane. |
| **Wordfence** alebo **Solid Security** | Bezpečnosť, firewall, ochrana prihlásenia. |
| **UpdraftPlus** | Automatické zálohy. |
| **LiteSpeed Cache** / **WP Super Cache** | Rýchlosť (podľa hostingu). |

## Meranie pre kampane

Téma posiela do `dataLayer` (Google Tag Manager / GA4) tieto udalosti:

- `sf_lead` – úspešne odoslaný formulár „Chcem termín“ (stránka Rača),
- `sf_click` s `sf_type` = `phone`, `email`, `booking`, `booking-raca`, `hero-stupava`, `hero-raca` – kliknutia na telefón, e-mail a online rezerváciu.

Agentúra si ich v GTM nastaví ako konverzie.

## Po spustení

1. Google Search Console – pridať web a odoslať mapu stránok (`/sitemap_index.xml` z Rank Math/Yoast alebo `/wp-sitemap.xml`).
2. Zjednotiť ordinačné hodiny na webe, v Google profile a na NavstevaLekara.sk.
3. Založiť a overiť Google profil pobočky Rača; po otvorení v Prispôsobiť › Pobočka Rača zapnúť „Pobočka je už otvorená“ a doplniť adresu, hodiny, rezerváciu.
4. Stránka **Ochrana osobných údajov** (Nastavenia › Súkromie) – doplniť text od kliniky / zodpovednej osoby.

## Technické

- WordPress 6.2+, PHP 7.4+. Písma (Cormorant Garamond, Montserrat) sú uložené v téme – nič sa nenačítava z Google (GDPR).
- Komentáre a XML-RPC sú vypnuté (menej spamu a útokov).
- Logo: `assets/img/` (SVG). Farby: premenné na začiatku `style.css`.
