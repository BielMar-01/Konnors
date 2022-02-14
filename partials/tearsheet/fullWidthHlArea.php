<?php while(have_rows("fullWidthHlArea")): the_row(); ?>
<section class="wpContent--fullWidthHlArea">
    <div class="image" style="background-image: url(<?php the_sub_field("image"); ?>);"></div>
    <div class="content"><?php the_sub_field("content"); ?></div>
</section>
<?php endwhile; ?>