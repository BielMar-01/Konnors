<div class="wpContent--curriculum <?php the_sub_field("customClass") ?>">
    <div class="container">
        <?php
            while(have_rows('categoria')) : the_row(); ?>
                <div class="accordion mb-5">
                    <div class="accordion__item">
                        <div class="accordion__item__header js-trigger-accordion"><?php the_sub_field('categoryTitle'); ?></div>
                        <div class="accordion__item__content">
                            <?php
                                the_sub_field('categoryDescription');

                                while (have_rows('members')) : the_row(); ?>
                                    <div class="accordion__item curriculum">
                                        <div class="accordion__item__header js-trigger-accordion">
                                            <div class="toggle">
                                                <div class="line"></div>
                                                <div class="line"></div>
                                            </div>
                                            <span><?php the_sub_field('name'); ?></span>
                                            <span><?php the_sub_field('job'); ?></span>
                                            <!-- <span><?php the_sub_field('beginDate'); ?></span>
                                            <span><?php the_sub_field('endDate'); ?></span> -->
                                        </div>

                                        <div class="accordion__item__content">
                                            <?php the_sub_field('resume'); ?>
                                        </div>
                                    </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
        <?php endwhile; ?>
    </div>
</div>