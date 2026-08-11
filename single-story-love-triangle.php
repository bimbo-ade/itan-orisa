<?php
/**
 * Template Name: Love Triangle

 */

get_header();


// ============================================================
// HERO
// ============================================================

$hero_image = get_field('love_hero_image');
$hero_heading = get_field('love_hero_heading') ?: 'She Left The Smith For The Storm';
$hero_intro = get_field('love_hero_intro');


// ============================================================
// INTRO
// ============================================================

$intro_heading = get_field('love_intro_heading') ?: 'Three Forces. Three Destinies. One Impossible Choice.';
$intro_text = get_field('love_intro_text');


// ============================================================
// CHARACTERS
// ============================================================

$ogun_image = get_field('love_ogun_image');
$ogun_text  = get_field('love_ogun_text');

$oya_image  = get_field('love_oya_image');
$oya_text   = get_field('love_oya_text');

$sango_image = get_field('love_sango_image');
$sango_text  = get_field('love_sango_text');


// ============================================================
// CHAPTERS
// ============================================================

$chapters = [];

for ($i = 1; $i <= 6; $i++) {

    $chapters[$i] = [
        'heading' => get_field("love_chapter_{$i}_heading"),
        'text'    => get_field("love_chapter_{$i}_text"),
        'image'   => get_field("love_chapter_{$i}_image"),
    ];

}


// ============================================================
// BEYOND THE STORY
// ============================================================

$beyond_heading = get_field('love_beyond_heading');
$beyond_text    = get_field('love_beyond_text');

?>

<main class="love-page">

    <!-- ======================================================
         HERO
    ======================================================= -->

    <section class="love-hero">

        <?php if ($hero_image) : ?>

            <div class="love-hero__background" aria-hidden="true">
                <img
                    src="<?php echo esc_url($hero_image['url']); ?>"
                    alt=""
                >
            </div>

        <?php endif; ?>

        <div class="love-hero__overlay" aria-hidden="true"></div>

        <div class="love-hero__content">

            <span class="love-eyebrow">
                A Yorùbá Myth of Choice &amp; Consequence
            </span>

            <h1>
                <?php echo wp_kses_post($hero_heading); ?>
            </h1>

            <?php if ($hero_intro) : ?>

                <p>
                    <?php echo esc_html($hero_intro); ?>
                </p>

            <?php endif; ?>

            <a href="#story" class="love-hero__scroll">
                Begin The Story
                <span aria-hidden="true">↓</span>
            </a>

        </div>

    </section>


    <!-- ======================================================
         INTRODUCTION
    ======================================================= -->

    <section class="love-intro" id="story">

        <div class="love-container">

            <span class="love-eyebrow">
                The Beginning
            </span>

            <h2>
                <?php echo wp_kses_post($intro_heading); ?>
            </h2>

            <?php if ($intro_text) : ?>

                <div class="love-intro__text">
                    <?php echo wp_kses_post(wpautop($intro_text)); ?>
                </div>

            <?php endif; ?>

        </div>

    </section>


    <!-- ======================================================
         THREE FORCES
    ======================================================= -->

    <section class="love-forces">

        <div class="love-container">

            <div class="love-section-heading">

                <span class="love-eyebrow">
                    Three Forces
                </span>

                <h2>
                    One Story.
                </h2>

            </div>


            <div class="love-forces__grid">


                <!-- OGUN -->

                <article class="love-force love-force--ogun">

                    <?php if ($ogun_image) : ?>

                        <div class="love-force__image">

                            <img
                                src="<?php echo esc_url($ogun_image['url']); ?>"
                                alt=""
                                loading="lazy"
                            >

                        </div>

                    <?php endif; ?>

                    <div class="love-force__content">

                        <span class="love-force__number">
                            01
                        </span>

                        <h3>Ògún</h3>

                        <span class="love-force__role">
                            The Forger
                        </span>

                        <?php if ($ogun_text) : ?>

                            <div class="love-force__text">
                                <?php echo wp_kses_post(wpautop($ogun_text)); ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </article>


                <!-- OYA -->

                <article class="love-force love-force--oya">

                    <?php if ($oya_image) : ?>

                        <div class="love-force__image">

                            <img
                                src="<?php echo esc_url($oya_image['url']); ?>"
                                alt=""
                                loading="lazy"
                            >

                        </div>

                    <?php endif; ?>

                    <div class="love-force__content">

                        <span class="love-force__number">
                            02
                        </span>

                        <h3>Ọ̀yá</h3>

                        <span class="love-force__role">
                            The Whirlwind
                        </span>

                        <?php if ($oya_text) : ?>

                            <div class="love-force__text">
                                <?php echo wp_kses_post(wpautop($oya_text)); ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </article>


                <!-- SANGO -->

                <article class="love-force love-force--sango">

                    <?php if ($sango_image) : ?>

                        <div class="love-force__image">

                            <img
                                src="<?php echo esc_url($sango_image['url']); ?>"
                                alt=""
                                loading="lazy"
                            >

                        </div>

                    <?php endif; ?>

                    <div class="love-force__content">

                        <span class="love-force__number">
                            03
                        </span>

                        <h3>Ṣàngó</h3>

                        <span class="love-force__role">
                            The Thunderer
                        </span>

                        <?php if ($sango_text) : ?>

                            <div class="love-force__text">
                                <?php echo wp_kses_post(wpautop($sango_text)); ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </article>

            </div>

        </div>

    </section>


    <!-- ======================================================
         CHAPTER NAVIGATION
    ======================================================= -->

    <nav class="love-chapters" aria-label="Story chapters">

        <div class="love-container">

            <div class="love-chapters__intro">

                <span class="love-eyebrow">
                    The Story
                </span>

                <span class="love-chapters__count">
                    6 Chapters
                </span>

            </div>


            <ol class="love-chapters__list">

                <?php for ($i = 1; $i <= 6; $i++) : ?>

                    <?php if (!empty($chapters[$i]['heading'])) : ?>

                        <li>

                            <a href="#chapter-<?php echo $i; ?>">

                                <span>
                                    <?php echo sprintf('%02d', $i); ?>
                                </span>

                                <strong>
                                    <?php echo esc_html($chapters[$i]['heading']); ?>
                                </strong>

                            </a>

                        </li>

                    <?php endif; ?>

                <?php endfor; ?>

            </ol>

        </div>

    </nav>


    <!-- ======================================================
         FULL STORY
    ======================================================= -->

    <section class="love-story">

        <div class="love-container">

            <?php for ($i = 1; $i <= 6; $i++) : ?>

                <?php

                $chapter = $chapters[$i];

                if (
                    empty($chapter['heading']) &&
                    empty($chapter['text'])
                ) {
                    continue;
                }

                $has_image = !empty($chapter['image']);

                ?>

                <article
                    class="love-chapter love-chapter--<?php echo $i; ?> <?php echo $has_image ? 'has-image' : 'no-image'; ?>"
                    id="chapter-<?php echo $i; ?>"
                >

                    <div class="love-chapter__number">

                        <span>
                            <?php echo sprintf('%02d', $i); ?>
                        </span>

                    </div>


                    <div class="love-chapter__content">

                        <span class="love-eyebrow">
                            Chapter <?php echo sprintf('%02d', $i); ?>
                        </span>

                        <?php if ($chapter['heading']) : ?>

                            <h2>
                                <?php echo wp_kses_post($chapter['heading']); ?>
                            </h2>

                        <?php endif; ?>

                        <?php if ($chapter['text']) : ?>

                            <div class="love-chapter__text">

                                <?php echo wp_kses_post(wpautop($chapter['text'])); ?>

                            </div>

                        <?php endif; ?>

                    </div>


                    <?php if ($has_image) : ?>

                        <figure class="love-chapter__image">

                            <img
                                src="<?php echo esc_url($chapter['image']['url']); ?>"
                                alt=""
                                loading="lazy"
                            >

                        </figure>

                    <?php endif; ?>

                </article>

            <?php endfor; ?>

        </div>

    </section>


    <!-- ======================================================
         BEYOND THE STORY
    ======================================================= -->

    <?php if ($beyond_heading || $beyond_text) : ?>

        <section class="love-beyond">

            <div class="love-container">

                <span class="love-eyebrow">
                    Beyond The Story
                </span>

                <?php if ($beyond_heading) : ?>

                    <h2>
                        <?php echo wp_kses_post($beyond_heading); ?>
                    </h2>

                <?php endif; ?>

                <?php if ($beyond_text) : ?>

                    <div class="love-beyond__text">

                        <?php echo wp_kses_post(wpautop($beyond_text)); ?>

                    </div>

                <?php endif; ?>

            </div>

        </section>

    <?php endif; ?>


    <!-- ======================================================
         END
    ======================================================= -->

    <section class="love-ending">

        <div class="love-container">

            <span aria-hidden="true">✦</span>

            <p>
                Some stories are never truly over.
            </p>

            <small>
                The story continues in memory.
            </small>

        </div>

    </section>

</main>


<?php get_footer(); ?>
