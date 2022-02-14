<?php /* Template Name: MZ - Glossário */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>
    <div class="wpContent--glossary">
        <div class="container">
            <?php the_content(); ?>
            <div class="items">
                <?php
                    while (have_rows('faqs')) { the_row();
                        echo '<div class="accordion__item glossary">';
                ?>
                        <div class="accordion__item__header"><?php the_sub_field('title'); ?></div>
                        <div class="accordion__item__content">
                            <table class="glossary">
                                <tbody>
                                    <?php 
                                        while(have_rows('words')) { the_row();
                                            $word = get_sub_field('word');
                                            $description = get_sub_field('description');

                                            echo <<<TR
                                                <tr>
                                                    <td>$word</td>
                                                    <td>$description</td>
                                                </tr>
                                            TR;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                <?php
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>