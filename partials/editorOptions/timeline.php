<div id="timelineCarousel<?php echo $args['index']; ?>" class="wpContent--timeline <?php the_sub_field("customClass") ?>">
    <div class="container">
        <div class="items" >
            <?php while( have_rows('timeline') ) : the_row(); ?>
                <div>
                    <div class="item">
                        <div class="year" style="border-color: <?php the_sub_field('yearColor'); ?>; color: <?php the_sub_field('yearColor'); ?>"><?php the_sub_field('timeline_year'); ?></div>
                        <div class="content">
                            <?php the_sub_field('timeline_content'); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/vendor/slick-1.9.0/slick.min.js"></script>
<script>
    $('#timelineCarousel<?php echo $args['index']; ?> .items').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="prev"></button>',
        nextArrow: '<button class="next"></button>',
        focusOnSelect: true,
        infinite: true,
        swipeToSlide: true,
        centerMode: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                }
            }
        ]
    });
</script>