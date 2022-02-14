<?php 
    $sectionIndex = $args['index'];
?>
<section class="wpContent--flexbox flexbox">
    <div class="container">
        <div class="row">
        <?php 
            while(have_rows("flexbox")){ the_row();
                $size = get_sub_field("maxSize");
                echo "<div class=\"item $size\">";
                    get_template_part('partials/content', 'editor');
                echo "</div>";
            }  
        ?>
        </div>
    </div>
</section>