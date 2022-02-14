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
  
    <script>
        const fmId = '<?php echo get_option('mziq_fm_company_id'); ?>';
        const fmName = '<?php echo get_option('company_name'); ?>';
        const fmBase = '<?php echo get_option( 'mziq_fm_base_uri' ); ?>';
        const i18nShortQuarter = '<?php if (ICL_LANGUAGE_CODE == "en") { echo "Q"; } else { echo "T"; } ?>';
        const language = '<?php echo getI18NLanguageCodeForMailing(); ?>';
        const filingLang = '<?php echo getI18NLanguageCodeForApi(); ?>'

        const noFiles = "<?php _e("Nenhum arquivo encontrado.", LANG_DOMAIN); ?>";
        const copied = "<?php echo ICL_LANGUAGE_CODE === "en" ? "Link copied" : "Link copiado"; ?>";
    </script>

    <?php wp_head(); ?>
    
    <script>
        const $ = jQuery.noConflict();
        const lang = "<?php echo ICL_LANGUAGE_CODE ?>";

        const i18nDateFormat = '<?php i18n_date_js_format();?>';
        const baseEventsUrl = "https://apicatalog.mziq.com/events/events";
        const ajaxurlPast = baseEventsUrl + "/past/" + fmId + "/" + lang;
        const ajaxurlCalendar = baseEventsUrl + "/calendar/" + fmId + "/" + lang;
        const ajaxurlFuture = baseEventsUrl + "/future/" + fmId + "/" + lang;
        
        <?php if ( is_page_template( 'page-templates/contact.php' ) ) { ?>
            const ajaxurl = '<?php echo get_site_url() .'/wp-admin/admin-ajax.php?lang=' . ICL_LANGUAGE_CODE ?>';
        <?php } ?>
        
        const stockInfoId = '<?php echo get_option('prices_key');?>';
        const langCode = '<?php echo apply_filters('wpml_current_language', NULL);  ?>';
        const langCodeFormatted = langCode.split('-')[0];
    </script>
</head>

<body id="lang-<?php echo ICL_LANGUAGE_CODE ?>" <?php  body_class(); ?>>
<?php get_template_part('partials/header', 'global'); ?>