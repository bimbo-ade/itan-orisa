<?php
/**
 * single-story-love-triangle.php
 *

 */

get_header();




/*
|--------------------------------------------------------------------------
| ACF CONTENT
|--------------------------------------------------------------------------
*/

$hero_image = get_field('love_hero_image');
$hero_heading = get_field('love_hero_heading') ?: 'She Left The Smith For The Storm';
$hero_intro = get_field('love_hero_intro');

$intro_heading = get_field('love_intro_heading');
$intro_text = get_field('love_intro_text');
$disclaimer_text = get_field('love_disclaimer_text');
$beyond_heading = get_field('love_beyond_heading') ?: 'So Who Really Lost?';
$beyond_text = get_field('love_beyond_text');
$beat_1 = get_field('love_beat_1_text') ?: "Did she really leave the Smith for the Storm?";
$beat_2 = get_field('love_beat_2_text') ?: "In the end, she simply walked away, and the wind went with her...";

$stories_archive = get_post_type_archive_link('story') ?: '#';

$cast_fields = [
    ['post' => 'love_cast_1_god', 'role' => 'love_cast_1_role', 'class' => 'ogun'],
    ['post' => 'love_cast_2_god', 'role' => 'love_cast_2_role', 'class' => 'oya'],
    ['post' => 'love_cast_3_god', 'role' => 'love_cast_3_role', 'class' => 'sango'],
];
$cast = [];
foreach ($cast_fields as $cf) {
    $god_post = get_field($cf['post']);
    if ($god_post) {
        $cast[] = [
            'post' => $god_post,
            'role' => get_field($cf['role']) ?: '',
            'class' => $cf['class'],
        ];
    }
}

$chapters = [];
for ($i = 1; $i <= 7; $i++) {
    $heading = get_field("love_chapter_{$i}_heading");
    $text = get_field("love_chapter_{$i}_text");
    if ($heading || $text) {
        $chapters[] = [
            'number' => sprintf('%02d', $i),
            'heading' => $heading,
            'text' => $text,
        ];
    }
}

$chapter_god_map = ['ogun', 'sango', 'oya', 'ogun', 'sango', 'oya', 'sango'];
?>

<div class="love-story">

    <?php if ($chapters): ?>
        <nav class="love-chapter-rail" aria-label="Chapter progress">
            <?php foreach ($chapters as $chapter): ?>
                <a href="#chapter-<?php echo esc_attr($chapter['number']); ?>"
                    data-chapter="<?php echo esc_attr($chapter['number']); ?>"
                    data-label="<?php echo esc_attr($chapter['heading']); ?>"
                    aria-label="Jump to Chapter <?php echo esc_attr($chapter['number'] . ': ' . $chapter['heading']); ?>"></a>
            <?php endforeach; ?>
        </nav>
    <?php endif; ?>



    <!-- ==========================================================
         HERO
    =========================================================== -->

    <section class="love-hero">
        <?php if ($hero_image): ?>
            <div class="love-hero-media">
                <img src="<?php echo esc_url($hero_image['url']); ?>"
                    alt="Symbolic clash of iron blades, storm  lightning colliding in darkness">

            </div>
        <?php endif; ?>

        <div class="love-hero-overlay" aria-hidden="true"></div>

        <div class="love-hero-content">
            <?php if ($hero_heading): ?>
                <h1 class="love-split"><?php echo ($hero_heading); ?></h1>
            <?php endif; ?>
            <?php if ($hero_intro): ?>
                <?php echo wp_kses_post($hero_intro); ?>
            <?php endif; ?>

        </div>
    </section>


    <!-- ==========================================================
        CAST
    =========================================================== -->

    <?php if ($cast): ?>
        <section class="love-three love-reveal" aria-labelledby="love-three-heading">
            <span class="love-eyebrow" id="love-three-heading">Who's In This Story</span>
            <h2 class="love-three-names">
                <?php foreach ($cast as $i => $c):
                    if ($i > 0)
                        echo '<span class="love-three-sep" aria-hidden="true">&amp;</span>';
                    ?>
                    <a href="<?php echo esc_url(get_permalink($c['post']->ID)); ?>"
                        class="<?php echo esc_attr($c['class']); ?>">
                        <?php echo esc_html($c['post']->post_title); ?>
                    </a>
                <?php endforeach; ?>
            </h2>
        </section>
    <?php endif; ?>


    <!-- ==========================================================
         INTRO + DISCLAIMER
    =========================================================== -->

    <?php if ($intro_heading || $intro_text): ?>
        <section class="love-intro love-reveal">
            <div class="love-intro-inner">
                <span class="love-eyebrow">Before The Story</span>
                <?php if ($intro_heading): ?>
                    <h2 class="love-split"><?php echo ($intro_heading); ?></h2>
                <?php endif; ?>
                <?php if ($intro_text): ?>
                    <div class="love-intro-copy"><?php echo wp_kses_post($intro_text); ?></div>
                <?php endif; ?>

            </div>
        </section>
    <?php endif; ?>


    <!-- ==========================================================
         CHAPTERS + INTERLUDE
    =========================================================== -->

    <div class="love-chapters">
        <?php foreach ($chapters as $index => $chapter):
            $god_key = $chapter_god_map[$index] ?? 'gold';
            ?>
            <section class="love-chapter love-reveal" id="chapter-<?php echo esc_attr($chapter['number']); ?>"
                data-chapter="<?php echo esc_attr($chapter['number']); ?>"
                style="--chapter-color: var(--<?php echo esc_attr($god_key); ?>, var(--love-gold));">

                <div class="love-chapter-marker">
                    <strong><?php echo esc_html($chapter['number']); ?></strong> <span>Chapter</span>

                </div>

                <?php if ($chapter['heading']): ?>
                    <h2 class="love-split"><?php echo ($chapter['heading']); ?></h2>
                <?php endif; ?>

                <?php if ($chapter['text']): ?>
                    <div class="love-chapter-text"><?php echo wp_kses_post($chapter['text']); ?></div>
                <?php endif; ?>
            </section>

            <?php
            if ($index === 2 && $beat_1): ?>
                <div class="love-beat love-reveal">
                    <div class="love-beat-inner"><?php echo wpautop(esc_html($beat_1)); ?></div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>

        <?php if ($beat_2): ?>
            <div class="love-beat love-beat--closing love-reveal">
                <div class="love-beat-inner"><?php echo wpautop(esc_html($beat_2)); ?></div>
            </div>
        <?php endif; ?>
    </div>


    <!-- ==========================================================
         BEYOND THE STORY
    =========================================================== -->

    <?php if ($beyond_heading || $beyond_text): ?>
        <section class="love-beyond love-reveal">
            <span class="love-eyebrow">Beyond The Story</span>
            <?php if ($beyond_heading): ?>
                <h2 class="love-split"><?php echo ($beyond_heading); ?></h2>
            <?php endif; ?>
            <?php if ($beyond_text): ?>
                <div class="love-beyond-copy"><?php echo wp_kses_post($beyond_text); ?></div>
            <?php endif; ?>
        </section>
    <?php endif; ?>
    <section class="love-story-cta">
        <h2>The Tapestry Continues</h2>
        <p>Every connection shapes the cosmos. Other threads await your discovery.</p>
        <a href="<?php echo esc_url($stories_archive); ?>" class="btn-primary"
            aria-label="Return to the stories archive to browse all narratives">
            Return to the stories
        </a>
    </section>

</div>




<?php get_footer(); ?>