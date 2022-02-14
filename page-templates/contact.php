<?php /* Template Name: MZ - Contact Us */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>
<div class="wpContent--contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 form">
                <?php get_template_part( 'partials/contact', 'form' ); ?>
            </div>
            <div class="col-sm-6 contactBlocks">
                <?php 
                    while( have_rows('bloco_de_texto') ) { the_row();
                        $title = get_sub_field('titulo');
                        $content = get_sub_field('texto');

                        echo <<<CONTACT
                            <div class="item">
                                <h6>$title</h6>
                                $content
                            </div>
                        CONTACT;
                    } 
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    get_template_part('partials/contact', 'script');

    get_template_part('partials/content', 'bottom');
    get_footer();
?>