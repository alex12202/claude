# Alešove dobroty – návrh e-shopu

Klikateľný návrh e-shopu s orechmi, lyofilizovaným ovocím a sušenou zeleninou. Otvor `index.html` v prehliadači.

## Čo návrh ukazuje

- **Cena je hlavný nadpis.** Na úvode je veľká cena produktu (jahody 100 g za 6,90 €), cena za 10 g, akcia 2 + 1 a štyri cenové skratky: vzorky od 0,99 €, 2 + 1 zdarma, XXL orechy od 1,81 € / 100 g, 0 g pridaného cukru.
- **Rýchly náhľad (obraz v obraze).** Na počítači stačí prejsť myšou po produkte a vedľa neho sa otvorí malé okno s fotkou, pôvodom, výberom gramáže, počtom kusov a tlačidlom *Pridať do košíka*. Na mobile sa po ťuknutí vysunie zospodu.
- **Kategórie a podkategórie.** Ovocie (lyofilizované, sušené, čerstvé sezónne), Orechy (natural, v čokoláde), Zelenina (sušená). Menu v hlavičke sa rozbalí s produktmi a cenou „od“.
- **Filtre na boku:** kategória, gramáž (30 g, 100 g, 250 g, 500 g, 1 kg, XXL), cena do, BIO, bez cukru, akcia 2 + 1, krajina pôvodu. Zoradenie aj podľa ceny za 100 g.
- **2 + 1 zdarma** na lyofilizované ovocie. Košík sám odpočíta najlacnejšie tretie vrecko.
- **Darček podľa ceny nákupu:** od 30 € vzorka, od 50 € doprava zdarma a maliny 30 g, od 80 € darčeková tuba. Ukazovateľ na stránke aj v košíku počíta, koľko chýba.
- **Vzorky 30 g, XXL balenia, veľkoobchod** pre obchody a kaviarne (dlhodobá spolupráca).
- **Pôvod:** každý produkt z inej krajiny (mango a banány z Ugandy, vlašské orechy z Uzbekistanu…).
- **Automatická faktúra a eKasa** sú uvedené pri košíku a v sekcii výhod.
- Produkty bez rámčekov: fotka vrecka stojí na farebnej škvrne vo farbe ovocia alebo orecha, každá má iný tvar.
- Prírodné zemité farby (kraft papier, orech, zelený list, jahodová červená na ceny), svetlý aj tmavý režim.

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
