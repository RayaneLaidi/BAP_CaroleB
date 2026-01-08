<?php get_header(); ?>
    
<main class="wrap">
  
 <img  class="carole" src="<?php echo get_template_directory_uri(); ?>/asset/carole.png" alt="lien">

      <article class="article-full">    
       <?php the_content(); ?>
       <a class="button" href="<?php echo esc_url( home_url( '/bio' ) ); ?>">A propos de moi</a> 
      </article>  
   
</main>
       <hr>
  <h1>Galerie</h1>

     <article>


      <div class="carousel-container">
      <ul class="carousel-list">
      <li id="slide-1"><img  class="wonder_woman  " src="<?php echo get_template_directory_uri(); ?>/asset/wonder_woman.png" alt="lien"></li>
      <li id="slide-2"><img  class="wonder_woman  " src="<?php echo get_template_directory_uri(); ?>/asset/pochoir.jpg" alt="lien"></li>
      <li id="slide-3"><img  class="wonder_woman  " src="<?php echo get_template_directory_uri(); ?>/asset/wonder_or.png" alt="lien"></li>
      </ul></div>

      <a class="button" href="<?php echo esc_url( home_url( '/galerie' ) ); ?>">Voir tout</a>
     
     </article>
 <hr>
 <h1>Mes partenaires</h1>
 <article>
    <img  class="patenariat" src="<?php echo get_template_directory_uri(); ?>/asset/partenariat.png" alt="lien">
    <a  class ="button" href="<?php echo esc_url( home_url( '/partenaires' ) ); ?>">Voir tout</a>
 </article>


 

</body>
<?php get_footer(); ?>