<?php
wp_enqueue_style('style.css', get_stylesheet_uri());
/*
/Charger le CSS du thème
function streetarttheme_enqueue_styles() {
    
}
add_action('wp_enqueue_scripts', 'streetarttheme_enqueue_styles');
*/
// Activer le support pour le titre automatique
add_theme_support('title-tag');

// Activer le support pour les images à la une
add_theme_support('post-thumbnails');

// Enregistrer un menu principal
function streetarttheme_setup() {
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'streetarttheme'),
    ));
}
add_action('after_setup_theme', 'streetarttheme_setup');




 
?>
