<section class="wpContent--faqs accordion">
    <div class="container">
        <?php
            while ( have_rows('content_faqs') ): the_row(); ?>
            <div class="accordion__item">
                <div class="accordion__item__header">
                    <?php the_sub_field('content_faqs_title'); ?>
                </div>

                <div class="accordion__item__content">
                    <?php the_sub_field('content_faqs_content'); ?>
                </div>
            </div>
        <?php 
            endwhile; ?>
    </div>
</section> <!-- id accordion end -->