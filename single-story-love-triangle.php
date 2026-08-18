<?php
/**
 * single-story-love-triangle.php
 *
 * REBUILT structure — 7 narrative chapters (down from 13; the old
 * XII "The Wives Nobody Can Ignore" and XIII "So Who Really Lost?"
 * now live in the Beyond The Story section, which is where that
 * kind of reflection belongs) plus two unnumbered interludes:
 *
 *   Ch1  Before There Was a Triangle       [image]
 *   Ch2  The Woman Who Wasn't Meant to Be Found  [image]
 *   —    INTERLUDE: "She Left The Smith For The Storm..."
 *   Ch3  Iron and Thunder (rivalry + the war + the curse)  [image]
 *   Ch4  Thunder and Storm (she becomes his equal)  [image]
 *   Ch5  The Betrayal (the secret unravels, she leaves)  [image]
 *   Ch6  Mother of Nine (the curse resolved)  [image]
 *   Ch7  When Thunder Falls (both men's endings)  [text-only, deliberately —
 *        a pause after five image-heavy chapters]
 *   —    INTERLUDE: the tagline, paid off
 *   Beyond The Story (absorbs the old Ch XII + XIII reflection)
 *
 * JS-OPTIONAL BY DESIGN:
 *   - Every section renders fully visible in raw HTML. Nothing
 *     is opacity:0 waiting on a script.
 *   - Scroll-triggered motion (reveal, chapter-image drift, the
 *     word-by-word heading reveal, the progress bar) all run on
 *     native CSS scroll-driven animations (animation-timeline:
 *     view()/scroll()) — zero JS. Unsupported browsers just see
 *     the static, fully-visible version — see love-story.css.
 *   - Heading word-splitting happens HERE, in PHP, not in JS —
 *     see love_split_words() below — so the split markup ships
 *     in the raw HTML regardless of script state.
 *   - JS is left with exactly the things that have no content to
 *     protect if it fails: embers, cursor glow, the sound toggle,
 *     and highlighting which chapter-rail dot is active. All are
 *     <noscript>-guarded so nothing renders as an inert control.
 */

get_header();


/**
 * Wraps each word of $text in nested spans so a CSS scroll-driven
 * animation can stagger them in — entirely without JS. Falls back
 * to plain, fully visible text in any browser/state that doesn't
 * support the animation (see .love-split rules in the CSS).
 */
function love_split_words($text) {
    $text = wp_strip_all_tags($text);
    $words = preg_split('/\s+/', trim($text));
    $count = count($words);
    $out = '';
    foreach ($words as $i => $word) {
        $delay = number_format($i * 0.04, 3);
        $out .= '<span class="word"><span class="word-inner" style="--word-delay:' . $delay . 's">' . esc_html($word) . '</span></span>';
        if ($i < $count - 1) $out .= ' ';
    }
    return $out;
}


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

$ogun_image = get_field('love_ogun_image');
$ogun_text = get_field('love_ogun_text');

$oya_image = get_field('love_oya_image');
$oya_text = get_field('love_oya_text');

$sango_image = get_field('love_sango_image');
$sango_text = get_field('love_sango_text');

$beyond_heading = get_field('love_beyond_heading') ?: 'So Who Really Lost?';
$beyond_text = get_field('love_beyond_text');

$ambient_sound = get_field('love_ambient_sound'); // File field, optional

// The two interludes — defaults are the exact lines we worked out,
// editable in ACF if you want to adjust the wording later.
$beat_1 = get_field('love_beat_1_text') ?: "\"She Left The Smith For The Storm.\"\nThat's the story everyone tells.\nIt isn't the whole one.";
$beat_2 = get_field('love_beat_2_text') ?: "In the end, she really did leave — not the smith, but the storm.\nNo curse held her. No god chased her. She simply walked away, and the wind went with her.\nMaybe that's when the title finally became true.";


/*
|--------------------------------------------------------------------------
| CHAPTERS — 7 slots. Leave love_chapter_{n}_image blank on purpose
| for chapters meant to be text-only (Chapter 7 by default).
|--------------------------------------------------------------------------
*/

$chapters = [];

for ($i = 1; $i <= 7; $i++) {

    $heading = get_field("love_chapter_{$i}_heading");
    $text = get_field("love_chapter_{$i}_text");
    $image = get_field("love_chapter_{$i}_image");

    if ($heading || $text || $image) {
        $chapters[] = [
            'number' => sprintf('%02d', $i),
            'heading' => $heading,
            'text' => $text,
            'image' => $image,
        ];
    }
}

$total_chapters = count($chapters);
?>

<main class="love-story">

    <!-- =========================================================
         AMBIENT EXPERIENCE (background grain/glow — pure CSS,
         no JS involved, always renders)
    ========================================================== -->

    <div class="love-atmosphere" aria-hidden="true">
        <div class="love-atmosphere-glow"></div>
        <div class="love-atmosphere-noise"></div>
    </div>


    <!-- =========================================================
         FX LAYER — decorative only. Each piece is meaningless
         without JS, so each hides itself via <noscript> rather
         than rendering as a dead control.
    ========================================================== -->

    <noscript><style>
        .love-embers, .love-progress-bar, .love-sound-toggle { display: none !important; }
    </style></noscript>

    <canvas class="love-embers" aria-hidden="true"></canvas>

    <div class="love-progress-bar" aria-hidden="true"></div>

    <?php if ($chapters) : ?>
    <nav class="love-chapter-rail" aria-label="Chapter progress">
        <?php foreach ($chapters as $chapter) : ?>
            <a href="#chapter-<?php echo esc_attr($chapter['number']); ?>"
               data-chapter="<?php echo esc_attr($chapter['number']); ?>"
               data-label="<?php echo esc_attr($chapter['heading']); ?>"></a>
        <?php endforeach; ?>
    </nav>
    <?php endif; ?>
    <!-- Note: the rail itself works with JS disabled — it's just
         anchor links, native browser scrolling handles the jump.
         Only the "which dot is currently active" highlight needs
         JS; without it, the dots are simply neutral, which is a
         fine degraded state, not a broken one. -->


    <!-- =========================================================
         SOUND CONTROL — only renders if an ambient file is set,
         and hidden entirely without JS via the noscript rule above
    ========================================================== -->

    <?php if ($ambient_sound) : ?>
    <button
        class="love-sound-toggle"
        type="button"
        aria-pressed="false"
        aria-label="Turn story ambience on"
    >
        <span class="love-sound-icon" aria-hidden="true">◌</span>
        <span class="love-sound-label">Sound off</span>
    </button>
    <?php endif; ?>


    <!-- =========================================================
         HERO
    ========================================================== -->

    <section class="love-hero">

        <?php if ($hero_image): ?>

            <div class="love-hero-media" aria-hidden="true">
                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="">
            </div>

        <?php endif; ?>

        <div class="love-hero-overlay" aria-hidden="true"></div>

        <div class="love-cursor-glow" aria-hidden="true"></div>

        <div class="love-hero-content">

            <span class="love-eyebrow">
                An Ìtàn Òrìṣà
            </span>

            <?php if ($hero_heading): ?>
                <h1 class="love-split"><?php echo love_split_words($hero_heading); ?></h1>
            <?php endif; ?>

            <?php if ($hero_intro): ?>
                <p><?php echo wp_kses_post($hero_intro); ?></p>
            <?php endif; ?>

            <div class="love-enter">
                <span>Scroll to enter</span>
                <span class="love-scroll-arrow" aria-hidden="true">↓</span>
            </div>

        </div>

    </section>


    <!-- =========================================================
         INTRODUCTION
    ========================================================== -->

    <?php if ($intro_heading || $intro_text): ?>

        <section class="love-intro love-reveal">
            <div class="love-intro-inner">

                <span class="love-section-number">00</span>

                <?php if ($intro_heading): ?>
                    <h2 class="love-split"><?php echo love_split_words($intro_heading); ?></h2>
                <?php endif; ?>

                <?php if ($intro_text): ?>
                    <div class="love-intro-copy love-parallax-fade">
                        <?php echo wp_kses_post($intro_text); ?>
                    </div>
                <?php endif; ?>

            </div>
        </section>

    <?php endif; ?>


    <!-- =========================================================
         THE THREE GODS
    ========================================================== -->

    <section class="love-gods">

        <div class="love-gods-intro">
            <span>Before the story begins</span>
            <h2 class="love-split"><?php echo love_split_words('Three forces. One story.'); ?></h2>
        </div>

        <?php if ($ogun_image || $ogun_text): ?>
        <article class="love-god love-god--ogun">
            <?php if ($ogun_image): ?>
                <div class="love-god-media">
                    <img src="<?php echo esc_url($ogun_image['url']); ?>"
                         alt="<?php echo esc_attr( $ogun_image['alt'] ?: 'Ògún, god of iron and the forge' ); ?>"
                         loading="lazy">
                </div>
            <?php endif; ?>
            <div class="love-god-content">
                <span>01</span>
                <h3 class="love-split"><?php echo love_split_words('Ogun'); ?></h3>
                <?php if ($ogun_text): ?><div><?php echo wp_kses_post($ogun_text); ?></div><?php endif; ?>
            </div>
        </article>
        <?php endif; ?>

        <?php if ($oya_image || $oya_text): ?>
        <article class="love-god love-god--oya">
            <?php if ($oya_image): ?>
                <div class="love-god-media">
                    <img src="<?php echo esc_url($oya_image['url']); ?>"
                         alt="<?php echo esc_attr( $oya_image['alt'] ?: 'Ọ̀yá, goddess of wind and storms' ); ?>"
                         loading="lazy">
                </div>
            <?php endif; ?>
            <div class="love-god-content">
                <span>02</span>
                <h3 class="love-split"><?php echo love_split_words('Ọya'); ?></h3>
                <?php if ($oya_text): ?><div><?php echo wp_kses_post($oya_text); ?></div><?php endif; ?>
            </div>
        </article>
        <?php endif; ?>

        <?php if ($sango_image || $sango_text): ?>
        <article class="love-god love-god--sango">
            <?php if ($sango_image): ?>
                <div class="love-god-media">
                    <img src="<?php echo esc_url($sango_image['url']); ?>"
                         alt="<?php echo esc_attr( $sango_image['alt'] ?: 'Ṣàngó, god of thunder and lightning' ); ?>"
                         loading="lazy">
                </div>
            <?php endif; ?>
            <div class="love-god-content">
                <span>03</span>
                <h3 class="love-split"><?php echo love_split_words('Ṣàngó'); ?></h3>
                <?php if ($sango_text): ?><div><?php echo wp_kses_post($sango_text); ?></div><?php endif; ?>
            </div>
        </article>
        <?php endif; ?>

    </section>


    <!-- =========================================================
         CHAPTERS + INTERLUDES
    ========================================================== -->

    <div class="love-chapters">

        <?php foreach ($chapters as $index => $chapter): ?>

            <?php
            $chapter_class = 'love-chapter love-reveal';
            $chapter_class .= $chapter['image'] ? ' love-chapter--has-image' : ' love-chapter--text-only';
            if ($index % 2 !== 0) $chapter_class .= ' love-chapter--reverse';
            ?>

            <section
                class="<?php echo esc_attr($chapter_class); ?>"
                data-chapter="<?php echo esc_attr($chapter['number']); ?>"
                id="chapter-<?php echo esc_attr($chapter['number']); ?>"
            >
                <?php if ($chapter['image']): ?>
                    <div class="love-chapter-media love-parallax-img">
                        <div
                            class="love-chapter-image"
                            style="--chapter-image: url('<?php echo esc_url($chapter['image']['url']); ?>');"
                            role="img"
                            aria-label="<?php echo esc_attr(
                                $chapter['image']['alt']
                                    ?: ( $chapter['heading'] ? wp_strip_all_tags($chapter['heading']) : 'Illustration for Chapter ' . $chapter['number'] )
                            ); ?>"
                        ></div>
                    </div>
                <?php endif; ?>

                <div class="love-chapter-content">
                    <div class="love-chapter-marker">
                        <span>Chapter</span>
                        <strong><?php echo esc_html($chapter['number']); ?></strong>
                    </div>

                    <?php if ($chapter['heading']): ?>
                        <h2 class="love-split"><?php echo love_split_words($chapter['heading']); ?></h2>
                    <?php endif; ?>

                    <?php if ($chapter['text']): ?>
                        <div class="love-chapter-text love-parallax-fade">
                            <?php echo wp_kses_post($chapter['text']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <?php
            // Interlude 1 — right after Chapter 2 (the stolen-skin
            // reveal), before the rivalry escalates.
            if ($index === 1 && $beat_1) : ?>
                <div class="love-beat love-reveal">
                    <div class="love-beat-inner">
                        <?php echo wpautop(esc_html($beat_1)); ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>

        <?php
        // Interlude 2 — right after the final chapter, paying off
        // the tagline before we move into Beyond The Story.
        if ($beat_2) : ?>
            <div class="love-beat love-beat--closing love-reveal">
                <div class="love-beat-inner">
                    <?php echo wpautop(esc_html($beat_2)); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>


    <!-- =========================================================
         BEYOND THE STORY — now also holds the old Ch. XII/XIII
         reflection ("the wives nobody can ignore", "so who really
         lost?") since that's exactly what this section is for.
    ========================================================== -->

    <?php if ($beyond_heading || $beyond_text): ?>

        <section class="love-beyond love-reveal">
            <div class="love-beyond-background" aria-hidden="true"></div>
            <div class="love-beyond-content">

                <span>Beyond the story</span>

                <?php if ($beyond_heading): ?>
                    <h2 class="love-split"><?php echo love_split_words($beyond_heading); ?></h2>
                <?php endif; ?>

                <?php if ($beyond_text): ?>
                    <div><?php echo wp_kses_post($beyond_text); ?></div>
                <?php endif; ?>

            </div>
        </section>

    <?php endif; ?>


    <!-- =========================================================
         END
    ========================================================== -->

    <section class="love-ending">
        <div class="love-container">
            <span aria-hidden="true">✦</span>
            <p>Some stories are never truly over.</p>
            <small>The story continues in memory.</small>
        </div>
    </section>

</main>


<!-- =============================================================
     AMBIENT AUDIO — only output if a sound file is set
============================================================== -->

<?php if ($ambient_sound) : ?>
<audio id="love-ambience" preload="none" loop aria-hidden="true">
    <source
        src="<?php echo esc_url($ambient_sound['url']); ?>"
        type="<?php echo esc_attr($ambient_sound['mime_type'] ?? 'audio/mpeg'); ?>"
    >
</audio>
<?php endif; ?>


<?php
wp_enqueue_style(
    'love-story',
    get_stylesheet_directory_uri() . '/css/love-story.css',
    [],
    '1.1'
);

wp_enqueue_script(
    'love-story',
    get_stylesheet_directory_uri() . '/js/love-story.js',
    [],
    '1.1',
    true
);
?>

<?php get_footer(); ?>