<?php
/**
 * single-god.php — Complete rebuild
 *
 * Structure (drama-first, reference-last):
 *   1.  Hero
 *   2.  Quick Facts Bar
 *   3.  Intro + Pull Quote
 *   4.  Life Journey Timeline
 *   5.  Love Triangle — Full Bleed
 *   6.  Three Teaser Cards
 *   7.  Powers & Symbols
 *   8.  Relationships
 *   9.  Mid-Page Quote Break
 *   10. Worship Today
 *   11. In Culture
 *   12. FAQ  (absorbs: names, background, comparisons, trivia, places)
 *   13. Legacy Quote
 *   14. Cross-God Navigation
 *
 * --god and --god-rgb drive the entire page atmosphere.
 * Both set via inline <style> from the god_color ACF field.
 */

get_header();

while ( have_posts() ) : the_post();

$god_color = get_field('god_color') ?: '#FF6B4A';
$hex       = ltrim( $god_color, '#' );
if ( strlen($hex) === 3 ) $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
$r = hexdec( substr($hex,0,2) );
$g = hexdec( substr($hex,2,2) );
$b = hexdec( substr($hex,4,2) );
?>

<style>
:root {
    --god     : <?php echo esc_attr( $god_color ); ?>;
    --god-rgb : <?php echo "$r, $g, $b"; ?>;
}
</style>

<div class="single-god">

    <?php
    // ============================================================
    // TOP NAV BREADCRUMB
    // ============================================================
    ?>
    <nav class="god-topnav">
        <a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>">
            <span aria-hidden="true">&larr;</span> All Orishas
        </a>
        <span>Orishas / <strong><?php the_title(); ?></strong></span>
    </nav>

    <?php
    // ============================================================
    // 1. HERO
    // ============================================================
    $hero_image  = get_field('hero_image');
    $god_tagline = get_field('god_tagline');
    $hero_eyebrow= get_field('hero_eyebrow') ?: 'Yoruba Mythology &middot; Orisha';
    $hero_voice  = get_field('hero_voice_line');
    $lt_page     = get_page_by_path('love-triangle');
    $lt_url      = $lt_page ? get_permalink($lt_page->ID) : '#';
    ?>
    <section class="god-hero">

        <?php if ( $hero_image ) : ?>
        <div class="god-hero-image" aria-hidden="true">
            <img src="<?php echo esc_url( $hero_image['url'] ); ?>"
                 alt="<?php echo esc_attr( $hero_image['alt'] ); ?>">
        </div>
        <?php endif; ?>

        <div class="god-hero-atmosphere" aria-hidden="true"></div>
        <div class="god-hero-grid"       aria-hidden="true"></div>

        <div class="god-hero-content">
            <span><?php echo wp_kses_post( $hero_eyebrow ); ?></span>
            <h1><?php the_title(); ?></h1>

            <?php if ( $god_tagline ) : ?>
                <p class="god-tagline"><?php echo esc_html( $god_tagline ); ?></p>
            <?php endif; ?>

            <?php if ( $hero_voice ) : ?>
                <blockquote class="god-voice">
                    &ldquo;<?php echo esc_html( $hero_voice ); ?>&rdquo;
                </blockquote>
            <?php endif; ?>

            <div class="god-hero-cta">
                <a href="#god-story"    class="btn-primary">Discover the Story</a>
                <a href="#god-triangle" class="btn-ghost">The Love Triangle</a>
            </div>
        </div>

        <div class="god-hero-scroll" aria-hidden="true"><span></span></div>

    </section>

    <?php
    // ============================================================
    // 2. QUICK FACTS BAR
    // Horizontal strip — replaces the At a Glance grid.
    // Uses quick_facts repeater (up to 6 items).
    // ============================================================
    $quick_facts = [];
    for ( $i = 1; $i <= 6; $i++ ) {
        $label = get_field("quick_fact_{$i}_label");
        $value = get_field("quick_fact_{$i}_value");
        if ( $label && $value ) {
            $quick_facts[] = [
                'label' => $label,
                'value' => $value,
                'icon'  => get_field("quick_fact_{$i}_icon") ?: '',
            ];
        }
    }
    ?>
    <?php if ( $quick_facts ) : ?>
    <div class="god-facts-bar">
        <?php foreach ( $quick_facts as $fact ) : ?>
        <div>
            <?php if ( $fact['icon'] ) : ?>
                <span aria-hidden="true"><?php echo esc_html( $fact['icon'] ); ?></span>
            <?php endif; ?>
            <small><?php echo esc_html( $fact['label'] ); ?></small>
            <strong><?php echo esc_html( $fact['value'] ); ?></strong>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php
    // ============================================================
    // 3. INTRO + PULL QUOTE
    // Split layout — 3 sentences left, dramatic quote right.
    // ============================================================
    $intro_heading = get_field('intro_heading');
    $intro_content = get_field('intro_content');
    $intro_quote   = get_field('intro_quote');
    $intro_quote_attr = get_field('intro_quote_attr');
    ?>
    <?php if ( $intro_heading || $intro_content ) : ?>
    <section class="god-intro" id="god-story">
        <div>
            <?php if ( $intro_heading ) : ?>
                <h2><?php echo wp_kses_post( $intro_heading ); ?></h2>
            <?php endif; ?>
            <?php if ( $intro_content ) : ?>
                <div><?php echo wp_kses_post( $intro_content ); ?></div>
            <?php endif; ?>
        </div>

        <?php if ( $intro_quote ) : ?>
        <div>
            <blockquote>
                &ldquo;<?php echo wp_kses_post( $intro_quote ); ?>&rdquo;
            </blockquote>
            <?php if ( $intro_quote_attr ) : ?>
                <cite>&mdash; <?php echo esc_html( $intro_quote_attr ); ?></cite>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 4. LIFE JOURNEY TIMELINE
    // Horizontal stages — replaces the numbered myths list.
    // Up to 6 stages. Each: icon/image, stage name, one sentence.
    // ============================================================
    $timeline_heading = get_field('timeline_heading');
    $timeline_stages  = [];
    for ( $i = 1; $i <= 6; $i++ ) {
        $stage = get_field("timeline_{$i}_stage");
        if ( $stage ) {
            $timeline_stages[] = [
                'stage' => $stage,
                'desc'  => get_field("timeline_{$i}_desc")  ?: '',
                'icon'  => get_field("timeline_{$i}_icon")  ?: '✦',
                'image' => get_field("timeline_{$i}_image") ?: null,
            ];
        }
    }
    ?>
    <?php if ( $timeline_stages ) : ?>
    <section class="god-timeline">
        <div class="god-timeline-inner">
            <?php if ( $timeline_heading ) : ?>
                <h2><?php echo wp_kses_post( $timeline_heading ); ?></h2>
            <?php endif; ?>
            <div class="god-timeline-track">
                <div class="god-timeline-line" aria-hidden="true"></div>
                <?php foreach ( $timeline_stages as $i => $stage ) : ?>
                <div class="god-timeline-stage">
                    <div class="god-timeline-node">
                        <?php if ( $stage['image'] ) : ?>
                            <img src="<?php echo esc_url( $stage['image']['url'] ); ?>"
                                 alt="<?php echo esc_attr( $stage['stage'] ); ?>">
                        <?php else : ?>
                            <span aria-hidden="true"><?php echo esc_html( $stage['icon'] ); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="god-timeline-content">
                        <strong><?php echo esc_html( $stage['stage'] ); ?></strong>
                        <?php if ( $stage['desc'] ) : ?>
                            <p><?php echo esc_html( $stage['desc'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 5. LOVE TRIANGLE — FULL BLEED
    // Not a card — a cinematic visual moment.
    // Full-width atmospheric image, minimal text, one CTA.
    // ============================================================
    $tri_bg      = get_field('triangle_bg_image');
    $tri_eyebrow = get_field('triangle_eyebrow')     ?: 'The Story In Focus';
    $tri_heading = get_field('triangle_heading');
    $tri_sub     = get_field('triangle_subtitle');
    $tri_link    = get_field('triangle_read_link')   ?: $lt_url;
    $tri_cta     = get_field('triangle_cta_label')   ?: 'Discover the Story';
    ?>
    <?php if ( $tri_heading ) : ?>
    <section class="god-triangle-bleed" id="god-triangle">

        <?php if ( $tri_bg ) : ?>
        <div class="god-triangle-bg" aria-hidden="true">
            <img src="<?php echo esc_url( $tri_bg['url'] ); ?>"
                 alt="">
        </div>
        <?php endif; ?>

        <div class="god-triangle-overlay" aria-hidden="true"></div>

        <div class="god-triangle-content">
            <small><?php echo esc_html( $tri_eyebrow ); ?></small>
            <h2><?php echo wp_kses_post( $tri_heading ); ?></h2>
            <?php if ( $tri_sub ) : ?>
                <p><?php echo esc_html( $tri_sub ); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url( $tri_link ); ?>" class="btn-primary">
                <?php echo esc_html( $tri_cta ); ?>
            </a>
        </div>

    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 6. THREE TEASER CARDS
    // Three configurable content teasers.
    // Fully ACF-driven — any three areas of the god's content.
    // ============================================================
    $teasers = [];
    for ( $i = 1; $i <= 3; $i++ ) {
        $t_heading = get_field("teaser_{$i}_heading");
        if ( $t_heading ) {
            $teasers[] = [
                'heading' => $t_heading,
                'body'    => get_field("teaser_{$i}_body")      ?: '',
                'link'    => get_field("teaser_{$i}_link")      ?: '#',
                'cta'     => get_field("teaser_{$i}_cta_label") ?: 'Explore',
                'icon'    => get_field("teaser_{$i}_icon")      ?: '',
            ];
        }
    }
    ?>
    <?php if ( count($teasers) >= 1 ) : ?>
    <div class="god-teasers">
        <?php foreach ( $teasers as $teaser ) : ?>
        <div>
            <?php if ( $teaser['icon'] ) : ?>
                <span aria-hidden="true"><?php echo esc_html( $teaser['icon'] ); ?></span>
            <?php endif; ?>
            <h3><?php echo esc_html( $teaser['heading'] ); ?></h3>
            <?php if ( $teaser['body'] ) : ?>
                <p><?php echo esc_html( $teaser['body'] ); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url( $teaser['link'] ); ?>">
                <?php echo esc_html( $teaser['cta'] ); ?> &rarr;
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php
    // ============================================================
    // 7. POWERS & SYMBOLS
    // Horizontal icon strip — each item: icon + name + one line.
    // ============================================================
    $symbols_heading = get_field('symbols_heading');
    $symbols = [];
    for ( $i = 1; $i <= 8; $i++ ) {
        $s_title = get_field("symbol_{$i}_title");
        if ( $s_title ) {
            $symbols[] = [
                'title' => $s_title,
                'icon'  => get_field("symbol_{$i}_icon") ?: '',
                'desc'  => get_field("symbol_{$i}_desc") ?: '',
            ];
        }
    }

    $domains_raw = get_field('domains_list');
    $domains = $domains_raw
        ? array_filter( array_map('trim', explode(',', $domains_raw)) )
        : [];
    ?>
    <?php if ( $symbols || $domains ) : ?>
    <section class="god-powers" id="god-powers">
        <div class="god-powers-inner">
            <small><?php echo esc_html( get_field('domains_eyebrow') ?: 'Domains &amp; Powers' ); ?></small>
            <?php if ( $symbols_heading ) : ?>
                <h2><?php echo wp_kses_post( $symbols_heading ); ?></h2>
            <?php endif; ?>

            <?php if ( $domains ) : ?>
            <div class="god-domains">
                <?php foreach ( $domains as $d ) : ?>
                    <span><?php echo esc_html( $d ); ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ( $symbols ) : ?>
            <div class="god-symbols-strip">
                <?php foreach ( $symbols as $sym ) : ?>
                <div>
                    <?php if ( $sym['icon'] ) : ?>
                        <div aria-hidden="true"><?php echo esc_html( $sym['icon'] ); ?></div>
                    <?php endif; ?>
                    <h4><?php echo esc_html( $sym['title'] ); ?></h4>
                    <?php if ( $sym['desc'] ) : ?>
                        <p><?php echo esc_html( $sym['desc'] ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 8. RELATIONSHIPS
    // Portrait cards — name, role, one-line teaser, link to god page.
    // Graceful fallback: emoji icon if no portrait image.
    // ============================================================
    $relations_heading = get_field('relations_heading');
    $relations = [];
    for ( $i = 1; $i <= 6; $i++ ) {
        $r_name = get_field("relation_{$i}_name");
        if ( $r_name ) {
            $r_god_post = get_field("relation_{$i}_god_link");
            $relations[] = [
                'name'   => $r_name,
                'role'   => get_field("relation_{$i}_role")   ?: '',
                'teaser' => get_field("relation_{$i}_teaser") ?: '',
                'image'  => get_field("relation_{$i}_image")  ?: null,
                'icon'   => get_field("relation_{$i}_icon")   ?: '✦',
                'url'    => $r_god_post ? get_permalink($r_god_post->ID) : '#',
            ];
        }
    }
    ?>
    <?php if ( $relations ) : ?>
    <section class="god-relations" id="god-relations">
        <div class="god-relations-inner">
            <small><?php echo esc_html( get_field('relations_eyebrow') ?: 'Relationships' ); ?></small>
            <?php if ( $relations_heading ) : ?>
                <h2><?php echo wp_kses_post( $relations_heading ); ?></h2>
            <?php endif; ?>
            <div class="god-relations-grid">
                <?php foreach ( $relations as $rel ) : ?>
                <a href="<?php echo esc_url( $rel['url'] ); ?>" class="god-relation-card">

                    <div class="god-relation-portrait">
                        <?php if ( $rel['image'] ) : ?>
                            <img src="<?php echo esc_url( $rel['image']['url'] ); ?>"
                                 alt="<?php echo esc_attr( $rel['name'] ); ?>">
                        <?php else : ?>
                            <span aria-hidden="true"><?php echo esc_html( $rel['icon'] ); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="god-relation-body">
                        <strong><?php echo esc_html( $rel['name'] ); ?></strong>
                        <?php if ( $rel['role'] ) : ?>
                            <small><?php echo esc_html( strtoupper($rel['role']) ); ?></small>
                        <?php endif; ?>
                        <?php if ( $rel['teaser'] ) : ?>
                            <p><?php echo esc_html( $rel['teaser'] ); ?></p>
                        <?php endif; ?>
                        <span>Learn More &rarr;</span>
                    </div>

                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 9. MID-PAGE QUOTE BREAK
    // Full bleed — Yoruba proverb or deity quote.
    // Visual breathing room between dense sections.
    // ============================================================
    $midpage_quote      = get_field('midpage_quote');
    $midpage_quote_attr = get_field('midpage_quote_attr');
    ?>
    <?php if ( $midpage_quote ) : ?>
    <div class="god-midquote">
        <div aria-hidden="true"></div>
        <blockquote><?php echo wp_kses_post( $midpage_quote ); ?></blockquote>
        <?php if ( $midpage_quote_attr ) : ?>
            <cite>&mdash; <?php echo esc_html( $midpage_quote_attr ); ?></cite>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php
    // ============================================================
    // 10. WORSHIP TODAY
    // Condensed — location tags, brief text, up to 3 images.
    // ============================================================
    $worship_heading   = get_field('worship_heading');
    $worship_intro     = get_field('worship_intro');
    $worship_locations = get_field('worship_locations');
    $worship_images    = [];
    for ( $i = 1; $i <= 3; $i++ ) {
        $wi = get_field("worship_image_{$i}");
        if ( $wi ) $worship_images[] = $wi;
    }
    $worship_items_exist = false;
    for ( $i = 1; $i <= 8; $i++ ) {
        if ( get_field("worship_{$i}_title") ) { $worship_items_exist = true; break; }
    }
    ?>
    <?php if ( $worship_heading || $worship_intro ) : ?>
    <section class="god-worship" id="god-worship">
        <div class="god-worship-inner">
            <div class="god-worship-text">
                <small><?php echo esc_html( get_field('worship_eyebrow') ?: 'Worship &amp; Rituals' ); ?></small>
                <?php if ( $worship_heading ) : ?>
                    <h2><?php echo wp_kses_post( $worship_heading ); ?></h2>
                <?php endif; ?>
                <?php if ( $worship_intro ) : ?>
                    <div><?php echo wp_kses_post( $worship_intro ); ?></div>
                <?php endif; ?>

                <?php if ( $worship_items_exist ) : ?>
                <div class="god-worship-list">
                    <?php for ( $i = 1; $i <= 8; $i++ ) :
                        $w_title = get_field("worship_{$i}_title");
                        if ( ! $w_title ) continue;
                        $w_icon  = get_field("worship_{$i}_icon") ?: '';
                        $w_desc  = get_field("worship_{$i}_desc") ?: '';
                    ?>
                    <div>
                        <?php if ( $w_icon ) : ?>
                            <span aria-hidden="true"><?php echo esc_html( $w_icon ); ?></span>
                        <?php endif; ?>
                        <div>
                            <strong><?php echo esc_html( $w_title ); ?></strong>
                            <?php if ( $w_desc ) : ?>
                                <p><?php echo esc_html( $w_desc ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>

                <?php if ( $worship_locations ) :
                    $locations = array_filter( array_map('trim', explode(',', $worship_locations)) );
                ?>
                <div class="god-worship-locations">
                    <?php foreach ( $locations as $loc ) : ?>
                        <span>&#128205; <?php echo esc_html( $loc ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( $worship_images ) : ?>
            <div class="god-worship-images">
                <?php foreach ( $worship_images as $wi ) : ?>
                <div>
                    <img src="<?php echo esc_url( $wi['url'] ); ?>"
                         alt="<?php echo esc_attr( $wi['alt'] ); ?>"
                         loading="lazy">
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 11. IN CULTURE
    // Grid of media appearances — film, game, music, art, book.
    // Image cards with type badge.
    // ============================================================
    $culture_heading = get_field('in_culture_heading');
    $culture_items   = [];
    for ( $i = 1; $i <= 8; $i++ ) {
        $c_title = get_field("culture_{$i}_title");
        if ( $c_title ) {
            $culture_items[] = [
                'title'   => $c_title,
                'type'    => get_field("culture_{$i}_type")    ?: '',
                'creator' => get_field("culture_{$i}_creator") ?: '',
                'image'   => get_field("culture_{$i}_image")   ?: null,
                'icon'    => get_field("culture_{$i}_icon")    ?: '✦',
            ];
        }
    }
    ?>
    <?php if ( $culture_items ) : ?>
    <section class="god-culture" id="god-culture">
        <div class="god-culture-inner">
            <small><?php echo esc_html( get_field('in_culture_eyebrow') ?: 'In Culture' ); ?></small>
            <?php if ( $culture_heading ) : ?>
                <h2><?php echo wp_kses_post( $culture_heading ); ?></h2>
            <?php endif; ?>
            <div class="god-culture-grid">
                <?php foreach ( $culture_items as $item ) : ?>
                <div class="god-culture-card">
                    <div class="god-culture-card-media">
                        <?php if ( $item['image'] ) : ?>
                            <img src="<?php echo esc_url( $item['image']['url'] ); ?>"
                                 alt="<?php echo esc_attr( $item['title'] ); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <span aria-hidden="true"><?php echo esc_html( $item['icon'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( $item['type'] ) : ?>
                            <span class="god-culture-badge">
                                <?php echo esc_html( $item['type'] ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="god-culture-card-body">
                        <strong><?php echo esc_html( $item['title'] ); ?></strong>
                        <?php if ( $item['creator'] ) : ?>
                            <small><?php echo esc_html( $item['creator'] ); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 12. FAQ
    // Absorbs: names & titles, background, comparisons, trivia,
    // sacred places, cultural importance — all as Q&A.
    // Up to 12 questions.
    // ============================================================
    $faq_heading = get_field('faq_heading');
    $faqs = [];
    for ( $i = 1; $i <= 12; $i++ ) {
        $q = get_field("faq_{$i}_question");
        if ( $q ) {
            $faqs[] = [
                'q' => $q,
                'a' => get_field("faq_{$i}_answer") ?: '',
            ];
        }
    }
    ?>
    <?php if ( $faqs ) : ?>
    <section class="god-faq" id="god-faq">
        <div class="god-faq-inner">
            <small><?php echo esc_html( get_field('faq_eyebrow') ?: 'Frequently Asked Questions' ); ?></small>
            <?php if ( $faq_heading ) : ?>
                <h2><?php echo wp_kses_post( $faq_heading ); ?></h2>
            <?php endif; ?>
            <div class="god-faq-list">
                <?php foreach ( $faqs as $faq ) : ?>
                <details>
                    <summary>
                        <span><?php echo esc_html( $faq['q'] ); ?></span>
                        <span aria-hidden="true">+</span>
                    </summary>
                    <?php if ( $faq['a'] ) : ?>
                        <div><?php echo wp_kses_post( $faq['a'] ); ?></div>
                    <?php endif; ?>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 13. LEGACY QUOTE — full-bleed cinematic closing moment
    // ============================================================
    $legacy_quote = get_field('legacy_quote');
    $legacy_attr  = get_field('legacy_attribution');
    ?>
    <?php if ( $legacy_quote ) : ?>
    <section class="god-legacy">
        <div aria-hidden="true"></div>
        <blockquote><?php echo wp_kses_post( $legacy_quote ); ?></blockquote>
        <?php if ( $legacy_attr ) : ?>
            <cite><?php echo esc_html( $legacy_attr ); ?></cite>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php
    // ============================================================
    // 14. CROSS-GOD NAVIGATION
    // Deity colour per card via --gc.
    // Relationship teaser tag per card.
    // ============================================================
    $cross_god_1 = get_field('cross_nav_god_1');
    $cross_god_2 = get_field('cross_nav_god_2');
    ?>
    <?php if ( $cross_god_1 || $cross_god_2 ) : ?>
    <section class="god-crossnav">
        <small>Continue the Story</small>
        <h2><?php the_title(); ?>&rsquo;s Story Doesn&rsquo;t End Here</h2>
        <div>
            <?php
            $cross_gods = [
                ['post' => $cross_god_1, 'label' => 'Next Up',           'tag_field' => 'cross_nav_god_1_tag'],
                ['post' => $cross_god_2, 'label' => 'Also In This Story', 'tag_field' => 'cross_nav_god_2_tag'],
            ];
            foreach ( $cross_gods as $cg ) :
                if ( ! $cg['post'] ) continue;
                $cg_color  = get_field('god_color',    $cg['post']->ID) ?: '#f5c842';
                $cg_icon   = get_field('cross_nav_icon', $cg['post']->ID) ?: '✦';
                $cg_tag    = get_field($cg['tag_field']);
                $cg_image  = get_field('hero_image',   $cg['post']->ID);
            ?>
            <a href="<?php echo esc_url( get_permalink($cg['post']->ID) ); ?>"
               style="--gc:<?php echo esc_attr($cg_color); ?>;">

                <div class="god-crossnav-portrait">
                    <?php if ( $cg_image ) : ?>
                        <img src="<?php echo esc_url($cg_image['url']); ?>"
                             alt="<?php echo esc_attr($cg['post']->post_title); ?>"
                             loading="lazy">
                    <?php else : ?>
                        <span aria-hidden="true"><?php echo esc_html($cg_icon); ?></span>
                    <?php endif; ?>
                    <div aria-hidden="true"></div>
                </div>

                <div class="god-crossnav-body">
                    <small><?php echo esc_html($cg['label']); ?></small>
                    <strong><?php echo esc_html($cg['post']->post_title); ?></strong>
                    <?php if ( $cg_tag ) : ?>
                        <p><?php echo esc_html($cg_tag); ?></p>
                    <?php endif; ?>
                    <span aria-hidden="true">&rarr;</span>
                </div>

            </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

</div><!-- .single-god -->

<script>
(function () {
    /* FAQ accordion — native <details> with animated height */
    document.querySelectorAll('.god-faq details').forEach(function (d) {
        d.addEventListener('toggle', function () {
            var plus = d.querySelector('summary span:last-child');
            if (plus) plus.textContent = d.open ? '−' : '+';
        });
    });
})();
</script>

<?php endwhile; ?>
<?php get_footer(); ?>