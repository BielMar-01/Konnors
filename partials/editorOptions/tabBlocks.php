<?php 
    $customClass = get_sub_field('customClass');
?>
<section class="wpContent wpContent--tabBlocks <?php echo $customClass; ?>">
    <div class="container">
        <?php 
            $blocks = get_sub_field('tabBoxes');
            echo $blocks['content'];
        ?>
        <div class="blocks">
            <?php 
                foreach($blocks as $block) {
                    $image = $block['image'];
                    $title = $block['title'];
                    $content = $block['content'];

                    echo <<<ITEM
                        <div class="tabBlock" tabindex="-1" style="background-image: url($image)">
                            <div class="tab">
                                <span class="title">$title</span>
                                <span class="content">$content</span>
                            </div>
                        </div>
                    ITEM;
                }
            ?>
        </div>
    </div>
</section>