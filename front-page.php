<?php
/**
 * front-page.php
 * WordPress uses this automatically as the static homepage.
 *
 * All content is hardcoded — no ACF fields.
 * Dynamic elements (page links, god links) are fetched
 * directly from WordPress via get_page_by_path() and
 * get_posts() so they never break if slugs change.
 *
 * Structure:
 *   1. Hero
 *   2. Featured Story — Love Triangle
 *   3. Three God Cards
 *   4. Cultural Grounding
 *   5. Pantheon Teaser
 *   6. About / Mission Teaser
 */

get_header();

// ------------------------------------------------------------------
// DYNAMIC URLS — fetched once at top, used throughout.
// All pulled from WordPress directly — no hardcoded URLs,
// no ACF fields. If a page slug changes, update it here only.
// ------------------------------------------------------------------

// Archives and static pages
$gods_link = get_post_type_archive_link('god') ?: '#';
$cc_page = get_page_by_path('cultural-context');
$about_page = get_page_by_path('about');
$lt_page = get_page_by_path('love-triangle');
$cc_link = $cc_page ? get_permalink($cc_page->ID) : '#';
$about_link = $about_page ? get_permalink($about_page->ID) : '#';
$lt_link = $lt_page ? get_permalink($lt_page->ID) : '#';

// Individual god pages — pulled by CPT slug, not ACF
// This means links always work as long as the god post exists.
$sango_posts = get_posts(['post_type' => 'god', 'name' => 'sango', 'posts_per_page' => 1]);
$oya_posts = get_posts(['post_type' => 'god', 'name' => 'oya', 'posts_per_page' => 1]);
$ogun_posts = get_posts(['post_type' => 'god', 'name' => 'ogun', 'posts_per_page' => 1]);

$sango_link = $sango_posts ? get_permalink($sango_posts[0]->ID) : '#';
$oya_link = $oya_posts ? get_permalink($oya_posts[0]->ID) : '#';
$ogun_link = $ogun_posts ? get_permalink($ogun_posts[0]->ID) : '#';
?>

<div class="hp">

    <?php
    // ==================================================================
// SECTION 1 — HERO
// ==================================================================
    ?>
    <section class="hp-hero">


        <div class="hp-hero-content">

            <p class="hp-hero-origin">
                Yoruba Mythology &mdash; Nigeria, West Africa
            </p>

            <h1 class="hp-hero-title">
                <span class="hp-site-name">&#204;t&#224;n &#210;r&#236;&#351;&#224;</span>
                <span class="hp-hero-line">
                    The Gods of Yoruba.
                    Told the way they deserve to be.
                </span>
            </h1>

            <a href="<?php echo esc_url($gods_link); ?>" class="btn-primary">
                Meet the Gods
            </a>

        </div>

    </section>

    <?php
    // ==================================================================
// SECTION 2 — FEATURED STORY: THE LOVE TRIANGLE.
// ==================================================================
    ?>
    <section class="hp-story">
        <div class="hp-inner">

            <p class="hp-label">Featured Story</p>
            <div class="hp-story-card"><div class="hp-story-card-overlay"></div>

                <div class="hp-story-card-band"></div>
                <div class="hp-story-card-body">

                    <h2 class="hp-story-title">
                        She left the Smith for the Storm
                    </h2>

                    <p class="hp-story-excerpt">
                        Ọya was Ogun&#8217;s wife first. Then &#350;&#224;ng&#243; arrived &#8212;
                        all thunder, fire, and war. What happened next became one of the most
                        famous stories in Yoruba mythology. Three gods. One woman.
                        A rivalry that still echoes.
                    </p>

                    <div class="hp-story-cast">
                        <span class="hp-cast-pill" style="--cp:#FF6B4A;">
                            <span class="hp-cast-dot"></span>&#350;&#224;ng&#243;
                        </span>
                        <span class="hp-cast-pill" style="--cp:#9B7FE0;">
                            <span class="hp-cast-dot"></span>Ọya
                        </span>
                        <span class="hp-cast-pill" style="--cp:#4FA876;">
                            <span class="hp-cast-dot"></span>Ogun
                        </span>
                    </div>

                    <a href="<?php echo esc_url($lt_link); ?>" class="btn-primary">
                        Read the Love Triangle
                    </a>
                </div>
                <div class="hp-story-image">
                    <!-- <img src="<?= get_template_directory_uri(); ?>/images/triangle.svg" alt="Hero Image"> -->
                </div>
            </div>
        </div>

    </section>

    <?php
    // ==================================================================
// SECTION 3 — THREE GOD CARDS
// ==================================================================
    ?>
    <section class="hp-gods">
        <div class="hp-inner">

            <p class="hp-label">The Gods</p>

            <div class="hp-gods-grid">

                <a href="<?php echo esc_url($sango_link); ?>" class="hp-god-card" style="--gc:#FF6B4A;"
                    aria-label="Explore &#350;&#224;ng&#243;">
                    <div class="hp-god-card-top">
                        <div>
                            <h3 class="hp-god-name">&#350;&#224;ng&#243;</h3>
                            <p class="hp-god-domain">God of Thunder, Lightning &amp; Justice</p>
                        </div>
                    </div>
                    <p class="hp-god-line">
                        The King who became a god. The god who never stopped being a king.
                    </p>
                    <span class="hp-god-cta" aria-hidden="true">Explore &#350;&#224;ng&#243; &rarr;</span>
                </a>

                <a href="<?php echo esc_url($oya_link); ?>" class="hp-god-card" style="--gc:#9B7FE0;"
                    aria-label="Explore Ọya">
                    <div class="hp-god-card-top">
                        <div>
                            <h3 class="hp-god-name">Ọya</h3>
                            <p class="hp-god-domain">Goddess of Wind, Storms &amp; Transformation</p>
                        </div>
                    </div>
                    <p class="hp-god-line">
                        Nothing in her world stays the same. That is exactly how she wants it.
                    </p>
                    <span class="hp-god-cta" aria-hidden="true">Explore Ọya &rarr;</span>
                </a>

                <a href="<?php echo esc_url($ogun_link); ?>" class="hp-god-card" style="--gc:#4FA876;"
                    aria-label="Explore Ogun">
                    <div class="hp-god-card-top">
                        <div>
                            <h3 class="hp-god-name">Ogun</h3>
                            <p class="hp-god-domain">God of Iron, War &amp; Labour</p>
                        </div>
                    </div>
                    <p class="hp-god-line">
                        He built the tools that shaped the world. He also destroyed with them.
                    </p>
                    <span class="hp-god-cta" aria-hidden="true">Explore Ogun &rarr;</span>
                </a>

            </div>
        </div>
    </section>

    <?php
    // ==================================================================
// SECTION 4 — CULTURAL GROUNDING
// ==================================================================
    ?>
    <section class="hp-culture">
        <div class="hp-inner">

            <p class="hp-label">The Tradition</p>

            <div class="hp-culture-body">
                <h2 class="hp-culture-hook">
                    These are not fictional gods.
                </h2>
                <p class="hp-culture-text">
                    The Orishas are the divine forces at the centre of Yoruba cosmology &#8212;
                    a living spiritual tradition from Nigeria and West Africa, still actively
                    practised by millions across the world. These stories were told long before
                    they were written down, and they are still being told today.
                </p>
                <a href="<?php echo esc_url($cc_link); ?>" class="hp-text-link">
                    Read about the Yoruba tradition &rarr;
                </a>
            </div>

        </div>
    </section>

    <?php
    // ==================================================================
// SECTION 5 — PANTHEON TEASER.
// ==================================================================
    ?>
    <section class="hp-pantheon">
        <div class="hp-inner">

            <p class="hp-label">The Pantheon</p>
            <div class="hp-pantheon-content">
                <div class="hp-pantheon-body">
                    <h2 class="hp-pantheon-count">
                        Three gods.<br>
                        <span class="hp-hl">For now.</span>
                    </h2>
                    <p class="hp-pantheon-text">
                        The Yoruba tradition includes hundreds of Orishas. This site begins with
                        &#350;&#224;ng&#243;, Ogun and Ọya &#8212; and the story that connects them.
                        More will follow. The Yoruba tradition includes hundreds of Orishas. This site begins with
                        &#350;&#224;ng&#243;, 
                    </p>
                    <a href="<?php echo esc_url($gods_link); ?>" class="btn-ghost">
                        Explore the Pantheon
                    </a>
                </div>
                <div class="hp-pantheon-image">
                    <img src="<?= get_template_directory_uri(); ?>/images/triangle.svg" alt="Hero Image" width="" height="">
                </div>
            </div>

        </div>
    </section>

    <?php
    // ==================================================================
// SECTION 6 — ABOUT / MISSION TEASER
// ==================================================================
    ?>
    <section class="hp-about-tease">
        <div class="hp-inner">

            <p class="hp-label">About This Project</p>

            <div class="hp-about-tease-body">
                <h2 class="hp-about-tease-heading">
                    ITAN was built because the doorway didn&#8217;t exist.
                </h2>
                <p class="hp-about-tease-text">
                    Yoruba mythology deserves the same digital presence as Greek, Norse and
                    Egyptian traditions. This project is an attempt to build that &#8212;
                    one story at a time.
                </p>
                <a href="<?php echo esc_url($about_link); ?>" class="hp-text-link">
                    Read about the project &rarr;
                </a>
            </div>

        </div>
    </section>

</div><!-- .hp -->

<?php get_footer(); ?>