<?php
/**
 * 404.php
 * Custom 404 error page for Ìtàn Òrìṣà.
 *
 * Stays on-theme — the gods didn't send you here.
 * Offers clear paths back into the site.
 *
 * Classes used:
 *   .error-page   — root wrapper
 *   .error-hero   — main content area
 *
 * Everything inside targeted by tag in CSS.
 */

get_header();

$gods_archive = get_post_type_archive_link( 'god' )    ?: home_url( '/gods/' );
$home_url     = home_url( '/' );
$lt_page      = get_page_by_path( 'love-triangle' );
$lt_url       = $lt_page ? get_permalink( $lt_page->ID ) : home_url( '/love-triangle/' );
?>

<div class="error-page">

    <section class="error-hero">

        <div aria-hidden="true"></div>

        <div>

            <span>404</span>

            <h1>
                Even the gods<br>
                <em>can&#8217;t find this page.</em>
            </h1>

            <p>
                Whatever you were looking for, it hasn&#8217;t been found &#8212;
                not by Ṣàngó&#8217;s lightning, Ọya&#8217;s winds,
                or Ogun&#8217;s relentless search.
                The page either doesn&#8217;t exist or has moved on.
            </p>

            <nav aria-label="Find your way back">
                <a href="<?php echo esc_url( $home_url ); ?>" class="btn-primary">
                    Back to the Homepage
                </a>
                <a href="<?php echo esc_url( $gods_archive ); ?>" class="btn-ghost">
                    Meet the Gods
                </a>
                <a href="<?php echo esc_url( $lt_url ); ?>">
                    Read the Love Triangle &rarr;
                </a>
            </nav>

        </div>

        <div class="error-symbols" aria-hidden="true">
            <span style="--es-colour:#D32F2F; --es-size:6rem;  --es-x:10%; --es-y:20%; --es-delay:0s;">&#9889;</span>
            <span style="--es-colour:#6A1B9A; --es-size:4rem;  --es-x:80%; --es-y:15%; --es-delay:0.4s;">&#127786;</span>
            <span style="--es-colour:#2E7D32; --es-size:5rem;  --es-x:70%; --es-y:70%; --es-delay:0.8s;">&#9876;</span>
            <span style="--es-colour:#D32F2F; --es-size:3rem;  --es-x:20%; --es-y:75%; --es-delay:1.2s;">&#9889;</span>
            <span style="--es-colour:#6A1B9A; --es-size:7rem;  --es-x:85%; --es-y:45%; --es-delay:0.2s;">&#127786;</span>
            <span style="--es-colour:#2E7D32; --es-size:2.5rem;--es-x:5%;  --es-y:50%; --es-delay:0.6s;">&#9876;</span>
        </div>

    </section>

</div>

<?php get_footer(); ?>