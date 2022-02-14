<?php
    get_header();
    get_template_part('partials/content', 'top');
?>

    <h3><?php _e("Não conseguimos localizar a página que você tentou acessar.", LANG_DOMAIN) ?></h3>
    <a href="<?php echo get_home_url(); ?>"><?php _e("Clique aqui", LANG_DOMAIN) ?></a> <?php _e("para voltar para a página principal.", LANG_DOMAIN) ?>

<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>