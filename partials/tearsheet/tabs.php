<?php global $sectionIndex; ?>
<section class="wpContent--tabs tabs">
    <div class="container">
        <nav>
            <?php
                while(have_rows('items')) { the_row();
                    $title = get_sub_field("title");
                    $slug = sanitize_title($title) ."_$sectionIndex";

                    echo <<<TITLE
                            <label class="tab" for="$slug">$title</label>
                    TITLE;
                }
            ?>
        </nav>

        <div class="tabs__info">
            <?php 
                while(have_rows('items')) { the_row();
                    $content = get_sub_field("content");
                    $slug = sanitize_title($title) ."_$sectionIndex";

                    echo <<<CONTENT
                        <input type="radio" class="hiddenToggle" id="$slug">
                        <div class="tabContent">$content</div>
                    CONTENT;
                }
            ?>
                
        </div>

        <script>
            
        </script>
    </div>
</section>