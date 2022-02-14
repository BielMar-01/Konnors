<input type="checkbox" name="footer" id="resultsToggle" class="hiddenToggle">
<div class="lastResults item">
    <label for="resultsToggle" class="title"><?php _e("Ver Resultados", LANG_DOMAIN); ?></label>
    <div class="modal">
        <label for="resultsToggle" class="close"></label>
        <span class="title"><?php the_field("footerResultsTitle", "options"); ?></span>
        <div class="files">
            <?php
                while(have_rows("footerResults", "options")){ the_row();
                    $link = esc_url(get_sub_field("link"));
                    $name = get_sub_field("name");
                    $title = esc_attr(get_sub_field("name"));
                    $icon = esc_url(get_sub_field("icon"));

                    echo <<<FILE
                        <a class="file" href="$link" target="_blank" title="$title">
                            <i class="icon" style="background-image: url($icon);"></i>
                            $name
                        </a>
                    FILE;
                }
            ?>
        </div>
        <a href="<?php the_field("footerResultsLink", "options"); ?>" class="allItems"><?php _e("Ver todos os resultados", LANG_DOMAIN); ?></a>
    </div>
</div>