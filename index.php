
<?php get_header(); ?>

<div class="main-content">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile;
    else :
        echo '<p>Aucun contenu pour le moment.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>


