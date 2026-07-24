<?php
/**
 * archive-story.php
 * Archive template for the 'story' custom post type.

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
        <div aria-hidden="true"></div>
        <div>
            <span>The Stories</span>
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

                <article>

                    <?php if (has_post_thumbnail()): ?>
                        <div>
                            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div>
                        <small>Story</small>

                        <h2>
                            <a href="<?php the_permalink(); ?>" aria-label="Read <?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div>
                            <?php the_excerpt(); ?>
                        </div>

                        <?php if ($god_tags): ?>
                            <ul>
                                <?php foreach ($god_tags as $tag): ?>
                                    <li style="--cp:<?php echo esc_attr(itan_tag_colour($tag->slug)); ?>;">
                                        <span aria-hidden="true"></span>
                                        <?php echo esc_html(ucfirst($tag->name)); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" aria-label="Read <?php the_title_attribute(); ?>">
                            Read the Story &rarr;
                        </a>
                    </div>

                </article>

            <?php endwhile; ?>

        <?php else: ?>
            <p>No stories found. Create your first story in the WordPress admin.</p>
        <?php endif; ?>

    </div>

</div>

<?php get_footer(); ?>