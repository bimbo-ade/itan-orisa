<?php

/**
 * 404.php
 */

get_header();

$gods_archive = get_post_type_archive_link('god') ?: home_url('/gods/');
$home_url = home_url('/');
?>


<div class="error-hero">
    <div>

        <span aria-hidden="true">404</span>

        <h1>
            Even the gods<br>
            <em>can&#8217;t find this page.</em>
        </h1>

        <p>
            Whatever you were looking for, it hasn&#8217;t been found,
            not by Ṣàngó&#8217;s lightning, Ọya&#8217;s winds,
            or Ogun&#8217;s relentless search.
            The page either doesn&#8217;t exist or has moved on.
        </p>

        <nav class="error-actions" aria-label="Error recovery navigation">
            <a href="<?php echo esc_url($home_url); ?>"
                class="btn-primary"
                aria-label="Return to the Itan Orisha home archive archive screen">
                Back to the Homepage
            </a>

            <a href="<?php echo esc_url($gods_archive); ?>"
                class="btn-ghost"
                aria-label="Explore the full directory index of the Orisha pantheon">
                Meet the Gods
            </a>
        </nav>

    </div>



</div>


<?php get_footer(); ?>