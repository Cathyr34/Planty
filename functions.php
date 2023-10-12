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


add_action('admin_menu', 'ajouter_page_admin');

function ajouter_page_admin() {
    add_menu_page(
        'Admin', // Le titre de la page
        'Planty haut', // Le nom du menu
        'manage_options', // La capacité requise pour voir cette page (par exemple, 'manage_options' pour les administrateurs)
        'admin', // Un slug unique pour cette page
        'afficher_contenu_page' // La fonction qui affiche le contenu de la page
    );
}

function afficher_contenu_page() {
    if ( is_user_logged_in() ) {
        echo 'Contenu de la page';
    } else {
        echo 'Veuillez vous connecter pour voir le contenu de cette page.';
    }
}

add_filter('nav_menu_meta_box_object', 'show_private_pages_menu_selection');

function show_private_pages_menu_selection($args) {
  if ($args->name == 'admin') {
    $args->_default_query['post_status'] = array('publish','private');
  }
  return $args;
}


