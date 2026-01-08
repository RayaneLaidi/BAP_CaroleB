 <?php get_header(); ?>

<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
    <input type="hidden" name="action" value="mon_formulaire_contact">
    
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="email">Message</label>
    <input type="text" name="email" id="email" required>

    <button class="button" type="submit">Envoyer</button>
</form>

  <?php get_footer(); ?>