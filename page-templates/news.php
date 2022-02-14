<?php /* Template Name: MZ - Notícias */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>
<section class="wpContent--news">
    <?php the_content(); ?>
</section>
<section class="wpContent--news">
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
                    $thumbnail = wp_get_attachment_image_url(get_field('thumbnail'));

                    if($thumbnail) {
                        $thumbnail = <<<THUMB
                            <div class="thumbnail" style="background-image: url($thumbnail)"></div>
                        THUMB;
                    }

                    $permalink = get_permalink();
                    $seeMore = __('Ver mais', LANG_DOMAIN);

                    echo <<<NEWS
                            <div class="item">
                                $thumbnail
                                <div class="content">
                                    <h3 class="title">$title</h3>
                                    <span class="excerpt">$excerpt</span>
                                    <a href="$permalink" class="link">$seeMore</a>
                                </div>
                            </div>
                    NEWS;
                }

                wp_reset_query();
            ?>
        </div>
    </div>
</section>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>