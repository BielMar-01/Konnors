<section class="wpContent--faqs accordion <?php the_sub_field("customClass") ?>">
    <div class="container">
        <?php
            while ( have_rows('content_faqs') ): the_row(); ?>
            <div class="accordion__item">
                <div class="accordion__item__header">
                    <?php the_sub_field('content_faqs_title'); ?>
                </div>

                <div class="accordion__item__content <?php the_sub_field("enablePadding"); ?>">
                    <?php 
                        get_template_part('partials/content', 'editor');
                    ?>
                </div>
            </div>
        <?php 
            endwhile; ?>
    </div>
</section>