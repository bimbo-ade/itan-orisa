<?php
/**
 * archive-god.php

 */

get_header();

function itan_god_colour($slug)
{
    $map = [
        'sango' => '#D32F2F',
        'ogun' => '#2E7D32',
        'oya' => '#6A1B9A',
    ];
    return $map[$slug] ?? '#f5c842';
}
?>

<div class="gods-page">

    <section class="gods-hero">
        <div aria-hidden="true"></div>
        <div>
            <span>The Pantheon</span>
            <h1>The Gods of Yoruba</h1>
            <p>Meet the Orishas &#8212; divine forces of thunder, iron, and transformation.</p>
        </div>
    </section>

    <div class="gods-grid">

        <?php if (have_posts()): ?>

            <?php while (have_posts()):
                the_post();
                $slug = get_post_field('post_name', get_the_ID());
                $colour = itan_god_colour($slug);
                ?>

                <article style="--gc:<?php echo esc_attr($colour); ?>;">

                    <?php if (has_post_thumbnail()): ?>
                        <div>
                            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div>
                        

                        <h2>
                            <?php the_title_attribute(); ?>
                            
                        </h2>

                        <div>
                            <?php the_excerpt(); ?>
                        </div>
                    </div>

                </article>

            <?php endwhile; ?>

        <?php else: ?>
            <p>No gods found. Create your first Orisha in the WordPress admin.</p>
        <?php endif; ?>

    </div>

</div>

<?php get_footer(); ?>