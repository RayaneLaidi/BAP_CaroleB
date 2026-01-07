<?php get_header(); ?>

<main class="site-main">
    <header class="archive-header">
        <h1>Galerie</h1>
    </header>

    <div class="categories">
        <a class="button">Oeuvres principales</a>
        <a class="button">Fresque</a>
        <a class="button">Street art</a> 
         <a class="button">Trier par ^ </a>
    </div>
  





    <div class="grille-galeries">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('item-galerie'); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="image-conteneur">
                                <?php the_post_thumbnail('medium'); ?>
                                <br>
                                <?php the_title()?>
                            </div>
                        <?php endif; ?>
              
                    </a>
                </article>

            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucune oeuvre trouvée.</p>
        <?php endif; ?>
    </div>
</main>

 <div class="espace"></div>
<?php get_footer(); ?>