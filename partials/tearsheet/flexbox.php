<?php global $sectionIndex; ?>
<section class="wpContent--flexbox flexbox">
    <div class="row">
    <?php 
        while(have_rows("flexbox")){ the_row();
            $size = get_sub_field("maxSize");
            echo "<div class=\"item $size\">";
                get_template_part("partials/tearsheetEditor");
            echo "</div>";
            $sectionIndex .= "f";
        }  
    ?>
    </div>
</section>