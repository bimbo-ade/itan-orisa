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
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <nav class="main-nav">

        <div class="nav-container">
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <svg class="logo-mark" width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true">
                        <path d="M14 3 L20 9 C20 9 17 10 14 13 C11 10 8 9 8 9 Z" fill="currentColor" opacity="0.9" />
                        <path d="M14 13 L15 18 L12 18 L14 25 L13 19 L16 19 Z" fill="currentColor" />
                    </svg>
                    <span class="logo-word">Ìtàn Òrìṣà</span>
                </a>
            </div>

            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-label" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </label>

            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'fallback_cb' => false,
                ]);
            } else {
                echo '<ul>';
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

    <main id="main-content">