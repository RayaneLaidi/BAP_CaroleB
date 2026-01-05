<?php
/**
 * Functions.php optimisé pour WooCommerce
 * Version personnalisée pour structure assets/css/
 */

// 1. SETUP DU THÈME
add_action('after_setup_theme', 'mon_theme_setup');
function mon_theme_setup()
{
    // Support WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Support WordPress
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Support HTML5
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
}

// 2. CHARGEMENT DES SCRIPTS ET STYLES (SANS DOUBLONS)
add_action('wp_enqueue_scripts', 'mon_theme_scripts_styles', 10);
function mon_theme_scripts_styles()
{
    // Style principal
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), '1.0');

    // Désactiver les styles WooCommerce par défaut
    if (class_exists('WooCommerce')) {
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-smallscreen');
        wp_dequeue_style('select2');

        // Charger woocommerce.css personnalisé depuis assets
        $woocommerce_css = get_stylesheet_directory() . '/assets/css/woocommerce.css';
        if (file_exists($woocommerce_css)) {
            wp_enqueue_style(
                'theme-woocommerce',
                get_stylesheet_directory_uri() . '/assets/css/woocommerce.css',
                array('theme-style'),
                filemtime($woocommerce_css)
            );
        } else {
            // Fallback à la racine si pas dans assets
            $woocommerce_css_root = get_stylesheet_directory() . '/woocommerce.css';
            if (file_exists($woocommerce_css_root)) {
                wp_enqueue_style(
                    'theme-woocommerce',
                    get_stylesheet_directory_uri() . '/woocommerce.css',
                    array('theme-style'),
                    filemtime($woocommerce_css_root)
                );
            }
        }
    }
}

// 3. CSS SPÉCIFIQUE AU PANIER
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_cart_styles', 20);
function mon_theme_enqueue_cart_styles()
{
    if (function_exists('is_cart') && is_cart()) {
        // Chercher cart.css dans assets/css/
        $cart_css_assets = get_stylesheet_directory() . '/assets/css/cart.css';
        $cart_css_root = get_stylesheet_directory() . '/cart.css';

        if (file_exists($cart_css_assets)) {
            wp_enqueue_style(
                'theme-cart',
                get_stylesheet_directory_uri() . '/assets/css/cart.css',
                array('theme-style', 'theme-woocommerce'),
                filemtime($cart_css_assets)
            );
        } elseif (file_exists($cart_css_root)) {
            wp_enqueue_style(
                'theme-cart',
                get_stylesheet_directory_uri() . '/cart.css',
                array('theme-style', 'theme-woocommerce'),
                filemtime($cart_css_root)
            );
        }
    }
}

// 4. CSS SPÉCIFIQUE AU CHECKOUT - VERSION CORRIGÉE
add_action('wp_enqueue_scripts', 'caroleb_enqueue_checkout_styles', 30);
function caroleb_enqueue_checkout_styles()
{
    // Charger seulement sur les pages checkout
    if (function_exists('is_checkout') && is_checkout()) {
        
        // Priorité 1 : assets/css/checkout.css
        $css_file = get_stylesheet_directory() . '/assets/css/checkout.css';
        
        // Priorité 2 : checkout.css à la racine (fallback)
        if (!file_exists($css_file)) {
            $css_file = get_stylesheet_directory() . '/checkout.css';
        }
        
        // Si le fichier existe, le charger
        if (file_exists($css_file)) {
            $css_url = str_replace(
                get_stylesheet_directory(),
                get_stylesheet_directory_uri(),
                $css_file
            );
            
            wp_enqueue_style(
                'caroleb-checkout',
                $css_url,
                array('theme-style', 'theme-woocommerce'), // Dépendances importantes
                filemtime($css_file)
            );
        }
    }
}

// 5. FONCTION UNIFIÉE POUR FORCER LES TEMPLATES WOOCOMMERCE
add_filter('wc_get_template', 'caroleb_custom_wc_templates', 999, 5);
function caroleb_custom_wc_templates($located, $template_name, $args, $template_path, $default_path)
{
    // Templates cart à surcharger
    $cart_templates = array(
        'cart/cart.php',
        'cart/cart-empty.php',
        'cart/cart-totals.php',
        'cart/cart-shipping.php',
        'cart/cart-discount.php'
    );

    // Templates checkout à surcharger
    $checkout_templates = array(
        'checkout/form-checkout.php',
        'checkout/review-order.php',
        'checkout/payment.php',
        'checkout/form-billing.php',
        'checkout/form-shipping.php'
    );

    // Vérifier si c'est un template à surcharger
    if (in_array($template_name, $cart_templates) || in_array($template_name, $checkout_templates)) {
        $candidates = array(
            // 1. Child theme / woocommerce / template
            get_stylesheet_directory() . '/woocommerce/' . $template_name,
            // 2. Parent theme / woocommerce / template
            get_template_directory() . '/woocommerce/' . $template_name,
        );

        foreach ($candidates as $theme_template) {
            if (file_exists($theme_template)) {
                return $theme_template;
            }
        }
    }

    return $located;
}

// 6. FRANCE PAR DÉFAUT (OPTIMISÉ)
add_filter('default_checkout_billing_country', 'caroleb_default_country');
add_filter('default_checkout_shipping_country', 'caroleb_default_country');
function caroleb_default_country()
{
    return 'FR';
}

// 7. WIDGETS
add_action('widgets_init', 'mon_theme_widgets');
function mon_theme_widgets()
{
    register_sidebar(array(
        'name' => 'Sidebar Principale',
        'id' => 'sidebar-1',
        'description' => 'Widgets pour la sidebar principale',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Sidebar WooCommerce',
        'id' => 'sidebar-woocommerce',
        'description' => 'Widgets spécifiques à WooCommerce',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

// 8. FONCTION POUR AFFICHER LES PRODUITS
function afficher_produits_woocommerce($atts = array())
{
    if (!class_exists('WooCommerce')) {
        return '';
    }

    $defaults = array(
        'limit' => 12,
        'columns' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $atts = shortcode_atts($defaults, $atts, 'produits_woocommerce');

    ob_start();
    echo do_shortcode('[products limit="' . $atts['limit'] . '" columns="' . $atts['columns'] . '" orderby="' . $atts['orderby'] . '" order="' . $atts['order'] . '"]');
    return ob_get_clean();
}
add_shortcode('produits_woocommerce', 'afficher_produits_woocommerce');

// 9. OPTIMISATIONS WOOCOMMERCE SUPPLEMENTAIRES
add_action('after_setup_theme', 'caroleb_woocommerce_optimizations');
function caroleb_woocommerce_optimizations()
{
    // Retirer les breadcrumbs par défaut
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    // Ajuster le nombre de produits par ligne
    add_filter('loop_shop_columns', function () {
        return 4;
    });

    // Nombre de produits par page
    add_filter('loop_shop_per_page', function () {
        return 12;
    });
}

// 10. FORCER LE TEMPLATE DU PANIER VIA TEMPLATE_INCLUDE (solution de secours)
add_filter('template_include', 'caroleb_force_template_pages', 99);
function caroleb_force_template_pages($template)
{
    // Pour la page panier
    if (function_exists('is_cart') && is_cart()) {
        $theme_cart = get_stylesheet_directory() . '/woocommerce/cart/cart.php';
        if (file_exists($theme_cart)) {
            return $theme_cart;
        }
    }

    // Pour la page checkout (solution de secours)
    if (function_exists('is_checkout') && is_checkout() && !is_wc_endpoint_url('order-received')) {
        $theme_checkout = get_stylesheet_directory() . '/woocommerce/checkout/form-checkout.php';
        if (file_exists($theme_checkout)) {
            return $theme_checkout;
        }
    }

    return $template;
}

// 11. AJOUTER DES CLASSES BODY POUR CSS SPÉCIFIQUE
add_filter('body_class', 'caroleb_custom_body_classes');
function caroleb_custom_body_classes($classes)
{
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        $classes[] = 'page-woocommerce';
    }

    if (function_exists('is_cart') && is_cart()) {
        $classes[] = 'page-cart';
    }

    if (function_exists('is_checkout') && is_checkout()) {
        $classes[] = 'page-checkout';

        // Ajouter une classe si c'est la page de remerciement
        if (is_wc_endpoint_url('order-received')) {
            $classes[] = 'page-checkout-thankyou';
        }
    }

    return $classes;
}

// 12. CHARGER LE JAVASCRIPT PERSONNALISÉ POUR CHECKOUT
add_action('wp_enqueue_scripts', 'caroleb_enqueue_checkout_js', 40);
function caroleb_enqueue_checkout_js()
{
    if (function_exists('is_checkout') && is_checkout() && !is_wc_endpoint_url('order-received')) {
        $checkout_js = get_stylesheet_directory() . '/assets/js/checkout.js';
        if (file_exists($checkout_js)) {
            wp_enqueue_script(
                'caroleb-checkout-js',
                get_stylesheet_directory_uri() . '/assets/js/checkout.js',
                array('jquery', 'wc-checkout'),
                filemtime($checkout_js),
                true
            );
        }
    }
}

// 13. PERSONNALISATION DES CHAMPS CHECKOUT
add_filter('woocommerce_checkout_fields', 'caroleb_simplify_checkout_fields');
function caroleb_simplify_checkout_fields($fields)
{
    // Exemple: simplifier les champs
    unset($fields['order']['order_comments']);

    // Réorganiser les champs billing
    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_email']['priority'] = 30;
    $fields['billing']['billing_phone']['priority'] = 40;

    return $fields;
}

// 14. VÉRIFICATION DE LA STRUCTURE ASSETS (pour log)
add_action('init', 'caroleb_check_assets_structure');
function caroleb_check_assets_structure()
{
    if (current_user_can('administrator')) {
        $checkout_css_path = get_stylesheet_directory() . '/assets/css/checkout.css';
        if (!file_exists($checkout_css_path)) {
            error_log('ATTENTION: checkout.css non trouvé dans ' . $checkout_css_path);
        }
    }
}

// 15. DEBUG POUR VÉRIFIER LE CHARGEMENT DU CHECKOUT CSS (Optionnel - à activer si besoin)
add_action('wp_head', 'caroleb_debug_checkout_css', 999);
function caroleb_debug_checkout_css()
{
    // Afficher les infos de debug seulement pour les admins sur la page checkout
    if (current_user_can('administrator') && function_exists('is_checkout') && is_checkout()) {
        
        $css_path = get_stylesheet_directory() . '/assets/css/checkout.css';
        $css_exists = file_exists($css_path);
        
        echo '<!-- === DEBUG CHECKOUT CSS === -->' . "\n";
        echo '<!-- Page: ' . (is_checkout() ? 'Checkout' : 'Autre') . ' -->' . "\n";
        echo '<!-- Order received: ' . (is_wc_endpoint_url('order-received') ? 'Oui' : 'Non') . ' -->' . "\n";
        echo '<!-- CSS Path: ' . esc_html($css_path) . ' -->' . "\n";
        echo '<!-- CSS Exists: ' . ($css_exists ? 'OUI' : 'NON') . ' -->' . "\n";
        
        if ($css_exists) {
            echo '<!-- CSS URL: ' . esc_url(get_stylesheet_directory_uri() . '/assets/css/checkout.css') . ' -->' . "\n";
            echo '<!-- CSS Version: ' . filemtime($css_path) . ' -->' . "\n";
        }
        
        // Vérifier si le style est enregistré
        global $wp_styles;
        if (isset($wp_styles->registered['caroleb-checkout'])) {
            echo '<!-- Style enregistré: OUI -->' . "\n";
            echo '<!-- Style src: ' . esc_url($wp_styles->registered['caroleb-checkout']->src) . ' -->' . "\n";
        } else {
            echo '<!-- Style enregistré: NON -->' . "\n";
        }
        
        // Liste des styles chargés
        echo '<!-- Styles dans la queue: ' . implode(', ', $wp_styles->queue) . ' -->' . "\n";
        echo '<!-- === FIN DEBUG === -->' . "\n";
    }
}

// 16. SOLUTION DE SECOURS SI LE CSS N'EST TOUJOURS PAS CHARGÉ
add_action('wp_head', 'caroleb_checkout_css_fallback', 100);
function caroleb_checkout_css_fallback()
{
    // Chargement direct si la méthode normale échoue
    if (function_exists('is_checkout') && is_checkout()) {
        $css_path = get_stylesheet_directory() . '/assets/css/checkout.css';
        
        if (file_exists($css_path)) {
            $css_url = get_stylesheet_directory_uri() . '/assets/css/checkout.css';
            $version = filemtime($css_path);
            
            // Ajouter un commentaire pour identifier cette méthode
            echo '<!-- Fallback checkout CSS -->' . "\n";
            
            // Charger le CSS directement
            echo '<link rel="stylesheet" id="caroleb-checkout-fallback" href="' . esc_url($css_url) . '?ver=' . esc_attr($version) . '" type="text/css" media="all" />' . "\n";
        }
    }
}