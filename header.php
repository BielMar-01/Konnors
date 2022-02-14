<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php echo ICL_LANGUAGE_CODE ?>">
<!-- script_path: <?php echo basename(__FILE__, ''); ?> -->
<head>
    <title><?php wp_title('-', true, 'right'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="<?php echo ICL_LANGUAGE_CODE ?>">

    <link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/img/favicon.png" />

    <?php wp_head(); ?>
</head>

<body id="lang-<?php echo ICL_LANGUAGE_CODE ?>" <?php  body_class(); ?>>
<?php get_template_part('partials/header', 'global'); ?>