<!DOCTYPE html>

<head>
  <?php 
  wp_head()
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
 
  <div class="menu">
    <div class="phantom"></div>
    
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img  class="logo"
            src="<?php echo get_template_directory_uri(); ?>/asset/logo.png" 
            alt="Logo du site"
        >
    </a>

  

 <a href="<?php echo esc_url( home_url( '/sommaire' ) )?>" >
    <div id="burger"><hr><hr><hr></div>
    </a>

    <div class="sommaire"> 
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('accueil') ) ); ?>">Accueil</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('Partenaires') ) ); ?>">Partenaires</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('actu') ) ); ?>">Evènements</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ); ?>">Contact</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('Biographie') ) ); ?>">Biographie</a>
    <a href="<?php echo esc_url( get_post_type_archive_link('galerie') ); ?>">Galerie</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('Shop') ) ); ?>">Boutique</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('Cart') ) ); ?>">Panier</a>

    </div>

</div>
  




