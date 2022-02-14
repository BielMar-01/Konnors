<?php global $sectionIndex; ?>
<section class="wpContent--carousel">
    <div class="container">
        <div class="items items-<?php echo $sectionIndex; ?>">
            <?php while(have_rows("carouselItems")): the_row(); ?>
                    <div>
                        <div class="item <?php the_sub_field("carouselItemType") ?>" <?php if(get_sub_field("itemContent")): ?>itemContent="<?php echo str_replace("\"", "'", get_sub_field("itemContent")); ?>"<?php endif; ?> style="background-image: url(<?php the_sub_field("carouselItemIcon") ?>);">
                            <?php if(get_sub_field("carouselItemText")): ?>
                                    <span class="text"><?php the_sub_field("carouselItemText"); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php endwhile; ?>
        </div>
        <div class="itemsPopup" id="itemsPopup">
            <div class="box">
                <button class="close"></button>
                <div class="content"></div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $(".wpContent--carousel .items-<?php echo $sectionIndex; ?>").slick({
                autoplay: false,
                arrows: true,
                slidesToShow: 6,
                prevArrow: "<button class='prev'></button>",
                nextArrow: "<button class='next'></button>",
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            })
        })
    </script>
</section>