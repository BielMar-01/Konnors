<?php
    get_header();
    get_template_part('partials/content', 'top');

 ?>
    <div class="wpContent">
        <div class="container">
            <?php the_content(); ?>
        </div>
        <?php
            get_template_part('partials/content', 'editor');
        ?>
    </div>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>