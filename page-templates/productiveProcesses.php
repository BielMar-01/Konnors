<?php /* Template Name: MZ - Produtos e Processos Produtivos */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');

    the_content();
?>
    <div class="wpContent--productiveProcesses">
        <section class="bestAluminum container">

            <?php 
                $bestAluminum = get_field('bestAluminum');
                echo $bestAluminum['content'];
            ?>
            <div class="markets">
                <?php 
                    foreach($bestAluminum['markets'] as $item) {
                        $picture = $item['picture'];
                        $title = $item['title'];

                        echo <<<ITEM
                            <div>
                                <div class="item">
                                    <div class="picture" style="background-image: url($picture)"></div>
                                    <span class="title">$title</span>
                                </div>
                            </div>
                        ITEM;
                    }
                ?>
            </div>
        </section>

        <section class="tabs">
            <?php 
                $tabs = get_field('tabs');
            ?>
            <nav class="navigation">
                <div class="container">
                    <label for="productiveProcess" class="tab productiveProcess">
                        <div class="picture" style="background-image: url(<?php echo $tabs['tabOne']['picture']; ?>);"></div>
                        <span class="title"><?php echo $tabs['tabOne']['title']; ?></span>
                    </label>
                    <a href="<?php echo $tabs['tabTwo']['link']['url']; ?>" target="<?php echo $tabs['tabTwo']['link']['target']; ?>" title="<?php echo $tabs['tabTwo']['link']['title']; ?>" class="tab ourProducts">
                        <div class="picture" style="background-image: url(<?php echo $tabs['tabTwo']['picture']; ?>);"></div>
                        <span class="title"><?php echo $tabs['tabTwo']['title']; ?></span>
                    </a>
                </div>
            </nav>
            <input type="checkbox" id="productiveProcess" class="hiddenToggle">
            <div class="productiveProcess container">
                <div class="wpContent pb-0">
                    <?php echo $tabs['tabOne']['content']; ?>
                </div>
                <div class="banners">
                    <?php 
                        foreach($tabs['tabOne']['slides'] as $slide) {
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
                        foreach($tabs['tabOne']['slides'] as $slide) {
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
                    $('.wpContent--productiveProcesses .tabs > .productiveProcess .banners').slick({
                        infinite: false,
                        slidesToShow: 1,
                        fade: true,
                        dots: true,
                        arrows: true,
                        nextArrow: '<button class="next"></div>',
                        prevArrow: '<button class="prev"></div>',
                        asNavFor: '.wpContent--productiveProcesses .tabs > .productiveProcess .contents',
                    });

                    $('.wpContent--productiveProcesses .tabs > .productiveProcess .contents').slick({
                        infinite: false,
                        slidesToShow: 1,
                        fade: false,
                        dots: false,
                        arrows: false,
                        asNavFor: '.wpContent--productiveProcesses .tabs > .productiveProcess .banners',
                    });
                })
            </script>
        </section>
    </div>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>