
<?php get_header();?>
<hr>

 <h1 class="titre"> <?php the_title() ; ?></h1>
 
</head>
   <div class="liste-sommaire">
    <ul>
        <?php
         wp_list_pages(array(
                'title_li' => '',
                'child_of' => 0, 
                'depth'    => 1,
                'exclude'  => '183, 120,102'
          
            ));
            
            ?>
    </ul>
</div>

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


