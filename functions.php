<?php

// Enable featured images for posts and custom post types.
add_theme_support('post-thumbnails');


// ============================================================
// GODS
// Registers the "Gods" custom post type.
// ============================================================

function register_gods()
{
    register_post_type('god', [

        'labels' => [
            'name' => 'Gods',
            'singular_name' => 'God',
            'add_new' => 'Add New God',
            'add_new_item' => 'Add New God',
            'edit_item' => 'Edit God',
            'view_item' => 'View God',
        ],

        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'gods'],

        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ],

        'menu_icon' => 'dashicons-groups',
        'show_in_rest' => true,
    ]);
}

add_action('init', 'register_gods');


// ============================================================
// STORIES
// Registers the "Stories" custom post type.
// ============================================================

function register_stories()
{
    register_post_type('story', [

        'labels' => [
            'name' => 'Stories',
            'singular_name' => 'Story',
            'add_new' => 'Add New Story',
            'add_new_item' => 'Add New Story',
            'edit_item' => 'Edit Story',
            'view_item' => 'View Story',
        ],

        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'stories'],

        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ],

        'menu_icon' => 'dashicons-book',
        'show_in_rest' => true,
    ]);
}

add_action('init', 'register_stories');


// ============================================================
// NAVIGATION
// Registers the primary WordPress navigation menu.
// ============================================================

function register_my_menus()
{
    register_nav_menus([
        'primary' => 'Primary Menu'
    ]);
}

add_action('init', 'register_my_menus');


// ============================================================
// STYLES & SCRIPTS
// Loads the main theme stylesheet and JavaScript.
// ============================================================

function load_my_theme_styles()
{
    wp_enqueue_style(
        'my-main-style',
        get_stylesheet_uri(),
        [],
        '1.0'
    );

    // Main theme JavaScript.
    wp_enqueue_script(
        'my-main-script',
        get_template_directory_uri() . '/js/main.js',
        [],
        '1.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'load_my_theme_styles');


// ============================================================
// LOVE STORY IMAGES
// Returns the requested ACF image size, with the original
// image used as a fallback.
// ============================================================

function love_img($image, $size = 'large')
{
    if (!is_array($image)) {
        return '';
    }

    if (!empty($image['sizes'][$size])) {
        return $image['sizes'][$size];
    }

    return $image['url'];
}


// Generates a responsive srcset for an ACF image.
function love_img_set($image)
{
    if (!is_array($image) || empty($image['ID'])) {
        return '';
    }

    return wp_get_attachment_image_srcset($image['ID'], 'large') ?: '';
}


// ============================================================
// CUSTOM IMAGE SIZES
// Creates image crops/sizes used by the love story pages.
// ============================================================

add_action('after_setup_theme', function () {

    add_image_size('love-card', 500, 500, true);
    add_image_size('love-hero', 1600, 900, true);

    add_image_size('love-archive-card', 950, 540, true);
    add_image_size('love-archive-card-small', 640, 364, true);
});


// ============================================================
// META DESCRIPTION
// Generates a page-specific SEO meta description.
// ============================================================

/**
 * Global Metadata Engine Manager
 * Automatically injects pristine, high-performing SEO descriptions into the head element.
 */
add_action('wp_head', function () {
    $description = '';

    if (is_front_page()) {
        $description = 'Explore Ìtàn Òrìṣà, a digital library of Yoruba folklore. Discover the gods, their powers, stories, and the ways Yoruba mythology continues to influence culture today.';
    } elseif (is_singular('god')) {

        $description = get_field('god_tagline')
            ?: (get_the_title() . ' — Discover the sacred symbols, legends, and cosmic role of this powerful Orisha deity in Yoruba folklore.');
    } elseif (is_singular('story')) {
        $description = get_the_excerpt() ?: wp_trim_words(get_the_content(), 28);
    } elseif (is_page('cultural-context')) {
        $description = 'Uncover the history, oral traditions, and influence behind the Yoruba gods. Trace the sacred roots of Yoruba culture from ancient origins to modern day.';
    } elseif (is_singular()) {
        $description = get_the_excerpt() ?: get_bloginfo('description');
    } else {
        $description = get_bloginfo('description');
    }

    $description = wp_strip_all_tags($description);
    $description = trim(preg_replace('/\s+/', ' ', $description));

    if (mb_strlen($description) > 155) {
        $description = mb_substr($description, 0, 152) . '...';
    }

    if ($description) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}, 1);



// ============================================================
// HTML5 IMAGE CLEANUP
// Removes XHTML-style self-closing slashes from image markup.
// ============================================================

function itan_orisa_html5_image_cleanup($html)
{
    return str_replace(' />', '>', $html);
}

add_filter('wp_get_attachment_image_attributes', function ($attr) {
    return $attr;
});

add_filter(
    'the_post_thumbnail_html',
    'itan_orisa_html5_image_cleanup',
    10,
    1
);

add_filter(
    'wp_get_attachment_image',
    'itan_orisa_html5_image_cleanup',
    10,
    1
);

/**
 * Fixes LiteSpeed Cache / WordPress sizes="auto" validation errors 
 * by dropping empty or malformed size attributes from single imagery.
 */
function itan_orisa_sanitize_image_sizes_attribute($html)
{
    if (false === strpos($html, 'srcset=')) {
        $html = preg_replace('/\s+sizes=["\'][^"\']*["\']/i', '', $html);
    }

    $html = str_replace('sizes="auto, "', '', $html);
    $html = str_replace('sizes="auto,"', '', $html);

    return $html;
}
add_filter('the_post_thumbnail_html', 'itan_orisa_sanitize_image_sizes_attribute', 99, 1);


// ============================================================
// HTML5 BUFFER CLEANUP
// Removes self-closing slashes from common HTML elements
// in the final frontend output.
// ============================================================

function itan_orisa_html5_buffer_cleanup($buffer)
{
    $pattern = '/<(img|input|br|hr|meta|link)([^>]*?)\s+\/>/i';
    $replace = '<$1$2>';

    return preg_replace($pattern, $replace, $buffer);
}


// Start output buffering on the frontend.
function itan_orisa_start_html_buffer()
{
    if (!is_admin()) {
        ob_start('itan_orisa_html5_buffer_cleanup');
    }
}

add_action('wp_loaded', 'itan_orisa_start_html_buffer');


// Source - https://stackoverflow.com/a/32824599
// Posted by rnevius
// Retrieved 2026-09-05, License - CC BY-SA 3.0

function wptuts_scripts_with_jquery() {
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_with_jquery' );
