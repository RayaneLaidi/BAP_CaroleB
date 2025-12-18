<?php get_header(); ?>

<main class="site-main sommaire-container">


        <hr>

        <ul class="liste-sommaire">
          <a href="<?php echo esc_url( home_url( '/panier' ) ); ?>"><img  class="panier" src="<?php echo get_template_directory_uri(); ?>/asset/panier.png" alt="lien"></a>
            <?php
           
            // Exemple : On liste automatiquement les pages enfants de "Galeries d'Art"
            // (Il faudra adapter l'ID 'child_of' selon tes besoins)
            wp_list_pages(array(
                'title_li' => '',
                'child_of' => 0, // Remplace 0 par l'ID de ta page parente si besoin
                'depth'    => 1,
                'exclude'  => '183, 120,102'
          
            ));
            
            ?>
            
        </ul>
    </div>
</main>

<?php get_footer(); ?>