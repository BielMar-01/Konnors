<?php 

/** Add theme support for menus **/
add_theme_support('menus');

/** Register Theme's menus **/
function register_theme_menus()
{
    register_nav_menus(
        array(
            'primary-menu'  => 'Menu principal',
            'top-menu'      => "Menu do topo",
            'footer-menu'   => "Menu do Footer"
        ),
    );
}
add_action('init', 'register_theme_menus');

// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function mz_wp_title($title, $sep) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Página %s', 'startertheme' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mz_wp_title', 10, 2 );

// Disable the emoji's
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// Filter function used to remove the tinymce emoji plugin.
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
?>