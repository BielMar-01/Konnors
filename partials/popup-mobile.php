<?php
    $args = array(
        'post_type'         => 'popup_mobile',
        'posts_per_page'    => 1,
        'post_status'   => 'publish',
        'orderby'   => 'meta_value',
        'order'     => 'ASC'
    );
    $query = new WP_Query($args);

    while ($query->have_posts()): $query->the_post();
        $popupTitle = get_the_title();
        $popupSubtitle = get_field('subtitle');

        $btn = get_field("button");
?>
        <div id="popup-mobile" class="popup">
            <div class="box-msg">
                <div class="info">
                    <label for="popupToggle" class="close">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="1.41421" y1="1" x2="12.75" y2="12.3358" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <line x1="1" y1="-1" x2="17.0312" y2="-1" transform="matrix(0.707107 -0.707107 -0.707107 -0.707107 0 12.75)" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </label>
                    <div class="top">
                        <span class="title"><?php echo $popupTitle; ?></span>
                        <span class="subtitle"><?php echo $popupSubtitle; ?></span>
                    </div>
                    <main>
                        <?php
                            the_content();
                            
                            if ($btn['url']) {
                                echo <<<POPUP_LINK
                                        <a class="btn" href="{$btn['url']}" target="{$btn['target']}">{$btn['title']}</a>
                                POPUP_LINK;
                            }
                        ?>
                    </main>
                </div>
            </div>
        </div>
<?php
    endwhile;
    wp_reset_postdata();
?>