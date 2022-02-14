<?php /* Template Name: MZ - Estratégia ESG */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>
    <div class="wpContent--energy">
        <section class="sustainable">
            <div class="container">
                <?php 
                    the_field('sustainableSolutions');
                ?>
            </div>
        </section>

        <section class="esgStrategy">
            <div class="container">
                <?php 
                    $strategy = get_field('strategy');
                    echo $strategy['content'];

                    $amount = count($strategy['solutions']);
                    $step = floor(360 / $amount);
                ?>

                <div class="solutions imVisible">
                    <?php
                        $i = 0;
                        foreach($strategy['solutions'] as $solution) {
                            $icon = $solution['icon'];
                            $title = $solution['title'];

                            $deg = $step * $i;

                            $top = ((1 - cos($deg)) * 50) .'%';
                            $left = (sin($deg) * 100) .'%';

                            $offset = sin($deg);

                            echo <<<ITEM
                                <div class="space" style="transform: rotate({$deg}deg)">
                                    <i class="solution" style="background-image: url('$icon'); transform: rotate(calc(360deg - {$deg}deg))">
                                        <div class="titleSpace" style="width: calc(64px - 20px * $offset); transform: rotate({$deg}deg)">
                                            <span class="title" style="transform: translate(0, -50%) rotate(calc(360deg - {$deg}deg));">$title</span>
                                        </div>
                                    </i>
                                </div>
                            ITEM;

                            $i++;
                        }
                    ?>
                </div>

                <?php echo $strategy['bottomContent']; ?>
            </div>
        </section>

        <section class="ratings">
            <div class="container">
                <?php 
                    $ratings = get_field('ratings');
                    echo $ratings['content'];
                ?>
                <div class="blocks">
                    <?php 
                        foreach($ratings['tabBlocks'] as $block) {
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

        <section class="commitment">
            <div class="container">
                <?php 
                    $ratings = get_field('commitment');
                    echo $ratings['content'];
                ?>
                <div class="blocks">
                    <?php 
                        foreach($ratings['tabBlocks'] as $block) {
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

        <section class="manifest">
            <div class="container">
                <?php the_field('ourManifest'); ?>
            </div>
        </section>

        <?php 
            $origins = get_field('ourOrigins');
        ?>
        <section class="origins" style="background-image: url(<?php echo $origins['bgImage']; ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4"><?php echo $origins['leftContent']; ?></div>
                    <div class="col-xl-8"><?php echo $origins['rightContent']; ?></div>
                </div>
            </div>
        </section>

        <section class="greenFinancing">
            <div class="container">
                <?php 
                    $gf = get_field('greenFinancing');
                    echo $gf['content'];
                ?>
                <div class="greenTitles">
                    <div class="banners">
                        <?php 
                            foreach($gf['slides'] as $slide) {
                                $banner = $slide['banner'];
        
                                echo <<<ITEM
                                    <div>
                                        <div class="banner" style="background-image: url($banner)"></div>
                                    </div>
                                ITEM;
                            }
                        ?>
                    </div>
                    <div class="contents">
                        <?php 
                            foreach($gf['slides'] as $slide) {
                                $title = $slide['title'];
                                $content = $slide['content'];
        
                                echo <<<ITEM
                                    <div>
                                        <div class="content row">
                                            <div class="col-xl-4">
                                                <h3 class="title">$title</h3>
                                            </div>
                                            <div class="col-xl-8">$content</div>
                                        </div>
                                    </div>
                                ITEM;
                            }
                        ?>
                    </div>
                </div>
                <script>
                    $(function(){
                        $('.wpContent--energy .greenFinancing .greenTitles .banners').slick({
                            infinite: false,
                            slidesToShow: 1,
                            fade: true,
                            dots: true,
                            arrows: true,
                            nextArrow: '<button class="next"></div>',
                            prevArrow: '<button class="prev"></div>',
                            asNavFor: '.wpContent--energy .greenFinancing .greenTitles .contents'
                        });

                        $('.wpContent--energy .greenFinancing .greenTitles .contents').slick({
                            infinite: false,
                            slidesToShow: 1,
                            fade: false,
                            dots: false,
                            arrows: false,
                            asNavFor: '.wpContent--energy .greenFinancing .greenTitles .banners',
                        });
                    })
                </script>
            </div>
        </section>
    </div>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>