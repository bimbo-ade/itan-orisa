<?php
/**
 * single-story-love-triangle.php
 *
 * WordPress loads this automatically for the Story post whose
 * slug is "love-triangle" (single-story.php handles every other
 * story). One-page immersive scroll experience.
 *
 * Everything from our review is folded in:
 *  - Accessible chapter images (role="img" + aria-label, since a
 *    CSS background-image has no native alt-text mechanism)
 *  - get_stylesheet_directory_uri() instead of get_template_
 *    directory_uri() (correct even if a child theme is added later)
 *  - Word-by-word reveal on major headings (.love-split)
 *  - Scroll-linked parallax on images and select text
 *  - Ember particles, cursor glow, scroll progress bar + chapter rail
 *  - The JS that actually makes .love-reveal work (was missing —
 *    without it, everything below the hero was invisible)
 */

get_header();

/*
|--------------------------------------------------------------------------
| ACF CONTENT
|--------------------------------------------------------------------------
*/

$hero_image = get_field('love_hero_image');
$hero_heading = get_field('love_hero_heading');
$hero_intro = get_field('love_hero_intro');

$intro_heading = get_field('love_intro_heading');
$intro_text = get_field('love_intro_text');

$ogun_image = get_field('love_ogun_image');
$ogun_text = get_field('love_ogun_text');

$oya_image = get_field('love_oya_image');
$oya_text = get_field('love_oya_text');

$sango_image = get_field('love_sango_image');
$sango_text = get_field('love_sango_text');

$beyond_heading = get_field('love_beyond_heading');
$beyond_text = get_field('love_beyond_text');

$ambient_sound = get_field('love_ambient_sound'); // File field, optional


/*
|--------------------------------------------------------------------------
| CHAPTERS
|--------------------------------------------------------------------------
|
| ACF Free doesn't have repeaters, so we manually collect the
| six chapter field groups.
|
*/

$chapters = [];

for ($i = 1; $i <= 6; $i++) {

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
?>

<main class="love-story">

    <!-- =========================================================
         AMBIENT EXPERIENCE (background grain/glow, not the FX layer)
    ========================================================== -->

    <div class="love-atmosphere" aria-hidden="true">
        <div class="love-atmosphere-glow"></div>
        <div class="love-atmosphere-noise"></div>
    </div>


    <!-- =========================================================
         FX LAYER — embers, progress bar, chapter rail
    ========================================================== -->

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


    <!-- =========================================================
         SOUND CONTROL — only renders if an ambient file is set
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

                <img
                    src="<?php echo esc_url($hero_image['url']); ?>"
                    alt=""
                >

            </div>

        <?php endif; ?>

        <div class="love-hero-overlay" aria-hidden="true"></div>

        <div class="love-cursor-glow" aria-hidden="true"></div>

        <div class="love-hero-content">

            <span class="love-eyebrow">
                An Ìtàn Òrìṣà
            </span>

            <?php if ($hero_heading): ?>

                <h1 class="love-split">
                    <?php echo wp_kses_post($hero_heading); ?>
                </h1>

            <?php endif; ?>

            <?php if ($hero_intro): ?>

                <p>
                    <?php echo wp_kses_post($hero_intro); ?>
                </p>

            <?php endif; ?>

            <div class="love-enter">

                <span>Scroll to enter</span>

                <span
                    class="love-scroll-arrow"
                    aria-hidden="true"
                >
                    ↓
                </span>

            </div>

        </div>

    </section>


    <!-- =========================================================
         INTRODUCTION
    ========================================================== -->

    <?php if ($intro_heading || $intro_text): ?>

        <section class="love-intro love-reveal">

            <div class="love-intro-inner">

                <span class="love-section-number">
                    00
                </span>

                <?php if ($intro_heading): ?>

                    <h2 class="love-split">
                        <?php echo wp_kses_post($intro_heading); ?>
                    </h2>

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

            <h2 class="love-split">
                Three forces. One story.
            </h2>

        </div>


        <!-- OGUN -->

        <?php if ($ogun_image || $ogun_text): ?>

            <article class="love-god love-god--ogun">

                <?php if ($ogun_image): ?>

                    <div class="love-god-media">

                        <img
                            class="love-parallax-img"
                            src="<?php echo esc_url($ogun_image['url']); ?>"
                            alt="<?php echo esc_attr( $ogun_image['alt'] ?: 'Ògún, god of iron and the forge' ); ?>"
                            loading="lazy"
                        >

                    </div>

                <?php endif; ?>

                <div class="love-god-content">

                    <span>01</span>

                    <h3 class="love-split">Ogun</h3>

                    <?php if ($ogun_text): ?>

                        <div>
                            <?php echo wp_kses_post($ogun_text); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </article>

        <?php endif; ?>


        <!-- OYA -->

        <?php if ($oya_image || $oya_text): ?>

            <article class="love-god love-god--oya">

                <?php if ($oya_image): ?>

                    <div class="love-god-media">

                        <img
                            class="love-parallax-img"
                            src="<?php echo esc_url($oya_image['url']); ?>"
                            alt="<?php echo esc_attr( $oya_image['alt'] ?: 'Ọ̀yá, goddess of wind and storms' ); ?>"
                            loading="lazy"
                        >

                    </div>

                <?php endif; ?>

                <div class="love-god-content">

                    <span>02</span>

                    <h3 class="love-split">Ọya</h3>

                    <?php if ($oya_text): ?>

                        <div>
                            <?php echo wp_kses_post($oya_text); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </article>

        <?php endif; ?>


        <!-- SANGO -->

        <?php if ($sango_image || $sango_text): ?>

            <article class="love-god love-god--sango">

                <?php if ($sango_image): ?>

                    <div class="love-god-media">

                        <img
                            class="love-parallax-img"
                            src="<?php echo esc_url($sango_image['url']); ?>"
                            alt="<?php echo esc_attr( $sango_image['alt'] ?: 'Ṣàngó, god of thunder and lightning' ); ?>"
                            loading="lazy"
                        >

                    </div>

                <?php endif; ?>

                <div class="love-god-content">

                    <span>03</span>

                    <h3 class="love-split">Ṣàngó</h3>

                    <?php if ($sango_text): ?>

                        <div>
                            <?php echo wp_kses_post($sango_text); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </article>

        <?php endif; ?>

    </section>


    <!-- =========================================================
         CHAPTERS
    ========================================================== -->

    <div class="love-chapters">

        <?php foreach ($chapters as $index => $chapter): ?>

            <?php
            $chapter_class = 'love-chapter love-reveal';

            if ($chapter['image']) {
                $chapter_class .= ' love-chapter--has-image';
            } else {
                $chapter_class .= ' love-chapter--text-only';
            }

            if ($index % 2 !== 0) {
                $chapter_class .= ' love-chapter--reverse';
            }
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

                        <span>
                            Chapter
                        </span>

                        <strong>
                            <?php echo esc_html($chapter['number']); ?>
                        </strong>

                    </div>


                    <?php if ($chapter['heading']): ?>

                        <h2 class="love-split">
                            <?php echo wp_kses_post($chapter['heading']); ?>
                        </h2>

                    <?php endif; ?>


                    <?php if ($chapter['text']): ?>

                        <div class="love-chapter-text love-parallax-fade">
                            <?php echo wp_kses_post($chapter['text']); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </section>

        <?php endforeach; ?>

    </div>


    <!-- =========================================================
         ENDING
    ========================================================== -->

    <?php if ($beyond_heading || $beyond_text): ?>

        <section class="love-beyond love-reveal">

            <div class="love-beyond-background" aria-hidden="true"></div>

            <div class="love-beyond-content">

                <span>
                    Beyond the story
                </span>

                <?php if ($beyond_heading): ?>

                    <h2 class="love-split">
                        <?php echo wp_kses_post($beyond_heading); ?>
                    </h2>

                <?php endif; ?>

                <?php if ($beyond_text): ?>

                    <div>
                        <?php echo wp_kses_post($beyond_text); ?>
                    </div>

                <?php endif; ?>

            </div>

        </section>

    <?php endif; ?>


</main>


<!-- =============================================================
     AMBIENT AUDIO — only output if a sound file is set
============================================================== -->

<?php if ($ambient_sound) : ?>
<audio
    id="love-ambience"
    preload="none"
    loop
    aria-hidden="true"
>
    <source
        src="<?php echo esc_url($ambient_sound['url']); ?>"
        type="<?php echo esc_attr($ambient_sound['mime_type'] ?? 'audio/mpeg'); ?>"
    >
</audio>
<?php endif; ?>


<?php
// Both love-story.css and love-story.js live in your theme's
// css/ and js/ folders — adjust the paths below if yours differ.
// get_stylesheet_directory_uri() is used deliberately over
// get_template_directory_uri() so this still works correctly if
// a child theme is ever introduced.

wp_enqueue_style(
    'love-story',
    get_stylesheet_directory_uri() . '/css/love-story.css',
    [],
    '1.0'
);

wp_enqueue_script(
    'love-story',
    get_stylesheet_directory_uri() . '/js/love-story.js',
    [],
    '1.0',
    true
);
?>

<?php get_footer(); ?>