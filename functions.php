<?php

add_theme_support('post-thumbnails');
function register_gods() {
    
     register_post_type('god', [
        
        'labels' => [
            'name'          => 'Gods',        
            'singular_name' => 'God',       
            'add_new'       => 'Add New God',
            'add_new_item'  => 'Add New God', 
            'edit_item'     => 'Edit God',   
            'view_item'     => 'View God',   
        ],
                'public' => true,
        
        'has_archive' => true,
         'rewrite' => ['slug' => 'gods'],
        
        'supports' => [
            'title',   
            'editor',   
            'thumbnail','excerpt' 
        ],
        
        'menu_icon' => 'dashicons-groups', 
        
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
        'rewrite' => ['slug' => 'stories'], 
   'supports' => [
            'title',    
            'editor',  
            'thumbnail','excerpt' 
        ],        'menu_icon' => 'dashicons-book', 
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
        'my-main-style',                 
        get_stylesheet_uri(),              
        [],                                
        '1.0'                             
    );
}

add_action('wp_enqueue_scripts', 'load_my_theme_styles');