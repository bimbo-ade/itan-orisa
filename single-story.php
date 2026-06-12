<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<div class="story-hero">
    <h1><?php the_title(); ?></h1>
</div>

<div class="story-content-container">
    <div class="story-content">
        <?php the_content(); ?>
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>