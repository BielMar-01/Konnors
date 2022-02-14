<?php
    get_header();
    get_template_part('partials/content', 'top');
?>
    <div class="wpContent--text">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>