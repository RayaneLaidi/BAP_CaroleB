
<?php
/**
 * Template principal
 */

// 1. Charge le header
get_header(); ?>

<div class="content">
    <?php
    // 2. Boucle WordPress pour afficher le contenu
    if (have_posts()) :
        while (have_posts()) : the_post();
            // Titre de la page/article
            the_title('<h1>', '</h1>');
            
            // Contenu principal
            the_content();
        endwhile;
    else :
        echo '<p>Aucun contenu trouvé</p>';
    endif;
    ?>
</div>

<?php
// 3. Charge le footer
get_footer();