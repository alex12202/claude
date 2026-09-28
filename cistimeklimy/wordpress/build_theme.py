#!/usr/bin/env python3
"""Vygeneruje WordPress tému „cistimeklimy“ zo statického návrhu.

Zdroj pravdy je statický návrh (../index.html, ../radiatory.html, ../assets).
PHP súbory, ktoré sa nemenia (functions.php, inc/…), sú v src/.

Použitie:  python3 wordpress/build_theme.py
Výsledok:  wordpress/dist/cistimeklimy/  a  wordpress/dist/cistimeklimy.zip
"""
import pathlib
import re
import shutil
import zipfile

from PIL import Image

HERE = pathlib.Path(__file__).resolve().parent
SITE = HERE.parent
SRC = HERE / "src"
DIST = HERE / "dist"
THEME = DIST / "cistimeklimy"

PHONE_SVG_RE = r'<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6\.6 10\.8[^"]*"/></svg>'


def between(text, start, end, include_start=False):
    i = text.index(start)
    j = text.index(end, i + len(start))
    return text[i if include_start else i + len(start):j]


def common(html):
    """Nahradenia spoločné pre všetky šablóny."""
    # cesty k súborom témy
    html = re.sub(r'(src|href)="assets/', r'\1="<?php echo esc_url( CK_ASSETS ); ?>/', html)
    html = re.sub(r'(srcset="|, )assets/', r'\1<?php echo esc_url( CK_ASSETS ); ?>/', html)
    # kontakty z Customizera
    html = html.replace('tel:+421948444001', "<?php echo esc_attr( ck_tel() ); ?>")
    html = html.replace('0948 444 001', "<?php echo esc_html( ck_phone() ); ?>")
    html = html.replace('mailto:info@cistimeklimy.sk', "mailto:<?php echo esc_attr( antispambot( ck_email() ) ); ?>")
    html = html.replace('info@cistimeklimy.sk', "<?php echo esc_html( antispambot( ck_email() ) ); ?>")
    html = html.replace('Po – Ne: 7:00 – 20:00', "<?php echo esc_html( ck_opt( 'hours' ) ); ?>")
    # odkazy medzi stránkami
    html = html.replace('href="radiatory.html"', 'href="<?php echo esc_url( ck_radiatory_url() ); ?>"')
    html = re.sub(r'href="index\.html#([\w-]+)"', r'''href="<?php echo esc_url( ck_home_anchor( '\1' ) ); ?>"''', html)
    html = html.replace('href="index.html"', 'href="<?php echo esc_url( home_url( \'/\' ) ); ?>"')
    return html


def footer_links(html):
    """Odkazy v pätičke fungujú z každej stránky."""
    for anchor in ("sluzby", "postup", "referencie", "kontakt"):
        html = html.replace(f'href="#{anchor}"', f"href=\"<?php echo esc_url( ck_home_anchor( '{anchor}' ) ); ?>\"")
    return html


def build_header(index):
    top = between(index, "<body>\n", "<main>")
    top = common(top)
    top = re.sub(
        r"<ul>\s*<li><a href=.*?</ul>",
        "<?php\n    wp_nav_menu( array(\n      'theme_location' => 'primary',\n      'container'      => false,\n"
        "      'depth'          => 1,\n      'fallback_cb'    => 'ck_menu_fallback',\n    ) );\n    ?>",
        top,
        flags=re.S,
    )
    top = top.replace(
        '<img src="<?php echo esc_url( CK_ASSETS ); ?>/logo/cistimeklimy-logo.svg" alt="Čistímeklimy.sk"',
        '<img src="<?php echo esc_url( CK_ASSETS ); ?>/logo/cistimeklimy-logo.svg" alt="<?php echo esc_attr( get_bloginfo( \'name\' ) ); ?>"',
    )
    return (
        "<?php\n/**\n * Hlavička webu. (Generované z ../index.html skriptom build_theme.py)\n */\n"
        "defined( 'ABSPATH' ) || exit;\n?>"
        '<!doctype html>\n<html <?php language_attributes(); ?>>\n<head>\n'
        '<meta charset="<?php bloginfo( \'charset\' ); ?>">\n'
        '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">\n'
        "<?php wp_head(); ?>\n</head>\n<body <?php body_class(); ?>>\n<?php wp_body_open(); ?>\n"
        '<a class="screen-reader-text" href="#main">Preskočiť na obsah</a>\n'
        + top.strip()
        + '\n\n<main id="main">\n'
    )


def build_footer(index):
    band = between(index, "<!-- PÁS NAD PÄTIČKOU -->", "</main>", include_start=True)
    foot = between(index, "</main>", '<script src="assets/js/main.js"></script>')
    band = common(band)
    band = band.replace(
        "<h2>Zlepšite kvalitu vzduchu ešte dnes</h2>",
        "<h2><?php echo esc_html( $ck_band['title'] ); ?></h2>",
    )
    band = band.replace(
        "<p>Objednajte si profesionálne čistenie klimatizácie a dýchajte zdravší vzduch.</p>",
        "<p><?php echo esc_html( $ck_band['text'] ); ?></p>",
    )
    band = footer_links(band)
    foot = footer_links(common(foot))
    foot = foot.replace(
        '<a href="#" aria-label="Facebook">',
        "<?php if ( ck_opt( 'facebook' ) ) : ?><a href=\"<?php echo esc_url( ck_opt( 'facebook' ) ); ?>\" aria-label=\"Facebook\" rel=\"noopener\">",
    )
    foot = foot.replace(
        '<a href="#" aria-label="Instagram">',
        "<?php endif; if ( ck_opt( 'instagram' ) ) : ?><a href=\"<?php echo esc_url( ck_opt( 'instagram' ) ); ?>\" aria-label=\"Instagram\" rel=\"noopener\">",
    )
    foot = re.sub(r'(aria-label="Instagram".*?</svg></a>)', r"\1<?php endif; ?>", foot, count=1, flags=re.S)
    foot = foot.replace('<a href="#">Ochrana osobných údajov</a>', '<a href="<?php echo esc_url( ck_privacy_url() ); ?>">Ochrana osobných údajov</a>')
    foot = foot.replace("<li>Bratislava a okolie</li>", "<li><?php echo esc_html( ck_opt( 'area' ) ); ?></li>")
    foot = foot.replace("© 2026 Čistímeklimy.sk", "© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>")
    foot = foot.replace(
        'alt="Čistímeklimy.sk" width="200"',
        'alt="<?php echo esc_attr( get_bloginfo( \'name\' ) ); ?>" width="200"',
    )
    return (
        "<?php\n/**\n * Pás nad pätičkou + pätička. (Generované z ../index.html skriptom build_theme.py)\n"
        " * Text pásu sa dá zmeniť: get_footer( null, array( 'title' => '…', 'text' => '…' ) ).\n */\n"
        "defined( 'ABSPATH' ) || exit;\n"
        "$ck_band = wp_parse_args( isset( $args ) && is_array( $args ) ? $args : array(), array(\n"
        "  'title' => 'Zlepšite kvalitu vzduchu ešte dnes',\n"
        "  'text'  => 'Objednajte si profesionálne čistenie klimatizácie a dýchajte zdravší vzduch.',\n"
        ") );\n?>\n"
        + band.strip()
        + "\n\n</main>\n"
        + foot.strip()
        + "\n\n<?php wp_footer(); ?>\n</body>\n</html>\n"
    )


def build_front(index):
    main = between(index, "<main>\n", "<!-- PÁS NAD PÄTIČKOU -->")
    # snímky slidera z Customizera
    slides_html = between(main, '  <div class="hero-slides">\n', "  </div>\n  <canvas")
    loop = (
        "<?php foreach ( $ck_slides as $ck_i => $ck_slide ) : ?>\n"
        '    <figure class="slide" data-caption="<?php echo esc_attr( $ck_slide[\'caption\'] ); ?>" '
        'data-title="<?php echo esc_attr( $ck_slide[\'title\'] ); ?>" style="--focus: <?php echo esc_attr( $ck_slide[\'focus\'] ); ?>">'
        '<img src="<?php echo esc_url( $ck_slide[\'src\'] ); ?>"'
        "<?php if ( $ck_slide['srcset'] ) : ?> srcset=\"<?php echo esc_attr( $ck_slide['srcset'] ); ?>\" sizes=\"100vw\"<?php endif; ?>"
        ' alt="<?php echo esc_attr( $ck_slide[\'alt\'] ); ?>"'
        "<?php echo 0 === $ck_i ? ' fetchpriority=\"high\"' : ' loading=\"lazy\"'; ?>></figure>\n"
        "    <?php endforeach; ?>\n"
    )
    main = main.replace(slides_html, loop)
    main = re.sub(
        r'<h1 class="hero-title">.*?</h1>',
        "<h1 class=\"hero-title\"><?php echo ck_kses_title( $ck_slides[0]['title'] ); ?></h1>",
        main,
        flags=re.S,
    )
    # formulár objednávky → server
    main = main.replace(
        '<form class="order-card rv d2" data-order data-demo>',
        '<form class="order-card rv d2" data-order method="post" action="<?php echo esc_url( admin_url( \'admin-post.php\' ) ); ?>">\n'
        "      <?php ck_order_fields(); ?>",
    )
    main = main.replace('<p class="form-ok" hidden></p>', "<?php ck_order_notice(); ?>")
    main = common(main)
    return (
        "<?php\n/**\n * Úvodná stránka. (Generované z ../index.html skriptom build_theme.py)\n"
        " * Kontakty a slider: Vzhľad → Prispôsobiť → Čistímeklimy.\n */\n"
        "defined( 'ABSPATH' ) || exit;\nget_header();\n$ck_slides = ck_slides();\n?>\n"
        + main.rstrip()
        + "\n\n<?php get_footer(); ?>\n"
    )


def build_radiatory(rad):
    main = between(rad, "<main>\n", "<!-- PÁS NAD PÄTIČKOU -->")
    prose = between(main, '<article class="prose">', "</article>")
    band_title = re.search(r'<div class="band rv">.*?<h2>(.*?)</h2>', rad, re.S).group(1)
    band_text = re.search(r'<div class="band rv">.*?<p>(.*?)</p>', rad, re.S).group(1)
    main = main.replace(
        prose,
        "\n      <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>\n    ",
    )
    main = common(main)
    content = prose.strip() + "\n"
    tpl = (
        "<?php\n/**\n * Template Name: Radiátory\n *\n"
        " * Podstránka o čistení radiátorov. Text článku sa upravuje v editore stránky.\n"
        " * (Generované z ../radiatory.html skriptom build_theme.py)\n */\n"
        "defined( 'ABSPATH' ) || exit;\nget_header();\n?>\n"
        + main.rstrip()
        + "\n\n<?php get_footer( null, array(\n"
        f"  'title' => '{band_title}',\n  'text'  => '{band_text}',\n) ); ?>\n"
    )
    return tpl, content


PAGE_PHP = """<?php
/**
 * Bežná stránka (napr. Ochrana osobných údajov).
 */
defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) :
	the_post();
	?>
<section class="page-hero">
  <div class="wrap">
    <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Úvod</a> / <?php the_title(); ?></p>
    <h1><?php the_title(); ?></h1>
  </div>
</section>
<section class="page-simple">
  <div class="wrap">
    <article class="prose"><?php the_content(); ?></article>
  </div>
</section>
	<?php
endwhile;
get_footer();
"""

INDEX_PHP = """<?php
/**
 * Záložná šablóna (blog, archívy, vyhľadávanie).
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="page-hero">
  <div class="wrap">
    <h1><?php echo is_home() ? esc_html( get_the_title( get_option( 'page_for_posts' ) ) ?: 'Blog' ) : wp_kses_post( get_the_archive_title() ); ?></h1>
  </div>
</section>
<section class="page-simple">
  <div class="wrap prose">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
      </article>
    <?php endwhile; the_posts_pagination(); else : ?>
      <p>Nič sme nenašli.</p>
    <?php endif; ?>
  </div>
</section>
<?php
get_footer();
"""

SINGLE_PHP = """<?php
/**
 * Článok.
 */
defined( 'ABSPATH' ) || exit;
get_header();
while ( have_posts() ) :
	the_post();
	?>
<section class="page-hero">
  <div class="wrap">
    <p class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Úvod</a> / <?php the_title(); ?></p>
    <h1><?php the_title(); ?></h1>
  </div>
</section>
<section class="page-simple">
  <div class="wrap">
    <article class="prose"><?php the_content(); ?></article>
  </div>
</section>
	<?php
endwhile;
get_footer();
"""

NOT_FOUND_PHP = """<?php
/**
 * Stránka nenájdená.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="page-hero">
  <div class="wrap">
    <span class="tagline">Chyba 404</span>
    <h1 style="margin-top:16px">Táto stránka <em>neexistuje</em></h1>
    <p class="lead" style="margin-top:16px">Možno bola presunutá. Pokračujte na úvod alebo nám rovno zavolajte.</p>
    <div class="hero-actions" style="margin-top:24px">
      <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Na úvodnú stránku</span></a>
      <a class="btn ghost" href="<?php echo esc_attr( ck_tel() ); ?>"><span><?php echo esc_html( ck_phone() ); ?></span></a>
    </div>
  </div>
</section>
<?php
get_footer();
"""

FAVICON = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
<rect width="64" height="64" rx="14" fill="#0c0d0d"/>
<path d="M44 16H27c-7 0-10 3-13 9l-4 9c-3 7 0 11 7 11h18l4-8H20l6-13h14z" fill="#4b96d1" transform="skewX(-8) translate(6 0)"/>
<rect x="14" y="52" width="16" height="3" rx="1.5" fill="#4b96d1"/><rect x="34" y="52" width="16" height="3" rx="1.5" fill="#ec7b2e"/>
</svg>
"""


def main():
    index = (SITE / "index.html").read_text(encoding="utf-8")
    rad = (SITE / "radiatory.html").read_text(encoding="utf-8")

    if DIST.exists():
        shutil.rmtree(DIST)
    shutil.copytree(SRC, THEME)
    # súbory webu
    for sub in ("css", "js", "fonts", "img", "logo"):
        dst = THEME / "assets" / sub
        dst.mkdir(parents=True, exist_ok=True)
        for f in (SITE / "assets" / sub).iterdir():
            if f.suffix == ".pdf":
                continue
            shutil.copy2(f, dst / f.name)
    (THEME / "assets/logo/favicon.svg").write_text(FAVICON, encoding="utf-8")

    (THEME / "header.php").write_text(build_header(index), encoding="utf-8")
    (THEME / "footer.php").write_text(build_footer(index), encoding="utf-8")
    (THEME / "front-page.php").write_text(build_front(index), encoding="utf-8")
    tpl, content = build_radiatory(rad)
    (THEME / "template-radiatory.php").write_text(tpl, encoding="utf-8")
    (THEME / "inc/radiatory-content.html").write_text(content, encoding="utf-8")
    (THEME / "page.php").write_text(PAGE_PHP, encoding="utf-8")
    (THEME / "single.php").write_text(SINGLE_PHP, encoding="utf-8")
    (THEME / "index.php").write_text(INDEX_PHP, encoding="utf-8")
    (THEME / "404.php").write_text(NOT_FOUND_PHP, encoding="utf-8")

    # náhľad témy vo WordPress (1200 × 900)
    prev = SITE / "previews" / "index-1440.jpg"
    if prev.exists():
        im = Image.open(prev).convert("RGB")
        im = im.crop((0, 0, 1440, 1080)).resize((1200, 900), Image.LANCZOS)
        im.save(THEME / "screenshot.png", optimize=True)

    zpath = DIST / "cistimeklimy.zip"
    with zipfile.ZipFile(zpath, "w", zipfile.ZIP_DEFLATED) as z:
        for f in sorted(THEME.rglob("*")):
            if f.is_file():
                z.write(f, f.relative_to(DIST))
    print("Téma:", THEME)
    print("ZIP: ", zpath, f"({zpath.stat().st_size // 1024} kB)")


if __name__ == "__main__":
    main()
