<div class="wpContent--contentsWithLogo">
    <div class="container">
    <?php while(have_rows("contentWithLogo")): the_row(); ?>
        <div class="item">
            <div class="icon">
                <img src="<?php the_sub_field("icon"); ?>"/>
            </div>
            <div class="content">
                <?php the_sub_field("content"); ?>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</div>