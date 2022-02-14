<?php
    /* Template Name: Home Page */
    get_header();
?>
<div class="homepage">
    <section class="banner">
        <div class="items">
            <?php while(have_rows("banner_items")) { the_row(); ?>
                <div>
                    <div class="item" style="background-image: url('<?php the_sub_field("banner_image"); ?>');">
                        <?php
                            if(!get_sub_field("isImage")) {
                                $video = get_sub_field("banner_video");

                                echo "<video src='$video' playsinline autoplay muted loop controls='false'></video>";
                            }
                        ?>
                        <div class="container">
                            <div class="box">
                                <?php
                                    the_sub_field('content');

                                    $btn = get_sub_field('btn');
                                    if(@$btn['title']){
                                        echo <<<BUTTON
                                            <a class="btn" href="{$btn['url']}" target="{$btn['target']}">{$btn['title']}</a>
                                        BUTTON;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <section class="highlights">
            <div class="container">
                <div class="items">
                    <?php
                        while(have_rows("highlights")){ the_row();
                            $title = get_sub_field("highlight_title");
                            $link = get_sub_field("highlight_link");
                            $icon = get_sub_field("highlight_icon");

                            echo <<<HIGHLIGHT
                                <div style="text-align: center;">
                                    <a href="$link" class="highlight">
                                        <i class="icon" style="background-image: url($icon);"></i>
                                        <span class="title">$title</span>
                                    </a>
                                </div>
                            HIGHLIGHT;
                        }
                    ?>
                </div>
            </div>
            <script src="<?php echo get_template_directory_uri(); ?>/vendor/slick-1.9.0/slick.min.js"></script>
            <script> 
                $(function(){
                    $("section.banner > .items").slick({
                        autoplay: true,
                        arrows: false,
                        dots: false,
                        slidesToShow: 1,
                        prevArrow: '<button class="prev"></button>',
                        nextArrow: '<button class="next"></button>',
                        responsive: [
                            {
                                breakpoint: 1200,
                                settings: {
                                    arrows: false
                                }
                            }
                        ]
                    });

                    $("section.highlights .items").slick({
                        autoplay: false,
                        arrows: false,
                        slidesToShow: 4,
                        infinite: false,
                        prevArrow: "<button class='prev'></button>",
                        nextArrow: "<button class='next'></button>",
                        responsive: [
                            {
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 2,
                                    centerMode: true
                                }
                            }
                        ]
                    });
                });
            </script>
        </section>
    </section>

    <section class="presentation">
        <?php 
            $presentation = get_field('presentation');
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="picture">
                        <div class="bg" style="background-image: url(<?php echo $presentation['picture']['url']; ?>)"></div>
                        <span class="title"><?php echo $presentation['picture']['title'] ?></span>
                    </div>
                </div>
                <div class="col-xl-6 content">
                    <?php echo $presentation['content']; ?>
                    <a class="link btn md" href="<?php echo $presentation['btn']['url']; ?>" target="<?php echo $presentation['btn']['target']; ?>"><?php echo $presentation['btn']['title']; ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="ourNumbers">
        <div class="container">
            <div class="items">
                <?php 
                    foreach(get_field("numbers") as $item) {
                        $precision = count(explode('.', $item["value"])) < 2 ? 0 : strlen($item["value"]) - strrpos($item["value"], '.') - 1;
                        $number = number_format_i18n((float)$item["value"], $precision);
                        $growThis = $item["value"] ? 'growThis' : '';
                        
                        echo <<<VALUE
                            <div>
                                <div class="item">
                                    <i class="icon" style="background-image: url({$item["icon"]})"></i>
                                    <span class="value $growThis" value="{$item["value"]}" prefix="{$item["prefix"]}" suffix="{$item["suffix"]}"></span>
                                    <span class="description">{$item["description"]}</span>
                                </div>
                            </div>
                        VALUE;
                    }
                ?>
            </div>
        </div>
        <script>
            $(function(){
                $("section.ourNumbers .items").slick({
                    autoplay: false,
                    arrows: false,
                    slidesToShow: 6,
                    infinite: false,
                    prevArrow: "<button class='prev'></button>",
                    nextArrow: "<button class='next'></button>",
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 2
                            }
                        }
                    ]
                });
            })
        </script>
    </section>

    <section class="videoBySide">
        <?php 
            $videoBySide = get_field('videoBySide');
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <?php echo $videoBySide['content']; ?>
                    <a class="btn" href="<?php echo $videoBySide['btn']['url']; ?>" target="<?php echo $videoBySide['btn']['target']; ?>"><?php echo $videoBySide['btn']['title']; ?></a>
                </div>
                <div class="col-xl-6">
                    <?php echo $videoBySide['videoContent']; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="lastNews">
        <div class="container">
            <?php 
                $query = new WP_Query(
                    array(
                        'post_type'         => 'news',
                        'posts_per_page'    => 8,
                    )
                );
                
                $seeAllBtn = get_field('lastNewsBtn');
                echo '<div class="content">';
                the_field('newsContent');
                echo '</div>'
            ?>
            <div class="news">
                <?php
                    while($query->have_posts()) { $query->the_post();
                        $title = get_the_title();
                        $excerpt = get_the_excerpt();

                        $thumbnail = wp_get_attachment_image_url(get_field('thumbnail'), 'full');

                        if($thumbnail) {
                            $thumbnail = <<<THUMB
                                <div class="thumbnail" style="background-image: url($thumbnail)"></div>
                            THUMB;
                        }

                        $permalink = get_permalink();
                        $seeMore = __('Ver mais', LANG_DOMAIN);

                        echo <<<NEWS
                            <div>
                                <div class="item">
                                    $thumbnail
                                    <div class="content">
                                        <h3 class="title">$title</h3>
                                        <span class="excerpt">$excerpt</span>
                                        <a href="$permalink" class="link">$seeMore</a>
                                    </div>
                                </div>
                            </div>
                        NEWS;
                    }

                    wp_reset_query();
                ?>
            </div>
            <a href="<?php echo $seeAllBtn['url']; ?>" target="<?php echo $seeAllBtn['target']; ?>" class="btn seeMore"><?php echo $seeAllBtn['title']; ?></a>
        </div>
    </section>
</div>
<input type="checkbox" class="hiddenToggle" id="popupToggle" checked>
<?php
    get_template_part( 'partials/popup', 'desktop' );
    get_template_part( 'partials/popup', 'mobile' );
    get_footer();
?>