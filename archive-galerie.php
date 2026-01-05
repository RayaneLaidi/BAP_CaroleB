<?php get_header(); ?>

<main class="site-main">
    <header class="archive-header">
        <h1>Galerie</h1>
    </header>

    <div class="categories">
        <button><a>Oeuvres principales</a></button>
        <button><a>Fresque</a></button>
        <button><a>Street art</a></button>
    </div>
    <button><a>Trier par ^ </a></button>





    <div class="grille-galeries">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('item-galerie'); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="image-conteneur">
                                <?php the_post_thumbnail('medium'); // Affiche l'image mise en avant ?>
                            </div>
                        <?php endif; ?>
                        
                        <h2><?php the_title(); ?></h2>
                    </a>
                </article>

            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucune oeuvre trouvée.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>