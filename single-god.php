<?php
/**
 * single-god.php 

 */

get_header();

while (have_posts()):
    the_post();

    $god_color = get_field('god_color') ?: '#B3221D';
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
        &larr; Back to All Orishas
    </a>

        <?php
        // ============================================================
        // 1. HERO
        // ============================================================
        $hero_image = get_field('hero_image');
        $hero_image_mobile = get_field('hero_image_mobile');
        $god_tagline = get_field('god_tagline');
        $hero_eyebrow = get_field('hero_eyebrow') ?: 'Orisha &middot; Thunder &amp; Lightning';
        $pronunciation = get_field('hero_pronunciation');
        $hero_focal = get_field('hero_focal_point') ?: 'center';
        $hero_focal_mobile = get_field('hero_focal_point_mobile') ?: $hero_focal;
        ?>

        <section class="god-hero">
            <?php if ($hero_image): ?>
                <div class="god-hero-image" aria-hidden="true">
                    <picture>
                        <?php if ($hero_image_mobile): ?>
                            <source media="(max-width: 40em)" srcset="<?php echo esc_url($hero_image_mobile['url']); ?>">
                        <?php endif; ?>
                        <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>">
                    </picture>
                </div>
            <?php endif; ?>
            <div class="god-hero-atmosphere" aria-hidden="true"></div>

            <div class="god-hero-content">
                <span><?php echo wp_kses_post($hero_eyebrow); ?></span>
                <h1><?php the_title(); ?></h1>
                <?php if ($pronunciation): ?>
                    <p class="god-pronunciation">/ <?php echo esc_html($pronunciation); ?> /</p>
                <?php endif; ?>
                <?php if ($god_tagline): ?>
                    <p class="god-tagline"><?php echo esc_html($god_tagline); ?></p>
                <?php endif; ?>
                <div class="god-hero-cta">
                    <a href="#god-journey" class="btn-primary">Explore Story &rarr;</a>
                    <a href="#god-kinship" class="btn-ghost">Honor <?php the_title(); ?></a>
                </div>
            </div>
        </section>

        <?php
        // ============================================================
        // 2. QUICK FACTS
        // ============================================================
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
            <div class="god-facts-bar">
                <?php foreach ($quick_facts as $fact): ?>
                    <div>
                        <span aria-hidden="true"><?php echo esc_html($fact['icon']); ?></span>
                        <div>
                            <small><?php echo esc_html($fact['label']); ?></small>
                            <p><?php echo esc_html($fact['value']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        // ============================================================
        // GOD SUMMARY 
        // ============================================================
        $god_summary = get_field('god_summary');
        ?>
        <?php if ($god_summary): ?>
            <div class="god-summary">
                <small>Who Is <?php the_title(); ?>?</small>
                <p><?php echo esc_html($god_summary); ?></p>
            </div>
        <?php endif; ?>
        <?php
        // ============================================================
        // 4. THE JOURNEY
        // ============================================================
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
                    <h2><?php echo esc_html($journey_heading); ?>         <?php the_title(); ?></h2>
                </div>
                <div class="god-journey-track">
                    <?php foreach ($stages as $i => $stage): ?>
                        <?php if ($i > 0): ?>
                            <div class="god-journey-connector" aria-hidden="true">&#9670;</div>
                        <?php endif; ?>
                        <div class="god-journey-card">
                            <span class="god-journey-number"><?php echo esc_html($i + 1); ?></span>
                            <div class="god-journey-media">
                                <?php if ($stage['image']): ?>
                                    <?php
                                    $stage_image = wp_get_attachment_image(
                                        $stage['image']['ID'],
                                        'medium_large',
                                        false,
                                        [
                                            'alt' => $stage['stage'],
                                            'loading' => 'lazy',
                                        ]
                                    );

                                    echo $stage_image;
                                    ?>
                                <?php endif; ?>
                                <div class="god-journey-text">
                                    <strong><?php echo esc_html($stage['stage']); ?></strong>
                                    <?php if ($stage['desc']): ?>
                                        <p><?php echo esc_html($stage['desc']); ?></p><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="god-journey-hint">&larr; Scroll &rarr;</p>

                <?php if ($story_page): ?>
                    <div class="god-journey-footer">
                        <a href="<?php echo esc_url(get_permalink($story_page->ID)); ?>" class="btn-ghost">Read
                            <?php the_title(); ?>'s Full Story &rarr;</a>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ============================================================
        // 3. SYMBOLS — photo card grid, up to 8
        // ============================================================
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
        <?php if ($symbols): ?>
            <section class="god-symbols" id="god-symbols">
                <h2>Symbols Of <?php the_title(); ?> </h2>
                <div class="god-symbols-grid">
                    <?php foreach ($symbols as $sym): ?>
                        <div class="god-symbol-card">
                            <div class="god-symbol-media">
                                <?php if ($sym['image']): ?>
                                    <?php
                                    $symbol_image = wp_get_attachment_image(
                                        $sym['image']['ID'],
                                        'medium_large',
                                        false,
                                        [
                                            'alt' => $sym['title'],
                                            'loading' => 'lazy',
                                        ]
                                    );

                                    echo $symbol_image;
                                    ?>
                                <?php else: ?>
                                    <span aria-hidden="true"><?php echo esc_html($sym['icon']); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="god-symbol-body">
                                <strong><?php echo esc_html($sym['title']); ?></strong>
                                <?php if ($sym['desc']): ?>
                                    <p><?php echo esc_html($sym['desc']); ?></p><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ============================================================
        // POWERS & ABILITIES — 
        // ============================================================
        $powers_heading = get_field('powers_heading');
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
                <h2>What <?php the_title(); ?> Commands</h2>
                <div class="god-powers-grid">
                    <?php foreach ($powers as $power): ?>
                        <div class="god-power-card">
                            <span aria-hidden="true"><?php echo esc_html($power['icon']); ?></span>
                            <strong><?php echo esc_html($power['title']); ?></strong>
                            <?php if ($power['desc']): ?>
                                <p><?php echo esc_html($power['desc']); ?></p><?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <div class="god-divider" aria-hidden="true"></div>



        <?php
        // ============================================================
        // ORIGIN STORY & MAJOR MYTHS 
        // ============================================================
        $myths_heading = get_field('myths_heading');
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
                    <h2>Major Myths</h2>
                    <?php foreach ($myths as $i => $myth): ?>
                        <div class="god-myth-item">
                            <span class="god-myth-number" aria-hidden="true"><?php echo esc_html($i + 1); ?></span>
                            <div class="god-myth-body">
                                <strong><?php echo esc_html($myth['title']); ?></strong>
                                <?php if ($myth['desc']): ?>
                                    <p><?php echo esc_html($myth['desc']); ?></p><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>


        <?php
        // ============================================================
        // 6. RELATIONSHIPS + WORSHIP TODAY — 
        // ============================================================
        $relations = [];
        for ($i = 1; $i <= 3; $i++) {
            $r_name = get_field("relation_{$i}_name");
            if ($r_name) {
                $r_god_post = get_field("relation_{$i}_god_link");
                $relations[] = [
                    'name' => $r_name,
                    'role' => get_field("relation_{$i}_role") ?: '',
                    'teaser' => get_field("relation_{$i}_teaser") ?: '',
                    'image' => get_field("relation_{$i}_image") ?: null,
                    'icon' => get_field("relation_{$i}_icon") ?: '✦',
                    'url' => $r_god_post ? get_permalink($r_god_post->ID) : '#',
                ];
            }
        }

        $kinship_image = get_field('worship_image_1');
        $worship_heading = get_field('worship_heading');
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
        <?php if ($relations || $worship_heading): ?>
            <section class="god-kinship" id="god-kinship">
                <div class="god-kinship-grid">

                    <?php if ($relations): ?>
                        <div class="god-relations-col">
                            <h2>The Relationships</h2>
                            <div class="god-relations-row">
                                <?php foreach ($relations as $rel): ?>
                                    <a href="<?php echo esc_url($rel['url']); ?>" class="god-relation-card">
                                        <div class="god-relation-media">
                                            <?php if ($rel['image']): ?>
                                                <img src="<?php echo esc_url($rel['image']['url']); ?>"
                                                    alt="<?php echo esc_attr($rel['name']); ?>" loading="lazy">
                                            <?php else: ?>
                                                <span aria-hidden="true"><?php echo esc_html($rel['icon']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="god-relation-body">
                                            <strong><?php echo esc_html($rel['name']); ?></strong>
                                            <?php if ($rel['role']): ?><small><?php echo esc_html($rel['role']); ?></small><?php endif; ?>
                                            <?php if ($rel['teaser']): ?>
                                                <p><?php echo esc_html($rel['teaser']); ?></p><?php endif; ?>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($kinship_image): ?>
                        <div class="god-kinship-image">
                            <img src="<?php echo esc_url($kinship_image['url']); ?>" alt="" loading="lazy">
                        </div>
                    <?php endif; ?>

                    <div class="god-worship-col">
                        <h2>Worship</h2>
                        <?php if ($worship_intro): ?>
                            <p><?php echo wp_kses_post($worship_intro); ?></p><?php endif; ?>

                        <?php if ($offerings): ?>
                            <span class="god-offerings-label">Common Offerings</span>
                            <div class="god-offerings-grid">
                                <?php foreach ($offerings as $o): ?>
                                    <div><span
                                            aria-hidden="true"><?php echo esc_html($o['icon']); ?></span><small><?php echo esc_html($o['title']); ?></small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($festivals): ?>
                            <span class="god-festivals-label">Festivals</span>
                            <?php foreach ($festivals as $f): ?>
                                <div class="god-festival-item">
                                    <div>
                                        <strong><?php echo esc_html($f['name']); ?></strong>
                                        <?php if ($f['location']): ?><span class="god-festival-loc">
                                                <?php echo esc_html($f['location']); ?></span><?php endif; ?>
                                    </div>
                                    <?php if ($f['date']): ?><span
                                            class="god-festival-date"><?php echo esc_html($f['date']); ?></span><?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </section>
        <?php endif; ?>



        <?php
        // ============================================================
        // 5. LOVE TRIANGLE — split-image banner
        // ============================================================
        $tri_img_left = get_field('triangle_image_left');
        $tri_img_right = get_field('triangle_image_right');
        $tri_heading = get_field('triangle_heading');
        $tri_sub = get_field('triangle_subtitle');
        $tri_link = get_field('triangle_read_link') ?: $lt_url;
        ?>
        <?php if ($tri_heading): ?>
            <section class="god-triangle" id="god-triangle">
                <?php if ($tri_img_left): ?>
                    <div class="god-triangle-side" aria-hidden="true"><img src="<?php echo esc_url($tri_img_left['url']); ?>"
                            alt=""></div>
                <?php endif; ?>
                <?php if ($tri_img_right): ?>
                    <div class="god-triangle-side" aria-hidden="true"><img src="<?php echo esc_url($tri_img_right['url']); ?>"
                            alt=""></div>
                <?php endif; ?>
                <div class="god-triangle-content">
                    <h2><?php echo wp_kses_post($tri_heading); ?></h2>
                    <?php if ($tri_sub): ?>
                        <p><?php echo esc_html($tri_sub); ?></p><?php endif; ?>
                    <a href="<?php echo esc_url($tri_link); ?>">Read The Full Story &rarr;</a>
                </div>
            </section>
        <?php endif; ?>
        <?php
        // ============================================================
        // 8. FAQ — genuine FAQs only, capped at 6
        // ============================================================
        $faqs = [];
        for ($i = 1; $i <= 6; $i++) {
            $q = get_field("faq_{$i}_question");
            if ($q)
                $faqs[] = ['q' => $q, 'a' => get_field("faq_{$i}_answer") ?: ''];
        }
        ?>
        <?php if ($faqs): ?>
            <section class="god-faq" id="god-faq">
                <div class="god-faq-inner">
                    <h2>Frequently Asked Questions</h2>
                    <?php foreach ($faqs as $faq): ?>
                        <details>
                            <summary>
                                <span><?php echo esc_html($faq['q']); ?></span>
                                <span aria-hidden="true">+</span>
                            </summary>
                            <?php if ($faq['a']): ?>
                                <p><?php echo wp_kses_post($faq['a']); ?></p><?php endif; ?>
                        </details>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ============================================================
        // 9. PREV / NEXT ORISHA FOOTER STRIP
        // ============================================================
        $prev_god = get_field('cross_nav_prev_god');
        $next_god = get_field('cross_nav_next_god');
        ?>
        <?php if ($prev_god || $next_god): ?>
            <nav class="god-crossnav">
                <?php if ($prev_god):
                    $prev_title = get_field('quick_fact_1_value', $prev_god->ID) ?: $prev_god->post_title;
                    ?>
                    <a href="<?php echo esc_url(get_permalink($prev_god->ID)); ?>" class="god-crossnav-prev">
                        <small>Previous Orisha</small>
                        <strong><?php echo esc_html($prev_god->post_title); ?></strong>
                        <span><?php echo esc_html(get_field('god_tagline', $prev_god->ID)); ?></span>
                    </a>
                <?php else: ?><span></span><?php endif; ?>


                <?php if ($next_god): ?>
                    <a href="<?php echo esc_url(get_permalink($next_god->ID)); ?>" class="god-crossnav-next">
                        <small>Next Orisha</small>
                        <strong><?php echo esc_html($next_god->post_title); ?></strong>
                        <span><?php echo esc_html(get_field('god_tagline', $next_god->ID)); ?></span>
                    </a>
                <?php else: ?><span></span><?php endif; ?>
            </nav>
        <?php endif; ?>

    </div><!-- .single-god -->


    <?php

    wp_enqueue_script('love-story', get_stylesheet_directory_uri() . '/js/love-story.js', [], '2.0', true);
    ?>

<?php endwhile; ?>
<?php get_footer(); ?>