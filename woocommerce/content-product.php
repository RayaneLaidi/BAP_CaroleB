<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
    return;
}

// Récupérer la description courte
$short_description = $product->get_short_description();

// Pour un affichage spécifique en 3 parties comme sur l'image
// On peut utiliser des champs personnalisés ACF ou diviser la description
$description_parts = array();
if (!empty($short_description)) {
    $lines = explode("\n", $short_description);
    $lines = array_filter(array_map('trim', $lines));

    // Prendre jusqu'à 3 lignes maximum pour l'affichage
    if (count($lines) > 0) {
        $description_parts['tagline'] = isset($lines[0]) ? $lines[0] : '';

        // Combiner les lignes intermédiaires pour le slogan
        $slogan_lines = array_slice($lines, 1, -1);
        $description_parts['slogan'] = implode("<br>", $slogan_lines);

        // Dernière ligne pour l'auteur
        $description_parts['author'] = end($lines);
    }
}
?>

<li <?php wc_product_class('product-item', $product); ?>>
    <div class="product-card">

        <!-- Image -->
        <div class="product-image">
            <a href="<?php echo esc_url($product->get_permalink()); ?>">
                <?php echo $product->get_image('medium'); ?>
            </a>
        </div>

        <!-- Titre et Prix sur la même ligne -->
        <div class="product-header">
            <h2 class="product-title">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <?php echo get_the_title(); ?>
                </a>
            </h2>

            <div class="product-price">
                <?php echo $product->get_price_html(); ?>
            </div>
        </div>

        <!-- Description à gauche -->
        <?php if (!empty($short_description)): ?>
            <div class="product-description">
                <?php if (!empty($description_parts['tagline'])): ?>
                    <div class="product-tagline">
                        <?php echo esc_html($description_parts['tagline']); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($description_parts['slogan'])): ?>
                    <div class="product-slogan">
                        <?php echo wp_kses($description_parts['slogan'], array('br' => array())); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($description_parts['author'])): ?>
                    <div class="product-author">
                        <?php echo esc_html($description_parts['author']); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Bouton Ajout panier -->
        <div class="product-footer">
            <div class="product-actions">
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>

    </div>
</li>