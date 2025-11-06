<?php get_header(); ?>

<div class="main-content">
    <h2>Bienvenue sur le site de notre street artiste !</h2>
    <p>Découvrez les dernières œuvres et événements.</p>

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <h3><?php the_title(); ?></h3>
            <?php the_content(); ?>
        <?php endwhile;
    else :
        echo '<p>Aucun contenu pour le moment.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
