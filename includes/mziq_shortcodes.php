<?php 
//Shortcodes
add_shortcode('iframe', 'mzsc_iframe');
function mzsc_iframe($atts, $content) {
 if (!$atts['width']) { $atts['width'] = 630; }
 if (!$atts['height']) { $atts['height'] = 1500; }
 return '<iframe class="shortcode_iframe" src="' . $atts['src'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . ' frameborder="'.$atts['frameborder'].'  scrolling="'.$atts['scrolling'].'" "></iframe>';
}

?>