<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- IMPORTANT : Cette ligne charge tous les scripts et styles -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- Vous pouvez ajouter votre menu ici si vous en avez un -->
    <header>
        <nav>
            <a href="<?php echo home_url(); ?>">Accueil</a>
            <a href="<?php echo wc_get_page_permalink('shop'); ?>">Boutique</a>
            <a href="<?php echo wc_get_page_permalink('cart'); ?>">Panier</a>
        </nav>
    </header>

    <main></main>