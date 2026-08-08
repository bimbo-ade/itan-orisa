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

       

    </section>

</div>

<?php get_footer(); ?>