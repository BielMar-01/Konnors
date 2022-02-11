<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<?php if(is_home() && !is_front_page()) { ?>
		<title><?php bloginfo('name'); ?> <?php wp_title('-'); ?> <?php the_field('title_seo', get_option('page_for_posts')); ?></title>
		<?php } else { ?>
		<title><?php bloginfo('name'); ?> <?php wp_title('-'); ?> <?php the_field('title_seo'); ?></title>
		<?php } ?>
		<meta name="description" content="<?php bloginfo('name'); ?> <?php wp_title('-'); ?> <?php the_field('description_seo'); ?>">

		<meta property="og:type" content="website"/>
		<meta property="og:title" content="<?php bloginfo('name'); ?> <?php wp_title('-'); ?> <?php the_field('title_seo'); ?>"/>
		<meta property="og:description" content="<?php bloginfo('name'); ?> <?php wp_title('-'); ?> <?php the_field('description_seo'); ?>"/>
		<meta property="og:url" content="<?php bloginfo('url'); ?>"/>
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/og-image.png"/>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Inicio Wordpress Header -->
		<?php wp_head(); ?>
		<!-- Final Wordpress Header -->	
	</head>
	<body>

  <header>
        <div class="container">
            <div class="header">
                <div class="logo">
                    <h2 class="logo"><a href="index.html">Konnors</a></h2>
                </div>
                <div class="nav">
                    <nav id="nav">
                        <button id="btn-mobile" aria-label="Abrir Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
                            <span id="hamburger"></span>
                        </button>
                        <ul role="menu" class="menu" id="menu">
                            <li><a href="">Serviços</a></li>
                            <li><a href="">Templates</a></li>
                            <li><a href="">Planos & Preços</a></li>
                            <li><a href="">Contato</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
		</header>