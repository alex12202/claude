# Alešove dobroty – návrh e-shopu

Klikateľný návrh e-shopu s orechmi, lyofilizovaným ovocím a sušenou zeleninou. Otvor `index.html` v prehliadači.

- `index.html` – úvodná stránka
- `obchod.html` – obchod s filtrami
- `assets/app.css`, `assets/app.js` – spoločný vzhľad, produkty, košík, darčeky a rýchly náhľad (košík sa prenáša medzi stránkami)

## Úvodná stránka

Štruktúra podľa šablóny Getstall (Elementor kit): slider hore, kruhové kategórie, akciové bannery, vybrané produkty, veľký banner s výzvou.

1. **Slider hore z bannerov cez celú šírku obrazovky** (5 fotiek s textom a cenou): všetky dobroty od 0,99 €, 2 + 1 na ovocie, orechy XXL 1 kg za 22,69 €, sušená zelenina od 2,49 €, darček od 30 € (živý stav košíka). Mení sa sám každých 6,5 s s pomalým priblížením fotky, pri prejdení myšou zastaví, má šípky, pauzu, posun prstom a popisy ponúk. Fotky sú vyrezané z dodaného obrázka (`assets/banners/`), na spustenie ich treba nahradiť skutočnými fotkami v šírke aspoň 1920 px.
2. **Pás s darčekom** pod sliderom: koľko chýba do ďalšieho darčeka, s ukazovateľom.
3. **Kategórie v kruhoch** s cenou „od“.
4. **Akciové bannery:** 2 + 1 zdarma, XXL −35 %, vzorky od 0,99 €, darček zdarma (živý stav).
5. **Produkty so záložkami:** Najpredávanejšie, Akcia 2 + 1, Orechy, Do 3 €, Novinky. Posúvanie šípkami, rýchly náhľad pri prejdení myšou.
6. **Ponuka týždňa** s odpočítavaním do nedele 23:59 a stavom zásob.
7. **Výhodné balíčky** (raňajkový, športový, kuchynský) s úsporou oproti jednotlivým vreckám.
8. **Darčeky podľa sumy**, pôvod, postup výroby, newsletter −10 %, výhody (faktúra, eKasa, platba, doručenie).

V hlavičke je na každej stránke políčko „Ešte X € do darčeka“ s ukazovateľom. V košíku je ukazovateľ s troma hranicami (30 €, 50 €, 80 €), získané darčeky sa zobrazia ako položky za 0,00 € a pri prekročení hranice vyskočí oznam.

## Obchod

- **Cena je najväčší prvok** na kartách produktov aj v slidri, pri každom produkte je aj cena za 100 g.
- **Rýchly náhľad (obraz v obraze).** Na počítači stačí prejsť myšou po produkte a vedľa neho sa otvorí malé okno s fotkou, pôvodom, výberom gramáže, počtom kusov a tlačidlom *Pridať do košíka*. Na mobile sa po ťuknutí vysunie zospodu.
- **Kategórie a podkategórie.** Ovocie (lyofilizované, sušené, čerstvé sezónne), Orechy (natural, v čokoláde), Zelenina (sušená). Menu v hlavičke sa rozbalí s produktmi a cenou „od“.
- **Filtre na boku:** kategória, gramáž (30 g, 100 g, 250 g, 500 g, 1 kg, XXL), cena do, BIO, bez cukru, akcia 2 + 1, krajina pôvodu. Zoradenie aj podľa ceny za 100 g.
- **2 + 1 zdarma** na lyofilizované ovocie. Košík sám odpočíta najlacnejšie tretie vrecko.
- **Darček podľa ceny nákupu:** od 30 € vzorka, od 50 € doprava zdarma a maliny 30 g, od 80 € darčeková tuba. Ukazovateľ na stránke aj v košíku počíta, koľko chýba.
- **Vzorky 30 g, XXL balenia, veľkoobchod** pre obchody a kaviarne (dlhodobá spolupráca).
- **Pôvod:** každý produkt z inej krajiny (mango a banány z Ugandy, vlašské orechy z Uzbekistanu…).
- **Automatická faktúra a eKasa** sú uvedené pri košíku a v sekcii výhod.
- Produkty bez rámčekov: fotka vrecka stojí na farebnej škvrne vo farbe ovocia alebo orecha, každá má iný tvar.
- Prírodné zemité farby (kraft papier, orech, zelený list, jahodová červená na ceny). Iba svetlý režim.

## Čo je len ukážka

- Fotky produktov sú vyrezané z dodaného AI obrázka vreciek. Na spustenie treba skutočné fotky (ideálne na priehľadnom pozadí).
- Ceny, gramáže a pôvod okrem Ugandy a Uzbekistanu sú ilustračné.
- Sušené a čerstvé ovocie majú kategóriu pripravenú, produkty zatiaľ nie.
- Tlačidlo *Pokračovať k platbe* pokladňu nemá, len ukáže oznam.

## Na realizáciu (technicky)

- **Automatická fakturácia:** WooCommerce alebo Shoptet s napojením na fakturačný systém (napr. SuperFaktúra, iKros). Faktúra sa vystaví a pošle po zaplatení.
- **eKasa:** doklad z eKasy treba pri platbe v hotovosti (dobierka, osobný odber). Platby kartou online ho spravidla nevyžadujú. Presný postup potvrdiť s účtovníkom.
- **Rýchly náhľad** sa vo WooCommerce dá spraviť pluginom „Quick View“ s úpravou na otváranie pri prejdení myšou.
- **2 + 1 a darčeky podľa sumy:** pravidlá zliav v košíku (napr. plugin na BOGO a „free gift“ podľa sumy košíka).

Farby: kraft `#d6bf97`, papier `#f4ede1`, orech `#34251a`, list `#2f6b3a`, jahoda (ceny) `#b8322a`, med (akcie) `#e3a43a`.
Písma (Google Fonts): Fraunces (nadpisy a ceny), Figtree (text), Caveat (ručné poznámky).
