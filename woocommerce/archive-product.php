<?php get_header(); ?>
<style>
    /* Grille de produits 3x3 */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin: 30px auto;
        padding: 20px 0;
        /* Supprime complètement le padding gauche/droit */
        list-style: none;
        max-width: 1200px;
        /* Augmente la largeur maximale de 1000px à 1200px */
    }

    .products-grid li.product {
        margin-bottom: 0;
        padding: 0;
        /* Supprime complètement le padding */
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .products-grid li.product:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    /* Ajustements pour les images des produits */
    .products-grid .woocommerce-loop-product__link {
        display: block;
        margin-bottom: 15px;
    }

    .products-grid .woocommerce-loop-product__title {
        font-size: 1.1em;
        margin: 10px 0;
        color: #333;
    }

    .products-grid .price {

        color: #d32f2f;
        font-weight: bold;
        font-size: 1.2em;
        margin: 10px 0;
    }

    /* Responsive : sur tablettes */
    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
            /* 2 colonnes sur tablettes */
            grid-template-rows: auto;
        }
    }

    /* Responsive : sur mobiles */
    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: 1fr;
            /* 1 colonne sur mobiles */
            gap: 20px;
        }
    }

    /* Style pour la pagination */
    .woocommerce-pagination {
        margin-top: 40px;
        text-align: center;
    }

    .woocommerce-pagination .page-numbers {
        display: inline-flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .woocommerce-pagination .page-numbers li {
        margin: 0 5px;
    }

    .woocommerce-pagination .page-numbers a,
    .woocommerce-pagination .page-numbers span {
        display: block;
        padding: 8px 15px;
        background: #f5f5f5;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
    }

    .woocommerce-pagination .page-numbers .current {
        background: #E0435B;
        color: white;
    }

    /* CENTRER L'IMAGE ET LE PRIX */
    .product-card {
        text-align: center;
        /* Centre tout le contenu */
    }

    .product-image {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
    }

    .product-image img {
        width: 100vw;
        height: auto;
    }

    .product-title {
        text-align: center;
        margin: 10px 0;
    }

    .product-price {
        text-align: center;
        font-size: 1.2em;
        font-weight: bold;
        color: #d32f2f;
        margin: 15px 0;
    }

    .product-actions {
        display: flex;
        justify-content: center;
        margin-top: 5px;
        /* Réduit de 15px à 5px */
    }

    /* FORCER TOUTES LES IMAGES À LA MÊME TAILLE */
    .product-image {
        width: 100%;
        height: 200px;
        /* Réduit de 300px à 200px */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f5f5f5;
        margin-bottom: 10px;
        /* Réduit de 15px à 10px */
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Pour remplir le conteneur sans déformer */
        /* Ou utilisez object-fit: contain; pour voir l'image entière */
    }

    .products-grid .woocommerce-loop-product__link img {
        width: 100%;
        height: 200px;
        /* Réduit de 300px à 200px */
        object-fit: cover;
    }

    /* Titre et Prix sur la même ligne */
    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        /* Ajoute un peu de padding interne */
        border-bottom: 2px solid #eee;
    }

    .product-title {
        margin: 0;
        font-size: 16px;
        /* Réduit de 18px à 16px */
        flex: 1;
        text-align: left;
        padding-left: 0;
    }

    .product-title a {
        text-decoration: none;
        color: #333;
        display: block;
        text-align: left;
        /* Force l'alignement du lien aussi */
    }

    .product-price {
        font-size: 18px;
        /* Réduit de 20px à 18px */
        font-weight: bold;
        color: #E0435B;
        margin-left: 15px;
        /* Réduit de 20px à 15px */
        white-space: nowrap;
    }

    /* Description alignée à gauche */
    .product-description {
        text-align: left;
        padding: 10px;
        /* Ajoute un padding interne pour la description */
    }

    .product-tagline,
    .product-slogan,
    .product-author {
        text-align: left;
        margin: 5px 0;
    }

    .product-footer {
        padding: 5px 10px 10px 10px;
        /* Ajoute un padding interne pour le bouton */
        text-align: center;
    }

    /* Bouton avec la même largeur que le cadre */
    .product-actions {
        display: block;
        /* Change de flex à block */
        width: 100%;
        margin-top: 5px;
        padding: 0;
        /* Supprime le padding pour éviter les débordements */
    }

    .product-actions .button,
    .product-actions .add_to_cart_button {
        width: 100%;
        /* Le bouton prend toute la largeur */
        display: block;
        padding: 12px;
        text-align: center;
        background: #ffff;
        color: #E0435B;
        border: 1px solid #E0435B;
        border-radius: 15px;
        cursor: pointer;
        transition: background 0.3s ease;
        box-sizing: border-box;
        font-size: inherit;
        /* Garde la taille de police par défaut */
        font-weight: inherit;
        /* Garde le poids de police par défaut */
    }

    .product-actions .button:hover,
    .product-actions .add_to_cart_button:hover {
        background: #c0354b;
        color: #ffff;
    }
</style>
<div class="shop-container">
    <header class="shop-header">
        <h1>Boutique</h1>
    </header>

    <?php
    if (woocommerce_product_loop()) {
        ?>
        <!-- C'est ICI qu'on définit la grille -->


        <ul class="products products-grid">
            <?php
            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();
                    // Chaque produit utilise content-product.php
                    wc_get_template_part('content', 'product');
                }
            }
            ?>
        </ul>

        <?php
        woocommerce_pagination();
    } else {
        echo '<p>Aucun produit disponible</p>';
    }
    ?>
</div>

<?php get_footer(); ?>