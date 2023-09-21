<?php

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() .'/style.css');
}

add_action('wp_enqueue_scripts','theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('planty-style', get_stylesheet_directory_uri() . 'css/style.css', array(), filemtime(get_stylesheet_directory() . 'css/style.css'));
}

add_action('after_setup_theme', 'theme_supports');
function theme_supports()
{
    add_theme_support('menus');
    register_nav_menu('header','En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

add_action('after_setup_theme', 'planty_supports');

function planty_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function planty_menu_link_class($attrs) 
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}
add_filter('nav_menu_css_class', 'planty_menu_class');
add_filter('nav_menu_link_attributes', 'planty_menu_link_class');


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
    echo 'Contenu de la page';
}

add_filter('nav_menu_meta_box_object', 'show_private_pages_menu_selection');

function show_private_pages_menu_selection($args) {
  if ($args->name == 'admin') {
    $args->_default_query['post_status'] = array('publish','private');
  }
  return $args;
}