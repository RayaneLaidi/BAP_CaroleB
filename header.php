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

  

<a id="burger" href="javascript:void(0)">
    <div class="burger-icon">
        <hr><hr><hr>
    </div>
</a>

<div class="liste-sommaire">
    <ul>
        <?php
        wp_list_pages(array(
            'title_li' => '',
            'child_of' => 0, 
            'depth'    => 1,
            'exclude'  => '183, 120, 102,217'
        ));
        ?>
    </ul>
</div>

    
  

    <div class="sommaire"> 
    <a href="<?php echo esc_url( home_url( '/shop' ) )?>">Boutique</a>
    <a href="<?php echo esc_url( home_url( '/bio' ) )?>">Biographie</a>
    <a href="<?php echo esc_url( home_url( '/contact' ) )?>">Contact</a>
    <a href="<?php echo esc_url( home_url( '/galerie' ) )?>">Galerie D'art</a> 
    <a href="<?php echo esc_url( home_url( '/actu' ) )?>">Evènements</a> 
    <a href="<?php echo esc_url( home_url( '/cart' ) )?>"><img class="panier" src="<?php echo get_template_directory_uri(); ?>/asset/panier.png" alt="lien"></a> 
  </div>

</div>
  
<script>
  
document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('#burger'); // Ta div avec les hr
    const menu = document.querySelector('.liste-sommaire'); // La div qui contient les liens

    burger.addEventListener('click', function() {
        // "toggle" ajoute la classe si elle n'est pas là, et l'enlève si elle y est
        menu.classList.toggle('is-open');
    });
});
</script>




