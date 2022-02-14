<?php 

/* Load CSS Files  */
function wpmziq_theme_styles()
{
    wp_enqueue_style('fonts_css', get_template_directory_uri() . '/fonts/fonts.css');
    wp_enqueue_style('style_css', get_template_directory_uri() . '/style.css', VERSION);
    
    wp_enqueue_style('mziq_stockinfo_css', 'https://s3.amazonaws.com/mz-prd-stockinfo/assets/css/mziq_stockinfo.min.css');
    wp_enqueue_style('jquery-ui-css', get_template_directory_uri() . '/vendor/jquery-ui-1.12.1/jquery-ui.min.css');
}
add_action('wp_enqueue_scripts', 'wpmziq_theme_styles');

/* Update jQuery version */
function replace_core_jquery_version() {
    wp_deregister_script( "jquery" );
    wp_register_script( "jquery", get_template_directory_uri() . "/vendor/jquery-3.5.1.min.js", array(), '3.5.1' );
}
add_action( "wp_enqueue_scripts", "replace_core_jquery_version" );

/* Load JS Files */
function wpmziq_theme_js()
{
    wp_enqueue_script('moment_js', get_template_directory_uri() . '/vendor/moment-2.29.0.min.js');
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/cf5fe8e857.js', array('jquery'));
    wp_enqueue_script('slick_js', get_template_directory_uri() . '/vendor/slick-1.9.0/slick.min.js', array('jquery'));
    wp_enqueue_script('main_js', get_template_directory_uri() . "/js/main.js", array('jquery'), '', true);

    /**
     * FILE MANAGER
     */
    wp_enqueue_script('lodash_js', get_template_directory_uri() .'/js/lodash.min.js', array('jquery'));
    wp_enqueue_script('mz_util_js', get_template_directory_uri() .'/js/file-manager/mz.util.js', array('jquery'));
    wp_enqueue_script('mziq_cmsint_js', get_template_directory_uri() .'/js/file-manager/mziq.cmsint.js', array('jquery', 'mz_util_js'));

    /**
     * EVENTS
    */
    wp_enqueue_script('jquery_ui_min_js', get_template_directory_uri() .'/vendor/jquery-ui-1.12.1/jquery-ui.min.js', array('jquery'));
    wp_enqueue_script('lodash_js', get_template_directory_uri() .'/js/lodash.min.js', array('jquery'));
    wp_enqueue_script('ics_js', get_template_directory_uri()  .'/js/events/ics.js', array('jquery'));
    wp_enqueue_script('mzcalendar_datepicker_js', get_template_directory_uri() .'/js/events/mzcalendar.datepicker.js', array('jquery'));
    wp_enqueue_script('mziqcalendar_pastevents_js', get_template_directory_uri() .'/js/events/mziqcalendar.pastevents.js', array('jquery'));

    if (ICL_LANGUAGE_CODE == 'pt-br') {
        wp_enqueue_script('jquery_ui_pt_br', get_template_directory_uri() .'/js/i18n/datepicker-pt-BR.js', array('jquery'));
    }

    if (ICL_LANGUAGE_CODE == 'en') {
        wp_enqueue_script('datepicker_en_GB', get_template_directory_uri() .'/js/i18n/datepicker-en-GB.js', array('jquery'));
    }

    if (ICL_LANGUAGE_CODE == 'es') {
        wp_enqueue_script('datepicker_es', get_template_directory_uri() .'/js/i18n/datepicker-es.js', array('jquery'));
    }

    /**
     * STOCKINFO & HISTORY
     */
    // if ( is_page_template( 'page-templates/stockinfo.php' ) ) {
        wp_enqueue_script('jquery_ui_min_js', get_template_directory_uri() .'/vendor/jquery-ui-1.12.1/jquery-ui.min.js', array('jquery'));
        wp_enqueue_script('highstock', 'https://code.highcharts.com/stock/highstock.js', array('jquery'));
        wp_enqueue_script('exporting', 'https://code.highcharts.com/stock/modules/exporting.js', array('jquery'));
        wp_enqueue_script('export_data', 'https://code.highcharts.com/stock/modules/export-data.js', array('jquery'));
        wp_enqueue_script('mziq_stockinfo', 'https://s3.amazonaws.com/mz-prd-stockinfo/assets/js/mziq_stockinfo.min.js', array('jquery'));
    // }
    /**
     * STOCKINFO & HISTORY
     */

     /**
     * MAILER
     */
    if ( is_page_template( 'page-templates/mailer-subscribe.php' ) ) {
        wp_enqueue_script('mziq_mailer', get_template_directory_uri() . '/js/mailer-subscribe.js', array('jquery'), VERSION, true);
    }
     /**
      * MAILER
      */

    // Never used but saved for security
    // wp_enqueue_script('filesize_js', 'https://cdnjs.cloudflare.com/ajax/libs/filesize/3.5.10/filesize.min.js', '', VERSION);
}
add_action('wp_enqueue_scripts', 'wpmziq_theme_js');
?>