<?php

add_theme_support('post-thumbnails');
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



function register_my_menus()
{
    register_nav_menus([
        'primary' => 'Primary Menu'
    ]);
}
add_action('init', 'register_my_menus');



function load_my_theme_styles()
{

    wp_enqueue_style(
        'my-main-style',
        get_stylesheet_uri(),
        [],
        '1.0'
    );
}

add_action('wp_enqueue_scripts', 'load_my_theme_styles');


function love_img($image, $size = 'large')
{
    if (!is_array($image))
        return '';
    if (!empty($image['sizes'][$size])) {
        return $image['sizes'][$size];
    }
    return $image['url'];
}


function love_img_set($image)
{
    if (!is_array($image) || empty($image['ID']))
        return '';
    return wp_get_attachment_image_srcset($image['ID'], 'large') ?: '';
}


add_action('after_setup_theme', function () {
    add_image_size('love-card', 500, 500, true);
    add_image_size('love-hero', 1600, 900, true);
});





add_action('after_setup_theme', function () {
    add_action('after_setup_theme', function () {

        add_image_size('love-archive-card', 950, 540, true);
        add_image_size('love-archive-card-small', 640, 364, true);
    });
});


// meta description code bloc

add_action('wp_head', function () {

    $description = '';

    if (is_front_page()) {
        $description = 'Itan Orisa Discover the gods of Yoruba mythology, their stories, symbols, powers, and the myths still told today.';

    } elseif (is_singular('god')) {

        $description = get_field('god_summary')
            ?: (get_the_title() . ' — ' . get_field('god_tagline'));

    } elseif (is_singular('story')) {

        $description = get_the_excerpt() ?: wp_trim_words(get_the_content(), 30);

    } elseif (is_page('cultural-context')) {
        $description = 'Explore the history, oral traditions, and living culture behind Yoruba mythology and the Orisha.';

    } elseif (is_singular()) {
        $description = get_the_excerpt() ?: get_bloginfo('description');

    } else {
        $description = get_bloginfo('description');
    }
    $description = wp_strip_all_tags($description);
    $description = trim(preg_replace('/\s+/', ' ', $description));
    if (mb_strlen($description) > 160) {
        $description = mb_substr($description, 0, 157) . '...';
    }

    if ($description) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }

}, 1);



function itan_orisa_html5_image_cleanup($html)
{
    return str_replace(' />', '>', $html);
}
add_filter('wp_get_attachment_image_attributes', function ($attr) {
    return $attr; });
add_filter('the_post_thumbnail_html', 'itan_orisa_html5_image_cleanup', 10, 1);
add_filter('wp_get_attachment_image', 'itan_orisa_html5_image_cleanup', 10, 1);




function itan_orisa_html5_buffer_cleanup( $buffer ) {
    $pattern = '/<(img|input|br|hr|meta|link)([^>]*?)\s+\/>/i';
    $replace = '<$1$2>';
    
    return preg_replace( $pattern, $replace, $buffer );
}

function itan_orisa_start_html_buffer() {
    if ( ! is_admin() ) {
        ob_start( 'itan_orisa_html5_buffer_cleanup' );
    }
}
add_action( 'wp_loaded', 'itan_orisa_start_html_buffer' );
function iton_orisa_scripts() {

    wp_enqueue_script(
        'iton-orisa-navigation',
        get_template_directory_uri() . '/js/love-story.js',
        [],
        '1.0',
        true
    );

}

add_action('wp_enqueue_scripts', 'iton_orisa_scripts');