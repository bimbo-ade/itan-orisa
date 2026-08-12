<?php
/**
 * Template Name: Home
 */

get_header();

$gods_archive = get_post_type_archive_link('god') ?: '#';
$stories_archive = get_post_type_archive_link('story') ?: '#';

$cc_page = get_page_by_path('cultural-context');
$cc_url = $cc_page ? get_permalink($cc_page->ID) : '#';

$lt_page = get_page_by_path('love-triangle');
$lt_url = $lt_page ? get_permalink($lt_page->ID) : '#';
?>

<div class="home-page">

    <!-- =========================================================
         1. HERO
    ========================================================== -->

    <?php
    $hero_image = get_field('home_hero_image');
    $hero_heading = get_field('home_hero_heading') ?: 'The Gods Of Yorùbá';
    $hero_tagline = get_field('home_hero_tagline') ?: 'Ancient Powers. Enduring Legacies.';
    ?>

    <section class="home-hero">

        <?php if ($hero_image): ?>
            <div class="home-hero-image" aria-hidden="true">
                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="" fetchpriority="high">
            </div>
        <?php endif; ?>

        <div class="home-hero-atmosphere" aria-hidden="true"></div>

        <div class="home-hero-corner tl" aria-hidden="true"></div>
        <div class="home-hero-corner tr" aria-hidden="true"></div>

        <div class="home-hero-content">

            <span class="home-eyebrow"> <?php echo wp_kses_post($hero_heading); ?>
            </span>

            <h1>ÌTÀN ÒRÌṢÀ
            </h1>

            <p>
                <?php echo esc_html($hero_tagline); ?>
            </p>

            <div class="home-hero-cta">
                <a href="<?php echo esc_url($gods_archive); ?>" class="btn-primary">
                    Meet The Gods
                </a>

                <a href="#home-featured-story" class="btn-ghost">
                    Explore The Story
                </a>
            </div>

        </div>

    </section>


    <!-- =========================================================
         2. FEATURED GODS
    ========================================================== -->

    <?php
    $featured_gods = [];

    for ($i = 1; $i <= 6; $i++) {
        $god_post = get_field("home_featured_god_{$i}");

        if ($god_post) {
            $featured_gods[] = $god_post;
        }
    }
    ?>

    <?php if ($featured_gods): ?>

        <section class="home-gods">

            <div class="home-section-heading">

                <div>
                   
                </div>

                <div>
                    <h2>Meet The Gods</h2>
                    <p>
                        Explore the stories, powers and traditions surrounding
                        the Orishas.
                    </p>
                </div>

            </div>

            <div class="home-gods-grid">

                <?php foreach ($featured_gods as $god): ?>

                    <?php
                    $g_color = get_field('god_color', $god->ID) ?: '#f5c842';

                    $g_hex = ltrim($g_color, '#');

                    if (strlen($g_hex) === 3) {
                        $g_hex =
                            $g_hex[0] . $g_hex[0] .
                            $g_hex[1] . $g_hex[1] .
                            $g_hex[2] . $g_hex[2];
                    }

                    $g_rgb =
                        hexdec(substr($g_hex, 0, 2)) . ', ' .
                        hexdec(substr($g_hex, 2, 2)) . ', ' .
                        hexdec(substr($g_hex, 4, 2));

                    $g_image = get_field('hero_image', $god->ID);
                    $g_tag = get_field('god_tagline', $god->ID);
                    ?>

                    <a href="<?php echo esc_url(get_permalink($god->ID)); ?>" class="home-god-card" style="
                            --card-color: <?php echo esc_attr($g_color); ?>;
                            --card-rgb: <?php echo esc_attr($g_rgb); ?>;
                        ">

                        <?php if ($g_image): ?>

                            <div class="home-god-media">

                                <img src="<?php echo esc_url($g_image['url']); ?>" alt="" loading="lazy">

                            </div>

                        <?php endif; ?>

                        <div class="home-god-body">

                            <strong>
                                <?php echo esc_html($god->post_title); ?>
                            </strong>

                            <?php if ($g_tag): ?>
                                <span>
                                    <?php echo esc_html($g_tag); ?>
                                </span>
                            <?php endif; ?>

                            

                        </div>

                    </a>

                <?php endforeach; ?>

            </div>

            <div class="home-gods-more">

                <a href="<?php echo esc_url($gods_archive); ?>">
                    Explore All Orishas
                    <span aria-hidden="true">→</span>
                </a>

            </div>

        </section>

    <?php endif; ?>


    <!-- =========================================================
         3. FEATURED LOVE TRIANGLE
    ========================================================== -->

    <?php
    $tri_img_left = get_field('home_triangle_image_left');
    $tri_img_right = get_field('home_triangle_image_right');

    $tri_heading =
        get_field('home_triangle_heading')
        ?: 'She Left The Smith For The Storm';

    $tri_subtitle =
        get_field('home_triangle_subtitle')
        ?: 'The story of Ògún, Ọ̀yá and Ṣàngó.';
    ?>

    <?php if ($tri_img_left || $tri_img_right): ?>

        <section class="home-triangle" id="home-featured-story">

            <?php if ($tri_img_left): ?>

                <div class="home-triangle-side home-triangle-left" aria-hidden="true">

                    <img src="<?php echo esc_url($tri_img_left['url']); ?>" alt="" loading="lazy">

                </div>

            <?php endif; ?>


            <?php if ($tri_img_right): ?>

                <div class="home-triangle-side home-triangle-right" aria-hidden="true">

                    <img src="<?php echo esc_url($tri_img_right['url']); ?>" alt="" loading="lazy">

                </div>

            <?php endif; ?>


            <div class="home-triangle-atmosphere" aria-hidden="true"></div>
            <div class="home-triangle-overlay" aria-hidden="true"></div>


            <div class="home-triangle-content">

                <small>Featured Story</small>

                <h2>
                    <?php echo wp_kses_post($tri_heading); ?>
                </h2>

                <p>
                    <?php echo esc_html($tri_subtitle); ?>
                </p>

                <a href="<?php echo esc_url($lt_url); ?>" class="btn-primary">
                    Read The Love Triangle
                    <span aria-hidden="true">→</span>
                </a>

            </div>

        </section>

    <?php endif; ?>

    <!-- =========================================================
         4. CULTURAL CONTEXT
    ========================================================== -->
    <?php
    $ctx_image =
        get_field('home_context_image');

    $ctx_heading =
        get_field('home_context_heading')
        ?: 'Rooted In History. Alive In Culture.';

    $ctx_text =
        get_field('home_context_text');
    ?>

    <section class="home-context">

        <div class="home-context-inner">

            <?php if ($ctx_image): ?>

                <div class="home-context-image">

                    <img src="<?php echo esc_url($ctx_image['url']); ?>"
                        alt="<?php echo esc_attr($ctx_image['alt'] ?? ''); ?>" loading="lazy">

                </div>

            <?php endif; ?>


            <div class="home-context-text">

                <small>
                    Cultural Context
                </small>

                <h2>
                    <?php echo wp_kses_post($ctx_heading); ?>
                </h2>

                <?php if ($ctx_text): ?>

                    <p>
                        <?php echo wp_kses_post($ctx_text); ?>
                    </p>

                <?php endif; ?>

                <a href="<?php echo esc_url($cc_url); ?>" class="btn-ghost">
                    Explore The Context
                    <span aria-hidden="true">→</span>
                </a>

            </div>

        </div>

    </section>

    <!-- =========================================================
         5. LATEST STORIES
    ========================================================== -->
    <?php
    $stories_query = new WP_Query([
        'post_type' => 'story',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    ?>

    <section class="home-stories">

        <div class="home-stories-header">
                <h2>Latest Tales</h2>

            <a href="<?php echo esc_url($stories_archive); ?>">
                View All Stories &rarr;
            </a>
        </div>

        <?php if ($stories_query->have_posts()): ?>

            <div class="home-stories-grid">

                <?php while ($stories_query->have_posts()):
                    $stories_query->the_post();

                    // Featured image first
                    $story_image = get_the_post_thumbnail_url(get_the_ID(), 'large');

                    // ACF fallback
                    if (!$story_image) {
                        $acf_image = get_field('hero_image');

                        if (!$acf_image) {
                            $acf_image = get_field('triangle_image_left');
                        }

                        if ($acf_image) {
                            $story_image = $acf_image['url'];
                        }
                    }
                    ?>

                    <a href="<?php the_permalink(); ?>" class="home-story-card">

                        <?php if ($story_image): ?>

                            <div class="home-story-media">
                                <img src="<?php echo esc_url($story_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"
                                    loading="lazy">
                            </div>

                        <?php endif; ?>

                        <div class="home-story-body">
                            <small>Story</small>
                            <h3><?php the_title(); ?></h3>
                            <span>Read Story &rarr;</span>
                        </div>

                    </a>

                <?php endwhile; ?>

            </div>

        <?php else: ?>

            <p class="home-stories-empty">
                Stories are on their way — check back soon.
            </p>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </section>


    <!-- =========================================================
         5. CULTURAL CONTEXT
    ========================================================== -->


        </div>

<?php get_footer(); ?>