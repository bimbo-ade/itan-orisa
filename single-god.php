<?php

get_header();
?>

<?php while (have_posts()):
    the_post(); ?>

    <?php

    $god_color = get_field('god_color') ?: '#FF6B4A'; // this god's unique accent (coral default)
    $god_tagline = get_field('god_tagline') ?: '';
    $god_eyebrow = get_field('hero_eyebrow') ?: 'Yoruba Mythology &middot; Orisha';
    $hero_voice = get_field('hero_voice_line'); // optional first-person dramatic quote
    ?>
    <style>
        :root {

            /* The one variable that changes per god post */
            --god:
                <?php echo esc_attr($god_color); ?>
            ;
            --god-light:
                <?php echo esc_attr($god_color); ?>
            ;
        }
    </style>

    <div class="single-god">

        <?php
        // ------------------------------------------------------------
// TOP NAV — always shown on every god page.
// "All Orishas" returns to the archive/list page for this CPT.
// Breadcrumb shows the current god's name on the right.
// ------------------------------------------------------------
        ?>
        <nav class="god-topnav">
            <a href="<?php echo esc_url(get_post_type_archive_link(get_post_type())); ?>" class="topnav-back">
                <span class="arrow">&larr;</span> All Orishas
            </a>
            <div class="topnav-crumb">Orishas / <span><?php the_title(); ?></span></div>
        </nav>

        <?php
        // ------------------------------------------------------------
// HERO — always shown. Title + Featured Image + 3 optional
// ACF fields (tagline, eyebrow, first-person voice line).
// ------------------------------------------------------------
        ?>
        <section class="god-hero">
            <div class="god-hero-bg">
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('full'); ?>
                <?php endif; ?>
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-aura"></div>
            <div class="hero-aura-outer"></div>

            <div class="god-hero-content">
                <span class="sg-eyebrow sg-eyebrow--gold"><?php echo wp_kses_post($god_eyebrow); ?></span>
                <h1><?php the_title(); ?></h1>

                <?php if ($god_tagline): ?>
                    <p class="god-tagline"><?php echo esc_html($god_tagline); ?></p>
                <?php endif; ?>

                <?php if ($hero_voice): ?>
                    <p class="hero-voice">&ldquo;<?php echo esc_html($hero_voice); ?>&rdquo;</p>
                <?php endif; ?>

                <div class="hero-cta-row">
                    <a href="#triangle" class="btn-primary">The Love Triangle</a>
                    <a href="#story" class="btn-ghost">Read Story </a>
                </div>
            </div>

           
        </section>

        <?php
        // ------------------------------------------------------------
// SECTION: QUICK OVERVIEW / AT A GLANCE
// Trigger: at least one fact filled in. Each card is independent —
// only renders if its own field has a value.
// ------------------------------------------------------------
        $fact_fields = [
            'Name' => get_field('fact_name') ?: get_the_title(),
            'Type' => get_field('fact_type') ?: 'Orisha (Deity)',
            'Culture' => get_field('fact_culture') ?: 'Yoruba',
            'Domain' => get_field('fact_domain'),
            'Symbol' => get_field('fact_symbol'),
            'Sacred Colours' => get_field('fact_colors'),
            'Sacred Number' => get_field('fact_number'),
            'Associated Animal' => get_field('fact_animal'),
            'Status' => get_field('fact_status'),
        ];
        $facts_filled = array_filter($fact_fields);
        ?>
        <?php if (!empty($facts_filled)): ?>
            <section class="god-glance">
                <div style="text-align:center; margin-bottom:2rem;">
                    <!-- <span class="sg-eyebrow" style="text-align:center;">Quick Overview</span> -->
                    <h2 class="sg-title" >At a Glance</h2>
                </div>
                <div class="facts-grid">
                    <?php foreach ($facts_filled as $label => $value): ?>
                        <div class="fact-card">
                            <span class="fact-label"><?php echo esc_html($label); ?></span>
                            <span class="fact-value"><?php echo esc_html($value); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: NAMES & TITLES
// Two text areas (one name per line) — Alternative Spellings
// and Honorific Titles — rendered as two side-by-side lists.
// Trigger: titles_heading
// ------------------------------------------------------------
        $titles_heading = get_field('titles_heading');
        ?>
        <?php if ($titles_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span class="sg-eyebrow"><?php echo esc_html(get_field('titles_eyebrow') ?: 'Names &amp; Titles'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($titles_heading); ?></h2>
                    <?php $pronunciation = get_field('titles_pronunciation'); ?>
                    <?php if ($pronunciation): ?>
                        <span class="pronunciation-tag">Pronounced: <?php echo esc_html($pronunciation); ?></span>
                    <?php endif; ?>
                </div>
                <div class="titles-grid">

                    <?php
                    // Alternative spellings — one per line in a Textarea
                    $spellings_raw = get_field('titles_alt_spellings');
                    if ($spellings_raw):
                        $spellings = array_filter(array_map('trim', explode("\n", $spellings_raw)));
                        ?>
                        <div class="titles-block">
                            <h4>Alternative Spellings</h4>
                            <div class="titles-list">
                                <?php foreach ($spellings as $s): ?>
                                    <span class="title-pill"><span class="glyph">&middot;</span><?php echo esc_html($s); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Honorific titles — one per line in a Textarea
                    $honorifics_raw = get_field('titles_honorifics');
                    if ($honorifics_raw):
                        $honorifics = array_filter(array_map('trim', explode("\n", $honorifics_raw)));
                        ?>
                        <div class="titles-block">
                            <h4>Honorific Titles</h4>
                            <div class="titles-list">
                                <?php foreach ($honorifics as $h): ?>
                                    <span class="title-pill"><span class="glyph">&middot;</span><?php echo esc_html($h); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: WHO IS [GOD]? — main intro/identity prose
// Trigger: intro_heading
// ------------------------------------------------------------
        $intro_heading = get_field('intro_heading');
        ?>
        <?php if ($intro_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('intro_eyebrow') ?: 'Who Is ' . get_the_title() . '?'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($intro_heading); ?></h2>
                </div>
                <?php $intro_content = get_field('intro_content'); ?>
                <?php if ($intro_content): ?>
                    <div class="sg-prose"><?php echo wp_kses_post($intro_content); ?></div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: ETHNIC & RELIGIOUS BACKGROUND
// Tag-style rows for ethnic group, tradition, regions, and
// diaspora traditions. Each row is its own comma-separated
// text field; empty rows are skipped.
// Trigger: background_heading
// ------------------------------------------------------------
        $background_heading = get_field('background_heading');
        ?>
        <?php if ($background_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('background_eyebrow') ?: 'Ethnic &amp; Religious Background'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($background_heading); ?></h2>
                </div>

                <?php
                // Each of these is "Label" => comma-separated ACF text field.
                // We loop through so empty rows simply don't print.
                $background_rows = [
                    'Ethnic Group' => get_field('background_ethnic_group'),
                    'Traditional Religion' => get_field('background_religion'),
                    'Regions of Worship' => get_field('background_regions'),
                    'Diaspora Traditions' => get_field('background_diaspora_traditions'),
                ];
                foreach ($background_rows as $label => $raw):
                    if (!$raw)
                        continue;
                    $items = array_filter(array_map('trim', explode(',', $raw)));
                    ?>
                    <div style="margin-bottom:1.75rem;">
                        <h4
                            style="font-size:0.7rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--ivory-dim); margin-bottom:0.5rem;">
                            <?php echo esc_html($label); ?>
                        </h4>
                        <div class="tag-row" style="margin-top:0.5rem;">
                            <?php foreach ($items as $item): ?>
                                <span class="tag-pill"><?php echo esc_html($item); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: DOMAINS & POWERS
// Two parts: a tag cloud of domain words, and an icon grid of
// what people traditionally prayed for.
// Trigger: domains_heading
// ------------------------------------------------------------
        $domains_heading = get_field('domains_heading');
        ?>
        <?php if ($domains_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('domains_eyebrow') ?: 'Domains &amp; Powers'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($domains_heading); ?></h2>
                    <?php $domains_intro = get_field('domains_intro'); ?>
                    <?php if ($domains_intro): ?>
                        <p><?php echo esc_html($domains_intro); ?></p><?php endif; ?>
                </div>

                <?php
                // Domain words — one comma-separated field, rendered as tag pills
                $domains_raw = get_field('domains_list');
                if ($domains_raw):
                    $domains = array_filter(array_map('trim', explode(',', $domains_raw)));
                    ?>
                    <div class="tag-row">
                        <?php foreach ($domains as $d): ?>
                            <span class="tag-pill"><?php echo esc_html($d); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php
                // "People prayed for..." — up to 6 slots, icon + title
                $prayer_items_exist = false;
                for ($i = 1; $i <= 6; $i++) {
                    if (get_field("domains_prayer_{$i}_title")) {
                        $prayer_items_exist = true;
                        break;
                    }
                }
                ?>
                <?php if ($prayer_items_exist): ?>
                    <h4
                        style="font-size:0.7rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--ivory-dim); margin:2.5rem 0 0.5rem;">
                        People Traditionally Prayed For
                    </h4>
                    <div class="icon-grid icon-grid--3">
                        <?php for ($i = 1; $i <= 6; $i++):
                            $pr_title = get_field("domains_prayer_{$i}_title");
                            if (!$pr_title)
                                continue;
                            $pr_icon = get_field("domains_prayer_{$i}_icon");
                            ?>
                            <div class="icon-card">
                                <?php if ($pr_icon): ?><span class="icon-pip"><?php echo esc_html($pr_icon); ?></span><?php endif; ?>
                                <h3><?php echo esc_html($pr_title); ?></h3>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: HISTORICAL ORIGINS (two-column, text + image/symbol)
// Trigger: history_heading
// Right column priority: Image → Symbol Emoji → placeholder
// ------------------------------------------------------------
        $history_heading = get_field('history_heading');
        ?>
        <?php if ($history_heading): ?>
            <section class="section-pad section-pad--alt" id="story">
                <div class="two-col">
                    <div>
                        <span
                            class="sg-eyebrow"><?php echo esc_html(get_field('history_eyebrow') ?: 'Historical Origins'); ?></span>
                        <h2 class="sg-title"><?php echo wp_kses_post($history_heading); ?></h2>

                        <?php $history_content = get_field('history_content'); ?>
                        <?php if ($history_content): ?>
                            <div class="sg-prose"><?php echo wp_kses_post($history_content); ?></div>
                        <?php endif; ?>

                        <?php $quote = get_field('history_quote'); ?>
                        <?php if ($quote): ?>
                            <div class="quote-block">
                                <p><?php echo esc_html($quote); ?></p>
                                <?php $quote_source = get_field('history_quote_source'); ?>
                                <?php if ($quote_source): ?>
                                    <p class="quote-source"><?php echo esc_html($quote_source); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php
                        $history_image = get_field('history_image');
                        $symbol_emoji = get_field('history_symbol_emoji');
                        $symbol_label = get_field('history_symbol_label');
                        ?>
                        <?php if ($history_image): ?>
                            <img src="<?php echo esc_url($history_image['url']); ?>"
                                alt="<?php echo esc_attr($history_image['alt']); ?>"
                                style="width:100%; border-radius:0.4rem; opacity:0.9;">
                        <?php elseif ($symbol_emoji): ?>
                            <div class="symbol-block">
                                <div class="symbol-circle">
                                    <span><?php echo esc_html($symbol_emoji); ?></span>
                                    <div class="symbol-ring"></div>
                                    <div class="symbol-ring-outer"></div>
                                </div>
                                <?php if ($symbol_label): ?>
                                    <p class="symbol-label"><?php echo esc_html($symbol_label); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="history-placeholder">
                                <span style="font-size:3rem;">🏛️</span>
                                <p
                                    style="font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase; color:var(--ivory-dim);">
                                    Image coming soon</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: ORIGIN STORY & MAJOR MYTHS
// A numbered list of myths — each with a title and body text.
// Trigger: myths_heading
// ------------------------------------------------------------
        $myths_heading = get_field('myths_heading');
        ?>
        <?php if ($myths_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('myths_eyebrow') ?: 'Origin Story &amp; Major Myths'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($myths_heading); ?></h2>
                </div>
                <div class="numbered-list">
                    <?php
                    $myth_count = 0;
                    for ($i = 1; $i <= 6; $i++):
                        $m_title = get_field("myth_{$i}_title");
                        if (!$m_title)
                            continue;
                        $myth_count++;
                        $m_desc = get_field("myth_{$i}_desc");
                        ?>
                        <div class="numbered-item">
                            <span class="num"><?php echo str_pad($myth_count, 2, '0', STR_PAD_LEFT); ?></span>
                            <div>
                                <h4><?php echo esc_html($m_title); ?></h4>
                                <?php if ($m_desc): ?>
                                    <p><?php echo wp_kses_post($m_desc); ?></p><?php endif; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: FAMILY & RELATIONSHIPS
// Father/lineage as plain text, then a card grid for spouses/
// family members — generic enough for "wives" or any relation.
// Trigger: family_heading
// ------------------------------------------------------------
        $family_heading = get_field('family_heading');
        ?>
        <?php if ($family_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('family_eyebrow') ?: 'Family &amp; Relationships'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($family_heading); ?></h2>
                </div>

                <?php $lineage = get_field('family_lineage'); ?>
                <?php if ($lineage): ?>
                    <div class="sg-prose" style="margin-bottom:2rem;"><?php echo wp_kses_post($lineage); ?></div>
                <?php endif; ?>

                <?php $fam_cols = get_field('family_columns') ?: '3'; ?>
                <div class="card-grid card-grid--<?php echo esc_attr($fam_cols); ?>">
                    <?php
                    for ($i = 1; $i <= 6; $i++):
                        $f_name = get_field("family_{$i}_name");
                        if (!$f_name)
                            continue;
                        $f_role = get_field("family_{$i}_role"); // e.g. "Goddess of storms and winds"
                        $f_desc = get_field("family_{$i}_desc");
                        $f_icon = get_field("family_{$i}_icon");
                        ?>
                        <div class="bordered-card">
                            <?php if ($f_icon): ?><span class="card-icon"><?php echo esc_html($f_icon); ?></span><?php endif; ?>
                            <h3><?php echo esc_html($f_name); ?></h3>
                            <?php if ($f_role): ?><span class="card-badge"><?php echo esc_html($f_role); ?></span><?php endif; ?>
                            <?php if ($f_desc): ?>
                                <p><?php echo esc_html($f_desc); ?></p><?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: PERSONALITY & CHARACTERISTICS
// Strengths / weaknesses (one per line) + an optional
// "reputation" paragraph underneath.
// Trigger: personality_heading
// ------------------------------------------------------------
        $personality_heading = get_field('personality_heading');
        ?>
        <?php if ($personality_heading): ?>
            <section class="section-pad">
                <span
                    class="sg-eyebrow"><?php echo esc_html(get_field('personality_eyebrow') ?: 'Personality &amp; Characteristics'); ?></span>
                <h2 class="sg-title"><?php echo wp_kses_post($personality_heading); ?></h2>

                <div class="personality-grid">
                    <?php
                    $strengths_raw = get_field('personality_strengths');
                    if ($strengths_raw):
                        $strengths = array_filter(array_map('trim', explode("\n", $strengths_raw)));
                        ?>
                        <div class="personality-col strengths">
                            <h3>Strengths</h3>
                            <ul><?php foreach ($strengths as $s): ?>
                                    <li><?php echo esc_html($s); ?></li><?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php
                    $weaknesses_raw = get_field('personality_weaknesses');
                    if ($weaknesses_raw):
                        $weaknesses = array_filter(array_map('trim', explode("\n", $weaknesses_raw)));
                        ?>
                        <div class="personality-col weaknesses">
                            <h3>Weaknesses</h3>
                            <ul><?php foreach ($weaknesses as $w): ?>
                                    <li><?php echo esc_html($w); ?></li><?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <?php $reputation = get_field('personality_reputation'); ?>
                <?php if ($reputation): ?>
                    <div class="sg-prose" style="margin-top:2.5rem;"><?php echo wp_kses_post($reputation); ?></div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: SYMBOLS & SACRED OBJECTS
// Icon grid — each symbol gets its own card. Generic enough for
// any number/type of sacred object per god.
// Trigger: symbols_heading
// ------------------------------------------------------------
        $symbols_heading = get_field('symbols_heading');
        ?>
        <?php if ($symbols_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('symbols_eyebrow') ?: 'Symbols &amp; Sacred Objects'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($symbols_heading); ?></h2>
                </div>
                <?php $sym_cols = get_field('symbols_columns') ?: '4'; ?>
                <div class="icon-grid icon-grid--<?php echo esc_attr($sym_cols); ?>">
                    <?php for ($i = 1; $i <= 8; $i++):
                        $s_title = get_field("symbol_{$i}_title");
                        if (!$s_title)
                            continue;
                        $s_icon = get_field("symbol_{$i}_icon");
                        $s_desc = get_field("symbol_{$i}_desc");
                        ?>
                        <div class="icon-card icon-card--surface">
                            <?php if ($s_icon): ?><span class="icon-pip"><?php echo esc_html($s_icon); ?></span><?php endif; ?>
                            <h3><?php echo esc_html($s_title); ?></h3>
                            <?php if ($s_desc): ?>
                                <p><?php echo esc_html($s_desc); ?></p><?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: WORSHIP & RITUALS
// Intro paragraph + numbered list of practices (offerings,
// music, followers etc all fit as generic numbered items).
// Trigger: worship_heading
// ------------------------------------------------------------
        $worship_heading = get_field('worship_heading');
        ?>
        <?php if ($worship_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('worship_eyebrow') ?: 'Worship &amp; Rituals'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($worship_heading); ?></h2>
                    <?php $worship_intro = get_field('worship_intro'); ?>
                    <?php if ($worship_intro): ?>
                        <div class="sg-prose"><?php echo wp_kses_post($worship_intro); ?></div><?php endif; ?>
                </div>
                <div class="numbered-list">
                    <?php
                    $w_count = 0;
                    for ($i = 1; $i <= 8; $i++):
                        $w_title = get_field("worship_{$i}_title");
                        if (!$w_title)
                            continue;
                        $w_count++;
                        $w_desc = get_field("worship_{$i}_desc");
                        ?>
                        <div class="numbered-item">
                            <span class="num"><?php echo str_pad($w_count, 2, '0', STR_PAD_LEFT); ?></span>
                            <div>
                                <h4><?php echo esc_html($w_title); ?></h4>
                                <?php if ($w_desc): ?>
                                    <p><?php echo esc_html($w_desc); ?></p><?php endif; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: FESTIVALS & CELEBRATIONS
// Festival name/location + tag list of activities.
// Trigger: festival_heading
// ------------------------------------------------------------
        $festival_heading = get_field('festival_heading');
        ?>
        <?php if ($festival_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('festival_eyebrow') ?: 'Festivals &amp; Celebrations'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($festival_heading); ?></h2>
                </div>
                <?php $festival_content = get_field('festival_content'); ?>
                <?php if ($festival_content): ?>
                    <div class="sg-prose"><?php echo wp_kses_post($festival_content); ?></div>
                <?php endif; ?>

                <?php $activities_raw = get_field('festival_activities'); ?>
                <?php if ($activities_raw):
                    $activities = array_filter(array_map('trim', explode(',', $activities_raw)));
                    ?>
                    <div class="tag-row">
                        <?php foreach ($activities as $a): ?>
                            <span class="tag-pill"><?php echo esc_html($a); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: SACRED PLACES & SHRINES
// Card grid — one card per named place.
// Trigger: places_heading
// ------------------------------------------------------------
        $places_heading = get_field('places_heading');
        ?>
        <?php if ($places_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('places_eyebrow') ?: 'Sacred Places &amp; Shrines'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($places_heading); ?></h2>
                </div>
                <?php $places_cols = get_field('places_columns') ?: '3'; ?>
                <div class="card-grid card-grid--<?php echo esc_attr($places_cols); ?>">
                    <?php for ($i = 1; $i <= 6; $i++):
                        $p_name = get_field("place_{$i}_name");
                        if (!$p_name)
                            continue;
                        $p_desc = get_field("place_{$i}_desc");
                        $p_icon = get_field("place_{$i}_icon");
                        ?>
                        <div class="bordered-card">
                            <?php if ($p_icon): ?><span class="card-icon"><?php echo esc_html($p_icon); ?></span><?php endif; ?>
                            <h3><?php echo esc_html($p_name); ?></h3>
                            <?php if ($p_desc): ?>
                                <p><?php echo esc_html($p_desc); ?></p><?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: CULTURAL IMPORTANCE
// Simple prose + tag list of influenced areas.
// Trigger: culture_heading
// ------------------------------------------------------------
        $culture_heading = get_field('culture_heading');
        ?>
        <?php if ($culture_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('culture_eyebrow') ?: 'Cultural Importance'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($culture_heading); ?></h2>
                </div>
                <?php $culture_content = get_field('culture_content'); ?>
                <?php if ($culture_content): ?>
                    <div class="sg-prose"><?php echo wp_kses_post($culture_content); ?></div>
                <?php endif; ?>
                <?php $culture_areas_raw = get_field('culture_areas'); ?>
                <?php if ($culture_areas_raw):
                    $culture_areas = array_filter(array_map('trim', explode(',', $culture_areas_raw)));
                    ?>
                    <div class="tag-row">
                        <?php foreach ($culture_areas as $area): ?>
                            <span class="tag-pill"><?php echo esc_html($area); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: MODERN INFLUENCE
// Small compact icon grid — icon + label only, no description.
// Trigger: modern_heading
// ------------------------------------------------------------
        $modern_heading = get_field('modern_heading');
        ?>
        <?php if ($modern_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span class="sg-eyebrow"><?php echo esc_html(get_field('modern_eyebrow') ?: 'Modern Influence'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($modern_heading); ?></h2>
                </div>
                <?php $mod_cols = get_field('modern_columns') ?: '6'; ?>
                <div class="icon-grid icon-grid--<?php echo esc_attr($mod_cols); ?>">
                    <?php for ($i = 1; $i <= 8; $i++):
                        $m_title = get_field("modern_{$i}_title");
                        if (!$m_title)
                            continue;
                        $m_icon = get_field("modern_{$i}_icon");
                        ?>
                        <div class="icon-card icon-card--surface"
                            style="align-items:center; text-align:center; padding:1.75rem 1rem;">
                            <?php if ($m_icon): ?><span
                                    style="font-size:1.75rem;"><?php echo esc_html($m_icon); ?></span><?php endif; ?>
                            <h3
                                style="font-family:'DM Sans',sans-serif; font-size:0.72rem; letter-spacing:0.12em; text-transform:uppercase; font-weight:400; color:var(--ivory-dim);">
                                <?php echo esc_html($m_title); ?>
                            </h3>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: [GOD] IN THE AFRICAN DIASPORA
// Card grid — one card per region, with a badge for the local name.
// Trigger: diaspora_heading
// ------------------------------------------------------------
        $diaspora_heading = get_field('diaspora_heading');
        ?>
        <?php if ($diaspora_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('diaspora_eyebrow') ?: 'In the African Diaspora'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($diaspora_heading); ?></h2>
                    <?php $diaspora_intro = get_field('diaspora_intro'); ?>
                    <?php if ($diaspora_intro): ?>
                        <p><?php echo esc_html($diaspora_intro); ?></p><?php endif; ?>
                </div>
                <?php $d_cols = get_field('diaspora_columns') ?: '3'; ?>
                <div class="card-grid card-grid--<?php echo esc_attr($d_cols); ?>">
                    <?php for ($i = 1; $i <= 6; $i++):
                        $d_region = get_field("diaspora_{$i}_region");
                        if (!$d_region)
                            continue;
                        $d_icon = get_field("diaspora_{$i}_icon");
                        $d_name = get_field("diaspora_{$i}_local_name");
                        $d_desc = get_field("diaspora_{$i}_desc");
                        ?>
                        <div class="bordered-card bordered-card--surface">
                            <?php if ($d_icon): ?><span class="card-icon"><?php echo esc_html($d_icon); ?></span><?php endif; ?>
                            <h3><?php echo esc_html($d_region); ?></h3>
                            <?php if ($d_desc): ?>
                                <p><?php echo esc_html($d_desc); ?></p><?php endif; ?>
                            <?php if ($d_name): ?><span class="card-badge">Known as
                                    <?php echo esc_html($d_name); ?></span><?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: COMPARISONS WITH OTHER MYTHOLOGIES
// A simple two-column comparison table + a cultural-sensitivity
// note underneath. Up to 6 comparison rows.
// Trigger: compare_heading
// ------------------------------------------------------------
        $compare_heading = get_field('compare_heading');
        ?>
        <?php if ($compare_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('compare_eyebrow') ?: 'Comparisons With Other Mythologies'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($compare_heading); ?></h2>
                </div>

                <table class="compare-table">
                    <thead>
                        <tr>
                            <th><?php echo esc_html(get_the_title()); ?></th>
                            <th>Other Mythology</th>
                            <th>Shared Theme</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= 6; $i++):
                            $c_other = get_field("compare_{$i}_figure");
                            if (!$c_other)
                                continue;
                            $c_origin = get_field("compare_{$i}_origin"); // e.g. "Greek", "Norse"
                            $c_theme = get_field("compare_{$i}_theme");
                            ?>
                            <tr>
                                <td><?php the_title(); ?></td>
                                <td><?php echo esc_html($c_other); ?><?php if ($c_origin): ?>
                                        (<?php echo esc_html($c_origin); ?>)<?php endif; ?></td>
                                <td><?php echo esc_html($c_theme); ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>

                <?php $compare_note = get_field('compare_note'); ?>
                <?php if ($compare_note): ?>
                    <p class="compare-note"><?php echo esc_html($compare_note); ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: INTERESTING FACTS
// Reuses the trivia-list style. One fact per slot, up to 8.
// Trigger: trivia_heading
// ------------------------------------------------------------
        $trivia_heading = get_field('trivia_heading');
        ?>
        <?php if ($trivia_heading): ?>
            <section class="section-pad section-pad--alt">
                <div class="section-header">
                    <span class="sg-eyebrow"><?php echo esc_html(get_field('trivia_eyebrow') ?: 'Interesting Facts'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($trivia_heading); ?></h2>
                </div>
                <div class="trivia-list">
                    <?php for ($i = 1; $i <= 8; $i++):
                        $fact = get_field("trivia_{$i}");
                        if (!$fact)
                            continue;
                        ?>
                        <div class="trivia-item">
                            <span class="trivia-bolt">&#9670;</span>
                            <p><?php echo wp_kses_post($fact); ?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: FREQUENTLY ASKED QUESTIONS
// Static FAQ list (question + answer), up to 8 pairs.
// Trigger: faq_heading
// ------------------------------------------------------------
        $faq_heading = get_field('faq_heading');
        ?>
        <?php if ($faq_heading): ?>
            <section class="section-pad">
                <div class="section-header">
                    <span
                        class="sg-eyebrow"><?php echo esc_html(get_field('faq_eyebrow') ?: 'Frequently Asked Questions'); ?></span>
                    <h2 class="sg-title"><?php echo wp_kses_post($faq_heading); ?></h2>
                </div>
                <div class="faq-list">
                    <?php for ($i = 1; $i <= 8; $i++):
                        $q = get_field("faq_{$i}_question");
                        if (!$q)
                            continue;
                        $a = get_field("faq_{$i}_answer");
                        ?>
                        <div class="faq-item">
                            <p class="faq-q"><span class="q-mark">Q.</span><?php echo esc_html($q); ?></p>
                            <?php if ($a): ?>
                                <p class="faq-a"><?php echo wp_kses_post($a); ?></p><?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: LOVE TRIANGLE FEATURE CARD
// The single connected story this site is built around.
// Cast pills are dynamic — add as many gods to a story as
// needed via the repeater, not hard-coded to 3 names.
// Trigger: triangle_heading
// ------------------------------------------------------------
        $triangle_heading = get_field('triangle_heading');
        ?>
        <?php if ($triangle_heading): ?>
            <section class="triangle-section" id="triangle">
                <div class="triangle-header">
                    <span class="sg-eyebrow" style="color:var(--gold-light);">
                        <?php echo esc_html(get_field('triangle_eyebrow') ?: 'The Story In Focus'); ?>
                    </span>
                    <h2 class="sg-title"><?php echo wp_kses_post($triangle_heading); ?></h2>
                    <?php $triangle_intro = get_field('triangle_intro'); ?>
                    <?php if ($triangle_intro): ?>
                        <p><?php echo esc_html($triangle_intro); ?></p><?php endif; ?>
                </div>

                <div class="triangle-card">
                    <div class="triangle-band"></div>
                    <div class="triangle-body">
                        <?php $tri_tag = get_field('triangle_tag'); ?>
                        <?php if ($tri_tag): ?>
                            <p class="triangle-tag"><?php echo esc_html($tri_tag); ?></p><?php endif; ?>

                        <?php $tri_title = get_field('triangle_story_title'); ?>
                        <?php if ($tri_title): ?>
                            <h3 class="triangle-title"><?php echo esc_html($tri_title); ?></h3><?php endif; ?>

                        <?php $tri_excerpt = get_field('triangle_excerpt'); ?>
                        <?php if ($tri_excerpt): ?>
                            <p class="triangle-excerpt"><?php echo esc_html($tri_excerpt); ?></p><?php endif; ?>

                        <?php
                        // Cast list — an ACF Repeater so ANY number of gods can be
                        // tagged into a story, not limited to a fixed 3 checkboxes.
                        $cast = get_field('triangle_cast');
                        ?>
                        <?php if ($cast): ?>
                            <div class="triangle-cast">
                                <?php foreach ($cast as $member):
                                    $cast_name = $member['cast_name'] ?? '';
                                    $cast_color = $member['cast_color'] ?? '#FF6B4A';
                                    if (!$cast_name)
                                        continue;
                                    ?>
                                    <span class="triangle-pill" style="color:<?php echo esc_attr($cast_color); ?>;">
                                        <span class="dot"></span><?php echo esc_html($cast_name); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="triangle-footer">
                            <span class="triangle-meta">
                                <?php echo esc_html(get_field('triangle_meta_label') ?: 'Part of the Ìtàn Òrìṣà story series'); ?>
                            </span>
                            <?php $triangle_link = get_field('triangle_read_link'); ?>
                            <a href="<?php echo $triangle_link ? esc_url($triangle_link) : '#'; ?>" class="btn-gold">
                                Read the Full Story
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: LEGACY / CLOSING QUOTE
// Trigger: legacy_quote
// ------------------------------------------------------------
        $legacy_quote = get_field('legacy_quote');
        ?>
        <?php if ($legacy_quote): ?>
            <section class="god-legacy">
                <blockquote><?php echo wp_kses_post($legacy_quote); ?></blockquote>
                <?php $legacy_attr = get_field('legacy_attribution'); ?>
                <?php if ($legacy_attr): ?>
                    <p class="legacy-attr"><?php echo esc_html($legacy_attr); ?></p><?php endif; ?>
            </section>
        <?php endif; ?>

        <?php
        // ------------------------------------------------------------
// SECTION: CROSS-GOD NAVIGATION FOOTER
// Links to up to two OTHER gods using Post Object fields, so it
// works correctly regardless of which 3 (or more) gods are
// connected to THIS post's story.
// ------------------------------------------------------------
        $cross_god_1 = get_field('cross_nav_god_1');
        $cross_god_2 = get_field('cross_nav_god_2');
        ?>
        <?php if ($cross_god_1 || $cross_god_2): ?>
            <section class="cross-nav">
                <div class="cross-nav-label">
                    <span class="sg-eyebrow" style="text-align:center; color:var(--gold-light);">Continue the Story</span>
                    <h2 class="sg-title" style="font-size:1.5rem; margin-bottom:0;">
                        <?php the_title(); ?>'s Story Doesn't End Here
                    </h2>
                </div>
                <div class="cross-nav-grid">
                    <?php if ($cross_god_1):
                        $g1_icon = get_field('cross_nav_icon', $cross_god_1->ID) ?: '✨';
                        $g1_tag = get_field('cross_nav_god_1_tag');
                        ?>
                        <a href="<?php echo esc_url(get_permalink($cross_god_1->ID)); ?>" class="cross-nav-card">
                            <div class="ring"><?php echo esc_html($g1_icon); ?></div>
                            <div>
                                <p class="cross-nav-card-label">Next Up</p>
                                <p class="cross-nav-card-name"><?php echo esc_html($cross_god_1->post_title); ?></p>
                                <?php if ($g1_tag): ?>
                                    <p class="cross-nav-card-tag"><?php echo esc_html($g1_tag); ?></p><?php endif; ?>
                            </div>
                            <span class="cross-nav-card-arrow">&rarr;</span>
                        </a>
                    <?php endif; ?>

                    <?php if ($cross_god_2):
                        $g2_icon = get_field('cross_nav_icon', $cross_god_2->ID) ?: '✨';
                        $g2_tag = get_field('cross_nav_god_2_tag');
                        ?>
                        <a href="<?php echo esc_url(get_permalink($cross_god_2->ID)); ?>" class="cross-nav-card">
                            <div class="ring"><?php echo esc_html($g2_icon); ?></div>
                            <div>
                                <p class="cross-nav-card-label">Also In This Story</p>
                                <p class="cross-nav-card-name"><?php echo esc_html($cross_god_2->post_title); ?></p>
                                <?php if ($g2_tag): ?>
                                    <p class="cross-nav-card-tag"><?php echo esc_html($g2_tag); ?></p><?php endif; ?>
                            </div>
                            <span class="cross-nav-card-arrow">&rarr;</span>
                        </a>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

    </div><!-- .single-god -->

<?php endwhile; ?>

<?php get_footer(); ?>