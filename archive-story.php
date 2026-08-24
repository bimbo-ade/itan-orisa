<?php
/**
 * archive-story.php

 */

get_header();

function itan_tag_colour($slug)
{
    $map = [
        'sango' => '#D32F2F',
        'ogun' => '#2E7D32',
        'oya' => '#6A1B9A',
    ];
    return $map[$slug] ?? '#f5c842';
}
?>

<div class="stories-page">

    <section class="stories-hero">
        <div>
            <p>The Stories</p>
            <h1>Stories of the Gods</h1>
            <p>Ancient tales of power, love, betrayal, and transformation.</p>
        </div>
    </section>

    <div class="stories-grid">

        <?php if (have_posts()): ?>

            <?php while (have_posts()):
                the_post();
                $tags = get_the_tags();
                $god_slugs = ['sango', 'oya', 'ogun'];
                $god_tags = $tags ? array_filter($tags, function ($t) use ($god_slugs) {
                    return in_array($t->slug, $god_slugs, true);
                }) : [];
                ?>

                <a href="<?php the_permalink(); ?>" class="story-card">

                    <?php if (has_post_thumbnail()): ?>
                        <?php
                        $thumb_id = get_post_thumbnail_id();
                        $stored_alt = $thumb_id ? get_post_meta($thumb_id, '_wp_attachment_image_alt', true) : '';
                        $alt = $stored_alt ?: get_the_title();
                        $has_srcset = wp_get_attachment_image_srcset($thumb_id, 'love-archive-card');

                        the_post_thumbnail('love-archive-card', [
                            'loading' => 'lazy',
                            'alt' => $alt,
                            'decoding' => 'async',
                            'sizes' => $has_srcset ? '(max-width: 40em) 100vw, (max-width: 64em) 50vw, 400px' : false,
                        ]);
                        ?>

                    <?php endif; ?>

                    <div>

                        <h2>
                            <?php the_title(); ?>
                        </h2>

                        <div>
                            <?php the_excerpt(); ?>
                        </div>



                    </div>

                </a>

            <?php endwhile; ?>

        <?php else: ?>
            <p>No stories found. Create your first story in the WordPress admin.</p>
        <?php endif; ?>

    </div>

</div>

<?php get_footer(); ?>