<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicons/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/favicons/favicon.ico">
    <meta name="google-site-verification" content="EugkmQ__TA59fEUOHFkPHLb_f8coXS1VWmID11Ghzkg" />
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="skip-link" href="#main-content">Skip to main content</a>

    <nav class="main-nav">

        <div class="nav-container">
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <span class="logo-word">Ìtàn <em> Òrìṣà</em> </span>
                </a>
            </div>

            <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Toggle main navigation menu">
            <label for="nav-toggle" class="nav-toggle-label">
                <span></span><span></span><span></span>
            </label>

            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'fallback_cb' => false,
                ]);
            }
            ?>
        </div>

    </nav>

    <main id="main-content">