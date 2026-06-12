<?php

add_theme_support('post-thumbnails');
function register_gods() {
    
     register_post_type('god', [
        
        'labels' => [
            'name'          => 'Gods',        // "Gods" in the menu
            'singular_name' => 'God',         // "God" when talking about one
            'add_new'       => 'Add New God', // Button text
            'add_new_item'  => 'Add New God', // Page title
            'edit_item'     => 'Edit God',    // Edit screen title
            'view_item'     => 'View God',    // View button text
        ],
        
        // 'public' - Can regular visitors see it? True = yes
        'public' => true,
        
        'has_archive' => true,
         'rewrite' => ['slug' => 'gods'],
        
        'supports' => [
            'title',    // The title field (required)
            'editor',   // The big text box for writing content
            'thumbnail','excerpt' // Featured image box
        ],
        
        'menu_icon' => 'dashicons-groups', // Groups icon (people together)
        
        'show_in_rest' => true,
    ]);
}
add_action('init', 'register_gods');



function register_stories() {
    
    register_post_type('story', [
        
        'labels' => [
            'name'          => 'Stories',
            'singular_name' => 'Story',
            'add_new'       => 'Add New Story',
            'add_new_item'  => 'Add New Story',
            'edit_item'     => 'Edit Story',
            'view_item'     => 'View Story',
        ],
        
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'stories'],  // yoursite.com/stories/
   'supports' => [
            'title',    // The title field (required)
            'editor',   // The big text box for writing content
            'thumbnail','excerpt' // Featured image box
        ],        'menu_icon' => 'dashicons-book',     // Book icon
        'show_in_rest' => true,
    ]);
}

add_action('init', 'register_stories');



function register_my_menus() {
    register_nav_menus([
        'primary' => 'Primary Menu'  
    ]);
}
add_action('init', 'register_my_menus');



function load_my_theme_styles() {
    
    wp_enqueue_style(
        'my-main-style',                    // Name (can be anything)
        get_stylesheet_uri(),               // Automatically finds style.css
        [],                                 // No dependencies
        '1.0'                               // Version number
    );
}

add_action('wp_enqueue_scripts', 'load_my_theme_styles');