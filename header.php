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
    <a href="<?php echo esc_url( home_url( '/shop' ) )?>">Boutique</a>
    <a href="<?php echo esc_url( home_url( '/bio' ) )?>">Biographie</a>
    <a href="<?php echo esc_url( home_url( '/contact' ) )?>">Contact</a>
    <a href="<?php echo esc_url( home_url( '/galerie' ) )?>">Galerie D'art</a> 
    <a href="<?php echo esc_url( home_url( '/actu' ) )?>">Evènements</a> 
    <a href="<?php echo esc_url( home_url( '/cart' ) )?>"><img class="panier" src="<?php echo get_template_directory_uri(); ?>/asset/panier.png" alt="lien"></a> 
  </div>

</div>
  




