<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php echo ICL_LANGUAGE_CODE ?>">
<!-- script_path: <?php echo basename(__FILE__, ''); ?> -->
<head>
    
    <title><?php bloginfo('name')?> <?php wp_title() ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="<?php echo ICL_LANGUAGE_CODE ?>">
    
    <link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/img/favicon.png" />
    
    <?php wp_head(); ?>
</head>

<body id="lang-<?php echo ICL_LANGUAGE_CODE ?>" <?php  body_class(); ?>>
    <header class="header">
        <div class="container">
            <div class="header__top">
                <h2 class="logo"><a href="<?php the_field('logo_link', 'option'); ?>">Konnors</a></h2>
                <?php
                        $args = array(
                            'menu' => 'Primary Menu',
                            'theme_location' => 'primary_menu',
                            'container' => false
                        );
                        wp_nav_menu( $args );
                    ?>
            </div>
            <div class="text__banner">
                <p><?php the_field('banner_text'); ?></p>
            </div>
            <div class="arrow">
                <img src="<?php echo get_template_directory_uri()?>img/Arrow.png" alt="Arrow">
            </div>
        </div>
    </header>