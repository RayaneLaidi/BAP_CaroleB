<?php
wp_enqueue_style('style.css', get_stylesheet_uri());

// Activer le support pour le titre automatique
add_theme_support('title-tag');

// Activer le support pour les images à la une
add_theme_support('post-thumbnails');

// Enregistrer un menu principal
function streetarttheme_setup()
{
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'streetarttheme'),
    ));
}
add_action('after_setup_theme', 'streetarttheme_setup');

// Ajouter la colonne ID dans l'admin des pages
add_filter('manage_pages_columns', 'ajouter_colonne_id');
function ajouter_colonne_id($columns)
{
    $columns['id'] = 'ID';
    return $columns;
}

add_action('manage_pages_custom_column', 'remplir_colonne_id', 10, 2);
function remplir_colonne_id($column, $id)
{
    if ($column === 'id') {
        echo $id;
    }
}

function ajouter_mes_scripts()
{
    wp_enqueue_script(
        'script-burger',
        get_stylesheet_directory_uri() . '/js/sommaire.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'ajouter_mes_scripts');

// Custom Post Type Galerie
function streetarttheme_register_post_type_galerie()
{
    $labels = array(
        'name' => 'Galeries',
        'singular_name' => 'Galerie',
        'menu_name' => 'Galerie',
        'add_new' => 'Ajouter',
        'add_new_item' => 'Ajouter une nouvelle Galerie',
        'edit_item' => 'Modifier la Galerie',
        'all_items' => 'Toutes les Galeries',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'galerie'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );

    register_post_type('galerie', $args);
}
add_action('init', 'streetarttheme_register_post_type_galerie');

// Désactiver les styles WooCommerce par défaut
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Support WooCommerce
add_action('after_setup_theme', 'activer_woocommerce_support');
function activer_woocommerce_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

// Scripts WooCommerce
function charger_scripts_woocommerce()
{
    if (function_exists('is_woocommerce')) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('wc-add-to-cart');
        wp_enqueue_script('wc-cart-fragments');
    }
}
add_action('wp_enqueue_scripts', 'charger_scripts_woocommerce');

// Fragment panier
add_filter('woocommerce_add_to_cart_fragments', 'refresh_cart_fragment');
function refresh_cart_fragment($fragments)
{
    ob_start();
    ?>
    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();
    return $fragments;
}

// Colonnes et produits par page
add_filter('loop_shop_columns', function () {
    return 3;
});

add_filter('loop_shop_per_page', function () {
    return 9;
});

// FORCER LE TEMPLATE ARCHIVE-PRODUCT.PHP
add_filter('template_include', 'forcer_archive_product_template', 999);
function forcer_archive_product_template($template)
{
    if (is_shop() || is_product_taxonomy()) {
        $custom_template = get_stylesheet_directory() . '/woocommerce/archive-product.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}

// Icône panier
function ajouter_style_icone_panier()
{
    ?>
    <style>
        .product-actions .button::after,
        .add_to_cart_button::after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-left: 15px;
            background-image: url('<?php echo get_template_directory_uri(); ?>/asset/Vector.png');
            background-size: contain;
            background-repeat: no-repeat;
            vertical-align: middle;
        }
    </style>
    <?php
}
add_action('wp_head', 'ajouter_style_icone_panier');

// ... votre code existant ...

//FORÇAGE DES TEMPLATES WOOCOMMERCE - VERSION ROBUSTE
add_filter('woocommerce_locate_template', 'force_all_wc_templates_robuste', 9999, 3);
function force_all_wc_templates_robuste($template, $template_name, $template_path) {
    // Chemin absolu vers votre template personnalisé
    $custom_template = get_stylesheet_directory() . '/woocommerce/' . $template_name;
    
    // Log pour débogage (admin seulement)
    if (current_user_can('administrator') && is_cart()) {
        error_log('[WC TEMPLATE] Recherche: ' . $template_name);
        error_log('[WC TEMPLATE] Chemin custom: ' . $custom_template);
        error_log('[WC TEMPLATE] Existe: ' . (file_exists($custom_template) ? 'OUI' : 'NON'));
    }
    
    // Si le template personnalisé existe, l'utiliser
    if (file_exists($custom_template)) {
        return $custom_template;
    }
    
    return $template;
}

// FILTRE SPÉCIFIQUE POUR LE TEMPLATE CART
add_filter('wc_get_template', 'force_specific_cart_template', 10, 5);
function force_specific_cart_template($located, $template_name, $args, $template_path, $default_path) {
    // Cibler spécifiquement le template du panier
    if ($template_name === 'cart/cart.php') {
        $custom_cart = get_stylesheet_directory() . '/woocommerce/cart/cart.php';
        
        // Log de débogage
        if (current_user_can('administrator')) {
            error_log('[CART TEMPLATE] Template demandé: cart/cart.php');
            error_log('[CART TEMPLATE] Custom path: ' . $custom_cart);
            error_log('[CART TEMPLATE] File exists: ' . (file_exists($custom_cart) ? 'YES' : 'NO'));
        }
        
        if (file_exists($custom_cart)) {
            return $custom_cart;
        }
    }
    
    return $located;
}

// FORÇAGE PAR TEMPLATE_INCLUDE (méthode alternative)
add_filter('template_include', 'force_cart_via_template_include', 9999);
function force_cart_via_template_include($template) {
    if (is_cart()) {
        $custom_cart = get_stylesheet_directory() . '/woocommerce/cart/cart.php';
        
        // Afficher un message d'admin pour vérifier
        if (current_user_can('administrator') && !file_exists($custom_cart)) {
            wp_die('ERREUR: Le fichier cart.php personnalisé n\'existe pas à cet emplacement: ' . $custom_cart);
        }
        
        if (file_exists($custom_cart)) {
            return $custom_cart;
        }
    }
    return $template;
}

////// //// ==========================================================
// SOLUTION COMPLÈTE POUR CHECKOUT
// ==========================================================

/**
 * Force l'utilisation du template checkout personnalisé
 * Version corrigée qui préserve les variables WooCommerce
 */
add_filter('template_include', 'forcer_checkout_avec_variables', 99999);
function forcer_checkout_avec_variables($template) {
    
    // Vérifie si c'est la page checkout (sans page de remerciement)
    if (function_exists('is_checkout') && is_checkout() && !is_order_received_page()) {
        
        $checkout_template = get_stylesheet_directory() . '/woocommerce/checkout/form-checkout.php';
        
        // Vérifie que le fichier existe
        if (file_exists($checkout_template)) {
            
            // IMPORTANT: Assure que WooCommerce est chargé
            if (!class_exists('WooCommerce')) {
                return $template;
            }
            
            // S'assure que l'objet $checkout est disponible
            global $wp;
            
            // Définit la variable $checkout si elle n'existe pas
            if (!isset($checkout)) {
                $checkout = WC()->checkout();
            }
            
            // Retourne le template personnalisé
            return $checkout_template;
        }
    }
    
    return $template;
}

/**
 * Version alternative utilisant woocommerce_locate_template
 * (Moins invasive, plus sûre)
 */
add_filter('woocommerce_locate_template', 'forcer_checkout_wc', 99999, 3);
function forcer_checkout_wc($template, $template_name, $template_path) {
    
    // Cible uniquement le template checkout principal
    if ($template_name === 'checkout/form-checkout.php') {
        $custom_template = get_stylesheet_directory() . '/woocommerce/checkout/form-checkout.php';
        
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    
    return $template;
}