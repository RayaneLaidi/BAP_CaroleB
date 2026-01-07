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

// Ajouter la colonne ID dans l'admin des pages
add_filter('manage_pages_columns', 'ajouter_colonne_id');
function ajouter_colonne_id($columns) {
    $columns['id'] = 'ID';
    return $columns;
}

add_action('manage_pages_custom_column', 'remplir_colonne_id', 10, 2);
function remplir_colonne_id($column, $id) {
    if ($column === 'id') {
        echo $id;
    }
}

function ajouter_mes_scripts() {
    // Chargement du script sommaire/burger
    wp_enqueue_script(
        'script-burger', 
        get_stylesheet_directory_uri() . '/js/sommaire.js', 
        array(), 
        '1.0', 
        true
    );

}

// Pour les utilisateurs connectés
add_action('admin_post_mon_formulaire_contact', 'traiter_mon_formulaire');
// Pour les visiteurs (non connectés)
add_action('admin_post_nopriv_mon_formulaire_contact', 'traiter_mon_formulaire');

function traiter_mon_formulaire() {
    // 1. Vérifier les données (Sécurité)
    if (isset($_POST['nom']) && isset($_POST['email'])) {
        $nom = sanitize_text_field($_POST['nom']);
        $email = sanitize_email($_POST['email']);

        // 2. Faire quelque chose (envoyer un mail par exemple)
        $to = get_option('admin_email');
        $subject = 'Nouveau message de ' . $nom;
        $body = 'L\'utilisateur ' . $nom . ' vous a contacté.';
        
        wp_mail($to, $subject, $body);
    }

    // 3. Rediriger l'utilisateur après l'envoi
    wp_redirect( home_url('/merci') );
    exit;
}

function mytheme_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mytheme_post_thumbnails' );