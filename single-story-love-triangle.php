<?php

/**
 * single-story-love-triangle
 
 */

get_header();

/*
|--------------------------------------------------------------------------
| ACF CONTENT  (names unchanged from v1)
|--------------------------------------------------------------------------
*/

$hero_image     = get_field('love_hero_image');
$hero_heading   = get_field('love_hero_heading');
$hero_intro     = get_field('love_hero_intro');

$intro_heading  = get_field('love_intro_heading');
$intro_text     = get_field('love_intro_text');

$ogun_image     = get_field('love_ogun_image');
$ogun_text      = get_field('love_ogun_text');

$oya_image      = get_field('love_oya_image');
$oya_text       = get_field('love_oya_text');

$sango_image    = get_field('love_sango_image');
$sango_text     = get_field('love_sango_text');

$beyond_heading = get_field('love_beyond_heading');
$beyond_text    = get_field('love_beyond_text');

$ambient_sound  = get_field('love_ambient_sound');   // File field, optional

// Optional additions (safe if the fields don't exist)
$interlude_quote  = function_exists('get_field') ? get_field('love_interlude_quote')  : '';
$interlude_source = function_exists('get_field') ? get_field('love_interlude_source') : '';

/*
|--------------------------------------------------------------------------
| THE THREE FORCES
|--------------------------------------------------------------------------
*/

$forces = [
    [
        'key'   => 'ogun',
        'index' => '01',
        'name'  => 'Ògún',
        'role'  => 'Iron. The forge. What is built.',
        'image' => $ogun_image,
        'text'  => $ogun_text,
        'alt'   => 'Ògún, god of iron and the forge',
    ],
    [
        'key'   => 'oya',
        'index' => '02',
        'name'  => 'Ọ̀yá',
        'role'  => 'Wind. The river. What changes.',
        'image' => $oya_image,
        'text'  => $oya_text,
        'alt'   => 'Ọ̀yá, goddess of wind, storms and transformation',
    ],
    [
        'key'   => 'sango',
        'index' => '03',
        'name'  => 'Ṣàngó',
        'role'  => 'Fire. The thunder. What arrives.',
        'image' => $sango_image,
        'text'  => $sango_text,
        'alt'   => 'Ṣàngó, god of thunder and lightning',
    ],
];

$forces = array_values(array_filter($forces, static function ($f) {
    return $f['image'] || $f['text'];
}));

/*
|--------------------------------------------------------------------------
| CHAPTERS  (ACF Free has no repeaters — six manual groups)
|--------------------------------------------------------------------------
| Each chapter is assigned a "tone" so the page's accent colour travels
| Ògún -> Ọ̀yá -> Ṣàngó -> resolution as the story turns.
*/

$chapter_tones = ['ogun', 'sango', 'oya', 'sango', 'oya', 'ash'];

$chapters = [];

for ($i = 1; $i <= 6; $i++) {

    $heading = get_field("love_chapter_{$i}_heading");
    $text    = get_field("love_chapter_{$i}_text");
    $image   = get_field("love_chapter_{$i}_image");

    if ($heading || $text || $image) {
        $chapters[] = [
            'number'  => sprintf('%02d', $i),
            'heading' => $heading,
            'text'    => $text,
            'image'   => $image,
            'tone'    => $chapter_tones[$i - 1] ?? 'ash',
        ];
    }
}

$chapter_count = count($chapters);
$interlude_after = $chapter_count >= 4 ? 2 : -1; // 0-based index; after chapter 03
?>

<main class="lt" data-lt>

    <!-- =====================================================
         THE STAGE — one fixed backdrop that cross-fades
    ====================================================== -->
    <div class="lt-stage" aria-hidden="true">
        <?php if ($hero_image) : ?>
            <div class="lt-stage__layer is-active" data-stage="hero"
                 style="--img:url('<?php echo esc_url($hero_image['url']); ?>')"></div>
        <?php endif; ?>

        <?php foreach ($chapters as $chapter) : ?>
            <?php if ($chapter['image']) : ?>
                <div class="lt-stage__layer"
                     data-stage="chapter-<?php echo esc_attr($chapter['number']); ?>"
                     style="--img:url('<?php echo esc_url($chapter['image']['url']); ?>')"></div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="lt-stage__wash"></div>
        <div class="lt-stage__grain"></div>
    </div>

    <canvas class="lt-dust" aria-hidden="true"></canvas>
    <div class="lt-cursor" aria-hidden="true"></div>

    <!-- =====================================================
         HUD — title, progress, sound
    ====================================================== -->
    <header class="lt-hud" data-lt-hud>
        <a class="lt-hud__title" href="<?php echo esc_url(home_url('/')); ?>">
            <span aria-hidden="true">◬</span>
            <span>Ìtàn Òrìṣà</span>
        </a>

        <p class="lt-hud__now" data-lt-now aria-live="polite">
            <span class="lt-hud__now-label">Now reading</span>
            <span class="lt-hud__now-value">The Love Triangle</span>
        </p>

        <?php if ($ambient_sound) : ?>
            <button class="lt-sound" type="button" aria-pressed="false"
                    aria-label="Turn story ambience on" data-lt-sound>
                <span class="lt-sound__bars" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
                <span class="lt-sound__label">Sound</span>
            </button>
        <?php endif; ?>

        <div class="lt-hud__progress" aria-hidden="true"><span data-lt-progress></span></div>
    </header>

    <!-- =====================================================
         CHAPTER RAIL
    ====================================================== -->
    <?php if ($chapters) : ?>
        <nav class="lt-rail" aria-label="Chapters">
            <ol>
                <?php foreach ($chapters as $chapter) : ?>
                    <li>
                        <a href="#chapter-<?php echo esc_attr($chapter['number']); ?>"
                           data-lt-rail="chapter-<?php echo esc_attr($chapter['number']); ?>"
                           data-tone="<?php echo esc_attr($chapter['tone']); ?>">
                            <span class="lt-rail__num"><?php echo esc_html($chapter['number']); ?></span>
                            <span class="lt-rail__label">
                                <?php echo esc_html(wp_strip_all_tags((string) $chapter['heading'])); ?>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>
    <?php endif; ?>

    <!-- =====================================================
         HERO
    ====================================================== -->
    <section class="lt-hero" data-lt-stage="hero">
        <div class="lt-hero__inner">

            <p class="lt-eyebrow"><span>An Ìtàn Òrìṣà</span></p>

            <?php if ($hero_heading) : ?>
                <h1 class="lt-hero__title" data-lt-split>
                    <?php echo wp_kses_post($hero_heading); ?>
                </h1>
            <?php endif; ?>

            <?php if ($hero_intro) : ?>
                <div class="lt-hero__intro" data-lt-reveal>
                    <?php echo wp_kses_post($hero_intro); ?>
                </div>
            <?php endif; ?>

            <?php if ($forces) : ?>
                <ul class="lt-triad" data-lt-reveal>
                    <?php foreach ($forces as $force) : ?>
                        <li data-god="<?php echo esc_attr($force['key']); ?>">
                            <span class="lt-triad__name"><?php echo esc_html($force['name']); ?></span>
                            <span class="lt-triad__role"><?php echo esc_html($force['role']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="lt-scrollcue" aria-hidden="true">
            <span>Scroll</span><i></i>
        </div>
    </section>

    <!-- =====================================================
         OVERTURE
    ====================================================== -->
    <?php if ($intro_heading || $intro_text) : ?>
        <section class="lt-overture" data-lt-stage="hero">
            <p class="lt-marker" data-lt-reveal><span>00</span> Overture</p>

            <?php if ($intro_heading) : ?>
                <h2 class="lt-overture__heading" data-lt-split>
                    <?php echo wp_kses_post($intro_heading); ?>
                </h2>
            <?php endif; ?>

            <?php if ($intro_text) : ?>
                <div class="lt-prose lt-prose--lead" data-lt-reveal>
                    <?php echo wp_kses_post($intro_text); ?>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <!-- =====================================================
         THE THREE FORCES
    ====================================================== -->
    <?php if ($forces) : ?>
        <section class="lt-forces" aria-label="The three forces">
            <div class="lt-forces__head">
                <p class="lt-marker" data-lt-reveal><span>◬</span> Before it begins</p>
                <h2 class="lt-forces__title" data-lt-split>Three forces. One story.</h2>
            </div>

            <div class="lt-forces__grid">
                <?php foreach ($forces as $force) : ?>
                    <article class="lt-force" data-god="<?php echo esc_attr($force['key']); ?>" data-lt-reveal>
                        <?php if ($force['image']) : ?>
                            <div class="lt-force__media">
                                <img src="<?php echo esc_url($force['image']['url']); ?>"
                                     alt="<?php echo esc_attr($force['image']['alt'] ?: $force['alt']); ?>"
                                     loading="lazy" decoding="async" data-lt-parallax>
                            </div>
                        <?php endif; ?>

                        <div class="lt-force__body">
                            <span class="lt-force__index"><?php echo esc_html($force['index']); ?></span>
                            <h3 class="lt-force__name"><?php echo esc_html($force['name']); ?></h3>
                            <p class="lt-force__role"><?php echo esc_html($force['role']); ?></p>

                            <?php if ($force['text']) : ?>
                                <div class="lt-force__text"><?php echo wp_kses_post($force['text']); ?></div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- =====================================================
         CHAPTERS
    ====================================================== -->
    <?php if ($chapters) : ?>
        <div class="lt-chapters">
            <?php foreach ($chapters as $index => $chapter) : ?>

                <section class="lt-chapter<?php echo $chapter['image'] ? '' : ' lt-chapter--bare'; ?>"
                         id="chapter-<?php echo esc_attr($chapter['number']); ?>"
                         data-tone="<?php echo esc_attr($chapter['tone']); ?>"
                         data-lt-stage="chapter-<?php echo esc_attr($chapter['number']); ?>"
                         data-lt-chapter="chapter-<?php echo esc_attr($chapter['number']); ?>"
                         data-lt-chapter-label="<?php echo esc_attr(wp_strip_all_tags((string) $chapter['heading'])); ?>"
                         aria-labelledby="chapter-<?php echo esc_attr($chapter['number']); ?>-title">

                    <?php if ($chapter['image']) : ?>
                        <figure class="lt-chapter__plate">
                            <img src="<?php echo esc_url($chapter['image']['url']); ?>"
                                 alt="<?php echo esc_attr(
                                     $chapter['image']['alt']
                                        ?: ($chapter['heading']
                                            ? wp_strip_all_tags($chapter['heading'])
                                            : 'Illustration for chapter ' . $chapter['number'])
                                 ); ?>"
                                 loading="lazy" decoding="async" data-lt-parallax>
                            <figcaption aria-hidden="true">
                                Chapter <?php echo esc_html($chapter['number']); ?>
                            </figcaption>
                        </figure>
                    <?php endif; ?>

                    <div class="lt-chapter__body">
                        <p class="lt-marker" data-lt-reveal>
                            <span><?php echo esc_html($chapter['number']); ?></span> Chapter
                        </p>

                        <?php if ($chapter['heading']) : ?>
                            <h2 class="lt-chapter__title"
                                id="chapter-<?php echo esc_attr($chapter['number']); ?>-title"
                                data-lt-split>
                                <?php echo wp_kses_post($chapter['heading']); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if ($chapter['text']) : ?>
                            <div class="lt-prose<?php echo $index === 0 ? ' lt-prose--drop' : ''; ?>" data-lt-reveal>
                                <?php echo wp_kses_post($chapter['text']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <?php if ($index === $interlude_after && $interlude_quote) : ?>
                    <!-- INTERLUDE — the one bright room in the house -->
                    <section class="lt-interlude" data-lt-stage="none">
                        <blockquote data-lt-split>
                            <?php echo wp_kses_post($interlude_quote); ?>
                        </blockquote>
                        <?php if ($interlude_source) : ?>
                            <p class="lt-interlude__source" data-lt-reveal>
                                <?php echo esc_html($interlude_source); ?>
                            </p>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- =====================================================
         BEYOND THE STORY
    ====================================================== -->
    <?php if ($beyond_heading || $beyond_text) : ?>
        <section class="lt-beyond" data-lt-stage="none">
            <p class="lt-marker" data-lt-reveal><span>◬</span> Beyond the story</p>

            <?php if ($beyond_heading) : ?>
                <h2 class="lt-beyond__title" data-lt-split>
                    <?php echo wp_kses_post($beyond_heading); ?>
                </h2>
            <?php endif; ?>

            <?php if ($beyond_text) : ?>
                <div class="lt-prose" data-lt-reveal>
                    <?php echo wp_kses_post($beyond_text); ?>
                </div>
            <?php endif; ?>

            <p class="lt-beyond__mark" aria-hidden="true">◬</p>
        </section>
    <?php endif; ?>

</main>

<?php if ($ambient_sound) : ?>
    <audio id="lt-ambience" preload="none" loop aria-hidden="true">
        <source src="<?php echo esc_url($ambient_sound['url']); ?>"
                type="<?php echo esc_attr($ambient_sound['mime_type'] ?? 'audio/mpeg'); ?>">
    </audio>
<?php endif; ?>

<?php
/**
 * NOTE: enqueueing from inside the template body works, but it runs after
 * wp_head, so the CSS lands late and you can see a flash. Move these two
 * calls into functions.php instead:
 *
 * add_action('wp_enqueue_scripts', function () {
 *     if (is_singular('story') && get_post_field('post_name') === 'love-triangle') {
 *         wp_enqueue_style('love-story',  get_stylesheet_directory_uri() . '/css/love-story.css', [], '2.0');
 *         wp_enqueue_script('love-story', get_stylesheet_directory_uri() . '/js/love-story.js', [], '2.0', true);
 *     }
 * });
 */
wp_enqueue_style('love-story', get_stylesheet_directory_uri() . '/css/love-story.css', [], '2.0');
wp_enqueue_script('love-story', get_stylesheet_directory_uri() . '/js/love-story.js', [], '2.0', true);
?>

<?php get_footer(); ?>
