<?php get_header(); ?>

<div class="stories-archive-hero">
    <h1>Stories of the Gods</h1>
    <p>Ancient tales of power, love, betrayal, and transformation.</p>
</div>

<div class="stories-grid">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        
            <article class="story-card">
                <div class="story-card-content">
                    <h2><?php the_title(); ?></h2>
                    <div class="story-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="story-card-button">
                        Read the Story →
                    </a>
                </div>
            </article>
            
        <?php endwhile; ?>
    <?php else : ?>
        <p>No stories found. Create your first story in WordPress admin.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>