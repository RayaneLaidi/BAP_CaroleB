<?php get_header(); ?>

<div class="container">
    <?php
    if (woocommerce_product_loop()) {
        // Affichage des produits
        woocommerce_product_loop_start();
        
        if (wc_get_loop_prop('total')) {
            while (have_posts()) {
                the_post();
                wc_get_template_part('content', 'product');
            }
        }
        
        woocommerce_product_loop_end();
    } else {
        echo '<p>Aucun produit disponible</p>';
    }
    ?>
</div>

<?php get_footer(); ?>