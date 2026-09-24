# DANORA – e-shop s bižutériou

Dizajn a WordPress child téma pre e-shop **DANORA** postavený na šablóne **Luxrio** (WooCommerce + Elementor).

- **Náhľad návrhu homepage:** `design/danora-homepage.html` (otvor v prehliadači). Vpravo dole je panel na prepnutie variantu **so zlatou / bez zlatej** a podtitulu **Bižutéria a doplnky / Jewelry & Accessories / Collection**.
- **Child téma:** `danora-child/`
- **Logo bez pozadia:** `danora-child/assets/img/`
- **Obrázky pre náhľad:** `design/assets/` (3D rendre šperkov, saténové pozadia)

## Farby

| Názov | HEX | Použitie |
|---|---|---|
| Krémová | `#f7f1e6` | pozadie stránky |
| Slonovina | `#fffcf6` | karty produktov, formuláre (namiesto bielej) |
| Béžová | `#efe4d2` | striedanie sekcií, kategórie |
| Champagne | `#e3cfae` | jemné akcenty, texty na čiernej |
| Zlatá | `#b08d57` | akcent (hover tlačidiel, čiary, zľavy) |
| Zlatá tmavá | `#8a6a3b` | zlaté texty a odkazy (čitateľnosť) |
| Čierna | `#1c1712` | nadpisy, tlačidlá, pätička |
| Taupe | `#6e6358` | bežný text |

Zlatú sa oplatí nechať: logo je zlaté, takže zlatý akcent na webe ho prepája. Ak by si ju chcela vynechať, v `danora-child/style.css` stačí zmeniť `--dn-gold` a `--dn-gold-dark` (napr. na `#3a3129`).

**Písma (Google Fonts):** Cormorant Garamond (nadpisy), Montserrat (text), Cinzel (veľké písmená ako v logu), Pinyon Script (ozdobný podpis, napr. „Krása v každom detaile“).

## Súbory loga

| Súbor | Na čo |
|---|---|
| `danora-logo-full.png/.webp` | celé logo (monogram + DANORA + Bižutéria + slogan), priehľadné pozadie – pätička, prihlásenie |
| `danora-name.png` | iba nápis DANORA – **logo do hlavičky** |
| `danora-wordmark.png/.webp` | DANORA + Bižutéria + slogan |
| `danora-monogram.png/.webp` | iba monogram D – sociálne siete, profilová fotka |
| `danora-site-icon-512.png` | ikona webu / favicon (Vzhľad → Prispôsobiť → Identita webu) |

Logo je vyrezané z dodaného obrázka (791 px). Na web stačí; na tlač (vizitky, krabičky) treba vektorovú verziu (SVG/PDF) od grafika.

## Inštalácia

1. Nainštaluj a aktivuj rodičovskú tému **Luxrio** (`luxrio.zip`) a požadované pluginy (WooCommerce, Elementor, Redux…).
2. Voliteľne naimportuj demo obsah (Luxrio → Demo import), aby boli hotové stránky a slider.
3. Zabaľ priečinok `danora-child` do ZIP a nahraj cez **Vzhľad → Témy → Pridať novú → Nahrať**. Aktivuj **Danora**.
4. **Luxrio → Theme Options**: logo = `danora-name.png` (výška cca 40–60 px), farby nechaj prázdne alebo rovnaké ako v tabuľke. Paleta sa riadi súborom `danora-child/style.css`.
5. **Elementor → Site Settings → Global Colors / Fonts**: nastav farby a písma z tabuľky. Demo stránky Luxria majú tmavé sekcie nastavené priamo v Elementore – tie treba prepnúť na krémovú/béžovú (alebo použiť CSS triedy nižšie).
6. Hero slider na úvod: v Elementore upraviť slider z dema (3 snímky s produktmi, ako v návrhu).

### CSS triedy pre Elementor (Advanced → CSS Classes)

`dn-section-cream`, `dn-section-beige`, `dn-section-ink` (pozadie sekcie), `dn-eyebrow` (malý nadpis nad titulkom), `dn-script` (ozdobné písmo), `dn-divider` (zlatá čiarka).

### Ako child téma funguje

Luxrio je tmavá téma – premennú `--white-color` používa na text na tmavom pozadí. Child téma ju prepne na čiernu a tmavé plochy na krémové odtiene. Pravidlá, ktoré majú farbu pozadia napísanú natvrdo, prepisuje vygenerovaný súbor `assets/css/danora-light.css`. Po aktualizácii Luxria ho vygeneruj znova:

```
python3 tools/build_light_overrides.py cesta/k/luxrio/assets/css/style.css > danora-child/assets/css/danora-light.css
```

### Obrázky v náhľade

- **Šperky** sú 3D rendre (`tools/render-jewelry.html`, three.js), **satén** je generovaný (`tools/satin.py`). Slúžia ako ukážka, kým nebudú hotové skutočné produktové fotky.
- Ostatné demo fotky Luxria (produkty, bannery) nie sú v ZIPe. Stiahnu sa až pri importe dema vo WordPresse (Luxrio → Import Demo Data).

Náhľad `design/danora-homepage.html` sa skladá príkazom `python3 tools/build_mockup.py` zo `design/src/homepage.template.html`.

## Štruktúra homepage (podľa návrhu)

1. Hlavička: logo v strede, menu kategórií (Novinky, Náušnice, Náhrdelníky, Náramky, Prstene, Doplnky do vlasov, Darčekové sety, Výpredaj); pri scrollovaní sa zmenší
2. Celoplošný slider na pozadí (4 snímky, pomalý zoom a posun pozadia, postupné zobrazenie textu, plávajúci produkt, časová lišta)
3. Kategórie (kruhy so saténom) a 2 promo bannery
4. Obľúbené produkty (záložky Najpredávanejšie / Novinky / Do 20 €), stav skladu pri produkte
5. O značke (text, DANORA Bižutéria / Doplnky / Collection)
6. Výhody: platba, doručenie, vrátenie, darčekové balenie
7. Newsletter so zľavou 10 %
8. Pätička s právnymi stránkami, platobnými metódami, údajmi o prevádzkovateľovi, SOI a RSO
9. Cookie lišta s možnosťou „Iba nevyhnutné“

## Čo treba pripraviť pred spustením

**Technicky (webár):**
- produkty + fotografie (ideálne na jednotnom krémovom pozadí), ceny, skladové množstvo
- košík, doprava (Packeta / SPS / Slovenská pošta), platba kartou cez **Stripe** (Apple Pay, Google Pay), prevod, dobierka
- fakturácia (plugin, napr. SuperFaktúra / iKros / WooCommerce PDF Invoices)
- cookie lišta so súhlasom (napr. Complianz / CookieYes)

**Majiteľka e-shopu:**
- účet na [stripe.com](https://stripe.com) (na firmu/živnosť, IBAN, overenie totožnosti)
- živnosť/firma, IČO, DIČ; údaje prevádzkovateľa do pätičky a podmienok
- právne texty: obchodné podmienky, reklamačný poriadok, ochrana osobných údajov (GDPR), zásady cookies, poučenie o odstúpení od zmluvy + formulár (spotrebiteľ má **14 dní od prevzatia tovaru**)
- odporúčané: právne texty nechať skontrolovať právnikom alebo použiť overenú službu

## Doména

Zo sandboxu sa nedalo spustiť WHOIS. `danora.sk` ani `danora.eu` nemajú DNS záznam, takže sú **pravdepodobne voľné**. Treba to potvrdiť na [sk-nic.sk](https://www.sk-nic.sk) alebo u registrátora (Websupport, WebHouse). `danora.com` sa overiť nedalo.

Záložné varianty: `danora-bizuteria.sk`, `danoracollection.sk`, `danora-shop.sk`.
