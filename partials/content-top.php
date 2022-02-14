<main class="main <?php echo get_field("enablePrinting") === true ? "printingEnabled" : ""; ?>">
    <?php
    if (get_field("banner_internal")) {
        $bannerInternal = get_field("banner_internal");
    } else {
        $bannerInternal = get_template_directory_uri() ."/img/banner_internal.png";
    }
    ?>

    <div class="internal-banner" style="background-image:url(<?php echo $bannerInternal; ?>)">
        <div class="container" style="z-index:1;">
            <?php if ( !is_search() && !is_404() ) { ?>    
                <h1><?php the_title(); ?></h1>
            <?php } else if (is_search()) { ?>
                <h1><?php _e("Resultados da busca", LANG_DOMAIN) ?></h1>
            <?php } else { ?>
                <h1><?php _e("Página não encontrada!", LANG_DOMAIN) ?></h1>
            <?php } ?>

            <!-- Breadcrumbs -->
            <?php wp_custom_breadcrumbs(); ?>
        </div>
    </div>

    <div class="wpContent">
        <button id="print" onclick="print()"></button>

        <?php
            $fmArray = array(
                'page-templates/file-manager.php',
                'page-templates/file-manager-faq.php',
                'page-templates/results-center.php',
            );

            if ( is_page_template($fmArray) ) {
                get_template_part('partials/fm', 'elements');
            }
        ?>