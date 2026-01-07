<?php get_header(); ?>

    <a class="button" href="<?php echo esc_url( home_url( '/galerie' ) ); ?>">< Retour</a>

<main class="wrap">
  <section class="content-area content-full-width">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="image-conteneur">
        <header>
          <?php the_post_thumbnail('medium'); ?>
          <h2><?php the_title(); ?></h2>
        </header>
       <?php the_content(); ?>
      </article>
<?php endwhile; else : ?>
      <article>
        <p>Sorry, no post was found!</p>
      </article>
<?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>