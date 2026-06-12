<?php get_header(); ?>

<div class="gods-archive-hero">
    <h1>The Gods of Yoruba Mythology</h1>
    <p>Meet the powerful deities who shape the world with thunder, iron, and storms.</p>
</div>

<div class="gods-grid">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        
            <article class="god-card">
                <div class="god-card-inner">
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="god-card-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="god-card-content">
                        <h2><?php the_title(); ?></h2>
                        
                        <div class="god-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="god-card-button">
                            Read the Story →
                        </a>
                    </div>
                    
                </div>
            </article>
            
        <?php endwhile; ?>
    <?php else : ?>
        <p>No gods found. Create your first god in WordPress admin.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>