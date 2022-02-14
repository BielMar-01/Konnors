<?php 
/** CONSTANTS **/
define('MZ_AJAX_LOGG_PREFFIX', 'wp_ajax_');
define('MZ_AJAX_ANON_PREFFIX', 'wp_ajax_nopriv_');
define('VERSION', strval(time()));
define('LANG_DOMAIN', 'brq');

remove_action( 'wp_head', 'remote_login_js_loader' );

/** INCLUDES **/
function includeDir($path) {
    $dir      = new RecursiveDirectoryIterator($path);
    $iterator = new RecursiveIteratorIterator($dir);
    foreach ($iterator as $file) {
        $fname = $file->getFilename();
        if (preg_match('%\.php$%', $fname)) {
            require_once($file->getPathname());
        }
    }
}

includeDir(__DIR__.'/includes/');