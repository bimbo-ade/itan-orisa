<?php
/**
 * Template Name: Love Triangle
 */

get_header();

/*
|--------------------------------------------------------------------------
| HERO
|--------------------------------------------------------------------------
*/

$hero_image = get_field('love_hero_image');
$hero_heading = get_field('love_hero_heading') ?: 'The Love Triangle';
$hero_intro = get_field('love_hero_intro');

/*
|--------------------------------------------------------------------------
| INTRO / STORY NOTE
|--------------------------------------------------------------------------
*/

$intro_heading = get_field('love_intro_heading');
$intro_text = get_field('love_intro_text');
$story_note = get_field('love_story_note');

/*
|--------------------------------------------------------------------------
| CHARACTER INTRODUCTIONS
|--------------------------------------------------------------------------
*/

$characters = [
    [
        'name'  => 'Ògún',
        'image' => get_field('love_ogun_image'),
        'text'  => get_field('love_ogun_text'),
        'class' => 'ogun',
    ],
    [
        'name'  => 'Ọ̀yá',
        'image' => get_field('love_oya_image'),
        'text'  => get_field('love_oya_text'),
        'class' => 'oya',
    ],
    [
        'name'  => 'Ṣàngó',
        'image' => get_field('love_sango_image'),
        'text'  => get_field('love_sango_text'),
        'class' => 'sango',
    ],
];

/*
|--------------------------------------------------------------------------
| CHAPTERS
|--------------------------------------------------------------------------
*/

$chapters = [];

for ($i = 1; $i <= 7; $i++) {

    $heading = get_field("love_chapter_{$i}_heading");
    $text    = get_field("love_chapter_{$i}_text");
    $image   = get_field("love_chapter_{$i}_image");

    if ($heading || $text || $image) {
        $chapters[] = [
            'number' => str_pad($i, 2, '0', STR_PAD_LEFT),
            'heading' => $heading,
            'text' => $text,
            'image' => $image,
        ];
    }
}

$beyond_heading = get_field('love_beyond_heading');
$beyond_text = get_field('love_beyond_text');

?>

<div class="love-page">

    <!-- =========================================================
         HERO
    ========================================================== -->

    <section class="love-hero">

        <?php if ($hero_image): ?>

            <div class="love-hero-media">

                <img
                    src="<?php echo esc_url($hero_image['url']); ?>"
                    alt=""
                    fetchpriority="high"
                >

            </div>

        <?php endif; ?>

        <div class="love-hero-overlay" aria-hidden="true"></div>

        <div class="love-hero-content">

            <span class="love-eyebrow">
                A Yoruba Myth Retold
            </span>

            <h1>
                <?php echo wp_kses_post($hero_heading); ?>
            </h1>

            <?php if ($hero_intro): ?>

                <p>
                    <?php echo wp_kses_post($hero_intro); ?>
                </p>

            <?php endif; ?>

            <a href="#love-story" class="love-start">
                Enter the story
                <span aria-hidden="true">↓</span>
            </a>

        </div>

    

    </section>


    <!-- =========================================================
         STORY INTRODUCTION
    ========================================================== -->

    <section class="love-intro" id="love-story">

        <div class="love-intro-inner">

            <div class="love-section-marker">
                <span>00</span>
                <small>Before the story</small>
            </div>

            <?php if ($intro_heading): ?>

                <h2>
                    <?php echo wp_kses_post($intro_heading); ?>
                </h2>

            <?php endif; ?>

            <?php if ($intro_text): ?>

                <div class="love-intro-text">
                    <?php echo wp_kses_post($intro_text); ?>
                </div>

            <?php endif; ?>


            <?php if ($story_note): ?>

                <aside class="love-story-note">

                    <span class="love-note-label">
                        A note on the story
                    </span>

                    <div>
                        <?php echo wp_kses_post($story_note); ?>
                    </div>

                </aside>

            <?php endif; ?>

        </div>

    </section>


    <!-- =========================================================
         THE THREE
    ========================================================== -->

    <section class="love-characters">

        <div class="love-characters-heading">

            <span>01</span>

            <div>
                <small>The three at the centre</small>

                <h2>
                    Iron. Storm. Thunder.
                </h2>
            </div>

        </div>


        <div class="love-character-grid">

            <?php foreach ($characters as $character): ?>

                <article class="love-character <?php echo esc_attr($character['class']); ?>">

                    <?php if ($character['image']): ?>

                        <div class="love-character-image">

                            <img
                                src="<?php echo esc_url($character['image']['url']); ?>"
                                alt="<?php echo esc_attr($character['name']); ?>"
                                loading="lazy"
                            >

                        </div>

                    <?php endif; ?>


                    <div class="love-character-content">

                        <span>
                            <?php echo esc_html($character['name']); ?>
                        </span>

                        <?php if ($character['text']): ?>

                            <div>
                                <?php echo wp_kses_post($character['text']); ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>


    <!-- =========================================================
         THE STORY
    ========================================================== -->

    <section class="love-chapters">

        <?php foreach ($chapters as $index => $chapter): ?>

            <?php
            $chapter_number = $index + 1;

            $chapter_class = 'love-chapter chapter-' . $chapter_number;

            if ($chapter_number % 2 === 0) {
                $chapter_class .= ' chapter-reverse';
            }

            /*
             * Chapter 3 is our major dramatic turning point.
             */
            if ($chapter_number === 3) {
                $chapter_class .= ' chapter-climax';
            }

            /*
             * Chapter 5 gets the darker treatment.
             */
            if ($chapter_number === 5) {
                $chapter_class .= ' chapter-betrayal';
            }

            /*
             * Chapter 7 becomes the ending.
             */
            if ($chapter_number === 7) {
                $chapter_class .= ' chapter-ending';
            }
            ?>

            <article class="<?php echo esc_attr($chapter_class); ?>">

                <div class="love-chapter-number" aria-hidden="true">
                    <?php echo esc_html($chapter['number']); ?>
                </div>


                <?php if ($chapter['image']): ?>

                    <div class="love-chapter-image">

                        <img
                            src="<?php echo esc_url($chapter['image']['url']); ?>"
                            alt=""
                            loading="lazy"
                        >

                    </div>

                <?php endif; ?>


                <div class="love-chapter-content">

                    <span class="love-chapter-label">
                        Chapter <?php echo esc_html($chapter['number']); ?>
                    </span>

                    <?php if ($chapter['heading']): ?>

                        <h2>
                            <?php echo wp_kses_post($chapter['heading']); ?>
                        </h2>

                    <?php endif; ?>


                    <?php if ($chapter['text']): ?>

                        <div class="love-chapter-text">
                            <?php echo wp_kses_post($chapter['text']); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </article>

        <?php endforeach; ?>

    </section>


    <!-- =========================================================
         BEYOND THE STORY
    ========================================================== -->

    <?php if ($beyond_heading || $beyond_text): ?>

        <section class="love-beyond">

            <div class="love-beyond-inner">

                <span class="love-beyond-label">
                    Beyond the story
                </span>

                <?php if ($beyond_heading): ?>

                    <h2>
                        <?php echo wp_kses_post($beyond_heading); ?>
                    </h2>

                <?php endif; ?>


                <?php if ($beyond_text): ?>

                    <div class="love-beyond-text">
                        <?php echo wp_kses_post($beyond_text); ?>
                    </div>

                <?php endif; ?>

            </div>

        </section>

    <?php endif; ?>


    <!-- =========================================================
         CLOSING
    ========================================================== -->

    <section class="love-closing">

        <div>

            <span>
                Iron. Thunder. Storm.
            </span>

            <p>
                The story may have many tellings.
                The storm still remembers.
            </p>

        </div>

    </section>

                </div>

<?php get_footer(); ?>