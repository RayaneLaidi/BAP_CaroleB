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

    <a  href="http://caroleb.local/sommaire/" class="burger"><hr><hr><hr></a>
  
  
    <!--
    <a href="http://caroleb.local/accueil/">Accueil</a> 
    <a href="http://caroleb.local/boutique/">Boutique</a>
    <a href="http://caroleb.local/bio/">Biographie</a>
    <a href="http://caroleb.local/contact/">Contact</a>
    <a href="http://caroleb.local/oeuvre/">Galerie D'art</a> -->
</div>

</head>

