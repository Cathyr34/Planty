<?php

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() .'/style.css');
}

add_action('after_setup_theme', 'theme_supports');
function theme_supports()
{
    add_theme_support('menus');
    register_nav_menu('header','En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

add_action('after_setup_theme', 'theme_supports');

function theme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function theme_menu_link_class($attrs) 
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}
add_filter('nav_menu_css_class', 'theme_menu_class');
add_filter('nav_menu_link_attributes', 'theme_menu_link_class');

function custom_menu_items($items, $args) {
    if (is_user_logged_in() && $args->theme_location == 'header') {
        
        $admin_link = '<li class="menu-item"><a href="' . admin_url() . '">Admin</a></li>';
        $items = $items . $admin_link;
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'custom_menu_items', 10, 2);



