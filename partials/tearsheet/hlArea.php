<section class="wpContent--hlArea hlArea">
    <div class="container">
    <?php
        // vars
        if(have_rows("content_hlArea")): the_row();
            if(get_sub_field('content_hlArea_title')): ?>
                <h2>
                    <?php the_sub_field('content_hlArea_title'); ?>
                </h2>
        <?php
            endif;
            if(get_sub_field('content_hlArea_subtitle')): ?>
                <h4><?php the_sub_field('content_hlArea_title'); ?></h4>
        <?php 
            endif;
            if(get_sub_field('content_hlArea_content')){
                the_sub_field('content_hlArea_content');
            }
        endif;

        if(have_rows("numbers")): ?>
            <div class="numbers">
            <?php while(have_rows("numbers")): the_row(); ?>
                <div>
                    <div class="item <?php echo get_sub_field("icon") ? "" : "noIcon"; ?>">
                    <?php if(get_sub_field("icon")): ?>
                        <i class="icon" style="background-image: url(<?php the_sub_field("icon"); ?>);"></i>
                    <?php 
                        endif;

                        if(get_sub_field("aboveNumber")): ?>
                            <span class="aboveNumber"><?php the_sub_field("aboveNumber"); ?></span>
                    <?php
                        endif; ?>
                        <div class="number">
                            <span class="prefix"><?php the_sub_field("prefix") ?></span>
                            <span class="value growValueOnVisible" value="<?php the_sub_field("number") ?>">1</span>
                            <span class="sufix"><?php the_sub_field("sufix") ?></span>
                        </div>
                    <?php
                        if(get_sub_field("underNumber")): ?>
                            <span class="underNumber"><?php the_sub_field("underNumber") ?></span>
                    <?php
                        endif; ?>
                        
                        <span class="description"><?php the_sub_field("description") ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
    <?php endif; ?>
    </div>
</section>