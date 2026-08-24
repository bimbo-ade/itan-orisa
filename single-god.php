<?php
/**
 * single-god.php 

 */

get_header();

while (have_posts()):
    the_post();

    $god_color = get_field('god_color');
    $hex = ltrim($god_color, '#');
    if (strlen($hex) === 3)
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    ?>



    <div class="single-god"
        style="--god: <?php echo esc_attr($god_color); ?>; --god-rgb: <?php echo esc_attr("$r, $g, $b"); ?>;">

        <?php $gods_archive = get_post_type_archive_link('god'); ?>

        <a href="<?php echo esc_url($gods_archive); ?>" class="god-back">
            &larr; Back to All Òrìṣà
        </a>

        <!-- ============================================================
      1. HERO
      ============================================================ -->
        <?php

        $hero_image = get_field('hero_image');
        $god_tagline = get_field('god_tagline');
        $hero_eyebrow = get_field('hero_eyebrow');
        $pronunciation = get_field('hero_pronunciation');
        ?>

        <section class="god-hero">
            <?php if ($hero_image): ?>
                <div class="god-hero-image">
                    <img src="<?php echo esc_url($hero_image['url']); ?>"
                        width="<?php echo esc_attr($hero_image['width'] ?: '1200'); ?>"
                        height="<?php echo esc_attr($hero_image['height'] ?: '684'); ?>"
                        alt="<?php echo esc_attr($hero_image['alt'] ?: get_the_title() . ' Orisha profile illustration'); ?>"
                        fetchpriority="high" decoding="async">
                </div>
            <?php endif; ?>

            <div class="god-hero-atmosphere" aria-hidden="true"></div>

            <div class="god-hero-content">
                <?php if ($hero_eyebrow): ?>
                    <p class="god-eyebrow"><?php echo wp_kses_post($hero_eyebrow); ?></p>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <?php if ($pronunciation): ?>
                    <p class="god-pronunciation">Pronounced— <?php echo esc_html($pronunciation); ?> </p>
                <?php endif; ?>

                <?php if ($god_tagline): ?>
                    <p class="god-tagline"><?php echo esc_html($god_tagline); ?></p>
                <?php endif; ?>

                <div class="god-hero-cta">
                    <a href="#god-journey" class="btn-primary">Explore Story &rarr;</a>
                    <a href="#god-worship" class="btn-ghost">Honor <?php the_title(); ?></a>
                </div>
            </div>
        </section>


        <!-- ============================================================
        2. QUICK FACTS
        ============================================================ -->
        <?php
        $quick_facts = [];
        for ($i = 1; $i <= 5; $i++) {
            $label = get_field("quick_fact_{$i}_label");
            $value = get_field("quick_fact_{$i}_value");
            if ($label && $value) {
                $quick_facts[] = [
                    'label' => $label,
                    'value' => $value,
                    'icon' => get_field("quick_fact_{$i}_icon") ?: '✦',
                ];
            }
        }
        ?>

        <?php if ($quick_facts): ?>
            <dl class="god-facts-bar">
                <?php foreach ($quick_facts as $fact): ?>
                    <div class="god-fact-item">

                        <dt>
                            <span class="god-fact-icon" aria-hidden="true"><?php echo esc_html($fact['icon']); ?></span>
                            <?php echo esc_html($fact['label']); ?>
                        </dt>

                        <dd><?php echo esc_html($fact['value']); ?></dd>

                    </div>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>



        <!-- ============================================================
        3.GOD SUMMARY 
        ============================================================ -->
        <?php
        $god_summary = get_field('god_summary');
        ?>
        <?php if ($god_summary): ?>
            <section class="god-summary">
                <h2>Who Is <?php the_title(); ?>?</h2>

                <div class="god-summary-content">
                    <?php echo wp_kses_post($god_summary); ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- ============================================================
       4. THE JOURNEY
       ============================================================ -->
        <?php

        $lt_page = get_page_by_path('love-triangle');
        $lt_url = $lt_page ? get_permalink($lt_page->ID) : '#';
        $story_page = get_field('full_story_link');

        $journey_heading = get_field('timeline_heading');
        $stages = [];
        for ($i = 1; $i <= 6; $i++) {
            $stage = get_field("timeline_{$i}_stage");
            if ($stage) {
                $stages[] = [
                    'stage' => $stage,
                    'desc' => get_field("timeline_{$i}_desc") ?: '',
                    'image' => get_field("timeline_{$i}_image") ?: null,
                ];
            }
        }
        ?>
        <?php if ($stages): ?>
            <section class="god-journey" id="god-journey">
                <div class="god-journey-header">
                    <h2><?php echo esc_html($journey_heading) . ' ' . get_the_title(); ?></h2>
                </div>

                <ol class="god-journey-track">
                    <?php foreach ($stages as $i => $stage): ?>
                        <li class="god-journey-card">


                            <span class="god-journey-number" aria-hidden="true"><?php echo esc_html($i + 1); ?></span>

                            <div class="god-journey-media">
                                <?php if ($stage['image']):
                                    echo wp_get_attachment_image(
                                        $stage['image']['ID'],
                                        'medium_large',
                                        false,
                                        [
                                            'alt' => $stage['stage'] ?: get_the_title() . ' milestone illustration',
                                            'loading' => 'lazy',
                                            'decoding' => 'async',
                                        ]
                                    );
                                endif; ?>

                                <div class="god-journey-text">
                                    <h3><?php echo esc_html($stage['stage']); ?></h3>
                                    <?php if ($stage['desc']): ?>
                                        <p><?php echo esc_html($stage['desc']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>

                <p class="god-journey-hint" aria-hidden="true">&larr; Scroll &rarr;</p>
            </section>
        <?php endif; ?>


        <!-- 
        ============================================================
        5. SYMBOLS — photo card grid, up to 8
        ============================================================ -->
        <?php
        $symbols_heading = get_field('symbols_heading') ?: 'Symbols Of ';
        $symbols = [];
        for ($i = 1; $i <= 8; $i++) {
            $s_title = get_field("symbol_{$i}_title");
            if ($s_title) {
                $symbols[] = [
                    'title' => $s_title,
                    'image' => get_field("symbol_{$i}_image") ?: null,
                    'icon' => get_field("symbol_{$i}_icon") ?: '✦',
                    'desc' => get_field("symbol_{$i}_desc") ?: '',
                ];
            }
        }
        ?>
        <?php
        $symbols_heading = get_field('symbols_heading') ?: 'Symbols Of';
        $symbols = [];
        for ($i = 1; $i <= 8; $i++) {
            $s_title = get_field("symbol_{$i}_title");
            if ($s_title) {
                $symbols[] = [
                    'title' => $s_title,
                    'image' => get_field("symbol_{$i}_image") ?: null,
                    'icon' => get_field("symbol_{$i}_icon") ?: '✦',
                    'desc' => get_field("symbol_{$i}_desc") ?: '',
                ];
            }
        }
        ?>
        <?php if ($symbols): ?>
            <section class="god-symbols" id="god-symbols">
                <h2><?php echo esc_html($symbols_heading) . ' ' . get_the_title(); ?></h2>

                <div class="god-symbols-grid">
                    <?php foreach ($symbols as $sym): ?>
                        <article class="god-symbol-card">
                            <div class="god-symbol-media">
                                <?php if ($sym['image']):
                                    echo wp_get_attachment_image(
                                        $sym['image']['ID'],
                                        'medium_large',
                                        false,
                                        [
                                            'alt' => $sym['title'] ?: get_the_title() . ' sacred symbol icon',
                                            'loading' => 'lazy',
                                            'decoding' => 'async',
                                        ]
                                    );
                                endif; ?>

                            </div>

                            <div class="god-symbol-body">
                                <h3><?php echo esc_html($sym['title']); ?></h3>
                                <?php if ($sym['desc']): ?>
                                    <p><?php echo esc_html($sym['desc']); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- ============================================================
       6.POWERS & ABILITIES — 
       ============================================================ -->
        <?php
        $powers_heading = get_field('powers_heading') ?: 'What ' . get_the_title() . ' Commands';
        $powers = [];
        for ($i = 1; $i <= 8; $i++) {
            $p_title = get_field("power_{$i}_title");
            if ($p_title) {
                $powers[] = [
                    'title' => $p_title,
                    'icon' => get_field("power_{$i}_icon") ?: '✦',
                    'desc' => get_field("power_{$i}_desc") ?: '',
                ];
            }
        }
        ?>
        <?php if ($powers): ?>
            <section class="god-powers" id="god-powers">
                <h2><?php echo esc_html($powers_heading); ?></h2>

                <ul class="god-powers-grid">
                    <?php foreach ($powers as $power): ?>
                        <li class="god-power-card">
                            <span class="god-power-icon" aria-hidden="true"><?php echo esc_html($power['icon']); ?></span>

                            <h3><?php echo esc_html($power['title']); ?></h3>

                            <?php if ($power['desc']): ?>
                                <p><?php echo esc_html($power['desc']); ?></p>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>

        <div class="god-divider" aria-hidden="true"></div>


        <!-- 
        ============================================================
        7. ORIGIN STORY & MAJOR MYTHS 
        ============================================================ -->
        <?php
        $myths_heading = get_field('myths_heading') ?: 'Major Myths';
        $myths = [];
        for ($i = 1; $i <= 6; $i++) {
            $m_title = get_field("myth_{$i}_title");
            if ($m_title) {
                $myths[] = ['title' => $m_title, 'desc' => get_field("myth_{$i}_desc") ?: ''];
            }
        }
        ?>
        <?php if ($myths): ?>
            <section class="god-myths" id="god-myths">
                <div class="god-myths-inner">
                    <h2><?php echo esc_html($myths_heading); ?></h2>

                    <?php foreach ($myths as $i => $myth): ?>
                        <article class="god-myth-item">
                            <span class="god-myth-number" aria-hidden="true"><?php echo esc_html($i + 1); ?></span>

                            <div class="god-myth-body">
                                <h3><?php echo esc_html($myth['title']); ?></h3>

                                <?php if ($myth['desc']): ?>
                                    <p><?php echo esc_html($myth['desc']); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- ============================================================
         8. WORSHIP TODAY — 
         ============================================================
     -->

        <?php
        $worship_heading = get_field('worship_heading') ?: 'Worship & Devotion';
        $worship_intro = get_field('worship_intro');
        $offerings = [];
        for ($i = 1; $i <= 8; $i++) {
            $w_title = get_field("worship_{$i}_title");
            if ($w_title) {
                $offerings[] = ['title' => $w_title, 'icon' => get_field("worship_{$i}_icon") ?: '✦'];
            }
        }
        $festivals = [];
        for ($i = 1; $i <= 3; $i++) {
            $f_name = get_field("festival_{$i}_name");
            if ($f_name) {
                $festivals[] = [
                    'name' => $f_name,
                    'date' => get_field("festival_{$i}_date") ?: '',
                    'location' => get_field("festival_{$i}_location") ?: '',
                ];
            }
        }
        ?>
        <?php if ($worship_intro || $offerings || $festivals): ?>
            <section class="god-worship" id="god-worship">
                <div class="god-worship-grid">
                    <div class="god-worship-col">
                        <h2><?php echo esc_html($worship_heading); ?></h2>

                        <?php if ($worship_intro): ?>
                            <p class="god-worship-intro"><?php echo wp_kses_post($worship_intro); ?></p>
                        <?php endif; ?>

                        <?php if ($offerings): ?>
                            <h3>Common Offerings</h3>

                            <ul class="god-offerings-grid">
                                <?php foreach ($offerings as $o): ?>
                                    <li>
                                        <span aria-hidden="true"><?php echo esc_html($o['icon']); ?></span>
                                        <p><?php echo esc_html($o['title']); ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($festivals): ?>
                            <h3>Festivals &amp; Celebrations</h3>

                            <ul class="god-festivals-list">
                                <?php foreach ($festivals as $f): ?>
                                    <li class="god-festival-item">
                                        <div class="god-festival-meta">
                                            <h4><?php echo esc_html($f['name']); ?></h4>

                                            <?php if ($f['location']): ?>
                                                <span class="god-festival-loc"><?php echo esc_html($f['location']); ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($f['date']): ?>
                                            <p class="god-festival-date"><?php echo esc_html($f['date']); ?></p>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- ============================================================
         9. LOVE TRIANGLE — split-image banner
         ============================================================ -->
        <?php
        $tri_img_left = get_field('triangle_image_left');
        $tri_img_right = get_field('triangle_image_right');
        $tri_heading = get_field('triangle_heading');
        $tri_sub = get_field('triangle_subtitle');

        $tri_link = get_field('triangle_read_link');
        if (!$tri_link) {
            $lt_page = get_page_by_path('love-triangle');
            $tri_link = $lt_page ? get_permalink($lt_page->ID) : '#';
        }
        ?>

        <?php if ($tri_heading): ?>
            <section class="god-triangle" id="god-triangle">
                <?php if ($tri_img_left): ?>
                    <div class="god-triangle-side">
                        <img src="<?php echo esc_url($tri_img_left['url']); ?>"
                            width="<?php echo esc_attr($tri_img_left['width'] ?? '500'); ?>"
                            height="<?php echo esc_attr($tri_img_left['height'] ?? '500'); ?>"
                            alt="<?php echo esc_attr($tri_img_left['alt'] ?: get_the_title() . ' left visual artifact'); ?>"
                            loading="lazy" decoding="async">
                    </div>
                <?php endif; ?>

                <?php if ($tri_img_right): ?>
                    <div class="god-triangle-side">
                        <img src="<?php echo esc_url($tri_img_right['url']); ?>" alt="">
                    </div>
                <?php endif; ?>

                <div class="god-triangle-content">
                    <h2><?php echo wp_kses_post($tri_heading); ?></h2>

                    <?php if ($tri_sub): ?>
                        <p><?php echo esc_html($tri_sub); ?></p>
                    <?php endif; ?>

                    <a href="<?php echo esc_url($tri_link); ?>"
                        aria-label="Read the full story about this relationship triangle">
                        Read The Full Story &rarr;
                    </a>
                </div>
            </section>
        <?php endif; ?>



        <!-- ============================================================
        10. FAQ — genuine FAQs only, capped at 6
        ============================================================ -->
        <?php
        $faqs = [];
        for ($i = 1; $i <= 6; $i++) {
            $q = get_field("faq_{$i}_question");
            if ($q) {
                $faqs[] = [
                    'q' => $q,
                    'a' => get_field("faq_{$i}_answer") ?: ''
                ];
            }
        }
        ?>
        <?php if ($faqs): ?>
            <section class="god-faq" id="god-faq">
                <div class="god-faq-inner">
                    <h2>Frequently Asked Questions</h2>

                    <?php foreach ($faqs as $faq): ?>
                        <details class="god-faq-item">
                            <summary class="god-faq-trigger">
                                <span class="god-faq-question"><?php echo esc_html($faq['q']); ?></span>
                                <span class="god-faq-icon" aria-hidden="true">+</span>
                            </summary>

                            <div class="god-faq-content">
                                <?php if ($faq['a']): ?>
                                    <?php echo wp_kses_post($faq['a']); ?>
                                <?php endif; ?>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>




        <!-- ============================================================
        11. PREV / NEXT Òrìṣà FOOTER STRIP
        ============================================================ -->
        <?php
        $prev_god = get_field('cross_nav_prev_god');
        $next_god = get_field('cross_nav_next_god');
        ?>
        <?php if ($prev_god || $next_god): ?>
            <nav class="god-crossnav" aria-label="Òrìṣà Chronology Navigation">

                <?php if ($prev_god): ?>
                    <a href="<?php echo esc_url(get_permalink($prev_god->ID)); ?>" class="god-crossnav-link god-crossnav-prev">
                        <span class="god-crossnav-label">Previous Òrìṣà</span>
                        <span class="god-crossnav-title"><?php echo esc_html($prev_god->post_title); ?></span>
                        <?php if ($prev_tagline = get_field('god_tagline', $prev_god->ID)): ?>
                            <span class="god-crossnav-tagline"><?php echo esc_html($prev_tagline); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

                <?php if ($next_god): ?>
                    <a href="<?php echo esc_url(get_permalink($next_god->ID)); ?>" class="god-crossnav-link god-crossnav-next">
                        <span class="god-crossnav-label">Next Òrìṣà</span>
                        <span class="god-crossnav-title"><?php echo esc_html($next_god->post_title); ?></span>
                        <?php if ($next_tagline = get_field('god_tagline', $next_god->ID)): ?>
                            <span class="god-crossnav-tagline"><?php echo esc_html($next_tagline); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

            </nav>
        <?php endif; ?>


    </div>
    <?php

    wp_enqueue_script('love-story', get_stylesheet_directory_uri() . '/js/love-story.js', [], '2.0', true);
    ?>

<?php endwhile; ?>
<?php get_footer(); ?>