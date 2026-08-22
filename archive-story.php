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
                        <div>
                            <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                        </div>
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