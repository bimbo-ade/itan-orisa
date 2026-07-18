<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>

<body <?php body_class(); ?>>
    <nav class="main-nav">
        <div class="nav-container">
            <div class="logo">
                <a href="<?php echo home_url(); ?>">Itan Orisa</a>
            </div>

            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => false
                ]);
            } else {
                echo '<ul class="nav-menu">';
                echo '<li><a href="' . home_url() . '">Home</a></li>';
                echo '<li><a href="' . get_post_type_archive_link('god') . '">Gods</a></li>';
                echo '<li><a href="' . get_post_type_archive_link('story') . '">Stories</a></li>';
                echo '<li><a href="' . home_url('/cultural-context') . '">Cultural Context</a></li>';
                echo '<li><a href="' . home_url('/about') . '">About</a></li>';
                echo '</ul>';
            }
            ?>
        </div>
    </nav>

    <main>