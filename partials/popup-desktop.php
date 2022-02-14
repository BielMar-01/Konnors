<?php
    $args = array(
        'post_type' => 'popup',
        'posts_per_page' => 1,
        'post_status'   => 'publish',
        'orderby'     => 'meta_value',
        'order'       => 'ASC'
    );
    $query = new WP_Query($args);

    while ($query->have_posts()): $query->the_post();
        $popupTitle = get_the_title();
        $popupSubtitle = get_field('subtitle');

        $btn = get_field("button");
?>
        <div id="popup" class="popup desktop">
            <div class="box-msg">
                <div class="info">
                    <label for="popupToggle" class="close">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="7.12132" y1="7.1759" x2="27" y2="27.0546" stroke="white" stroke-width="3" stroke-linecap="round"/>
                            <line x1="1.5" y1="-1.5" x2="29.6127" y2="-1.5" transform="matrix(0.707107 -0.707107 -0.707107 -0.707107 5 26.8818)" stroke="white" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </label>
                    <div class="top">
                        <!-- <span class="title"><?php //echo $popupTitle; ?></span> -->
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