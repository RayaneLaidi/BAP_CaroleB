<?php get_header(); ?>

<div class="container">
    <?php
    while (have_posts()) : the_post();
        wc_get_template_part('content', 'single-product');
    endwhile;
    ?>
</div>
<!--<h1>test</h1>-->

<?php get_footer(); ?>