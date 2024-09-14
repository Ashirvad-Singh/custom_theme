<?php
// Function to set up the theme
function mytheme_setup() {
    // Register menu locations
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', 'mytheme'),  // Registering the main menu
            // You can add additional menu locations here
        )
    );

    // Add support for post thumbnails (featured images)
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_post_type_support('page','excerpt');
}

function register_news_post_type() {
    $labels = array(
        'name'               => 'News',
        'singular_name'      => 'News',
        'menu_name'          => 'News',
        'name_admin_bar'     => 'News',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New News',
        'new_item'           => 'New News',
        'edit_item'          => 'Edit News',
        'view_item'          => 'View News',
        'all_items'          => 'All News',
        'search_items'       => 'Search News',
        'not_found'          => 'No news found.',
        'not_found_in_trash' => 'No news found in Trash.'
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'news'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
    );
    
    register_post_type('news', $args);
}

add_action('init', 'register_news_post_type');

register_sidebar(
    array(
        'name'          => 'Sidebar Location',
        'id'            => 'sidebar'

    )
    );
function my_theme_enqueue_scripts() {
    $theme_uri = get_template_directory_uri(); // Get theme directory URI

    // Enqueue wow.js before main.js
    // wp_enqueue_script(
    //     'wow-script', // Unique handle for wow.js
    //     $theme_uri . '/assets/js/wow.js', // Correct path
    //     array(), // No dependencies
    //     null, // Version (or use theme version)
    //     true // Load in the footer
    // );

    // Enqueue your main.js
    wp_enqueue_script(
        'main-script', // Unique handle for main.js
        $theme_uri . '/assets/js/main.js', // Correct path
        array('wow-script'), // Specify wow.js as a dependency
        null, // Version
        true // Load in the footer
    );
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts'); // Ensure correct hook




// Attach the function to the 'after_setup_theme' hook
add_action('after_setup_theme', 'mytheme_setup');
?>
