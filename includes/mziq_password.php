<?php 
/** Configura o campo de password para conteúdo protegido **/
function custom_password_form()
{
    global $post;
    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
    ' . __("THIS IS YOUR NEW PASSWORD INTRO TEXT THAT SHOWS ABOVE THE PASSWORD FORM") . '
    <label class="pass-label" for="' . $label . '">' . __("PASSWORD:") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="button btn" value="' . esc_attr__("Submit") . '" />
    </form><p style="font-size:14px;margin:0px;">EXTRA TEXT CAN GO HERE...THIS WILL SHOW BELOW THE FORM</p>
    ';
    return $o;
}
add_filter('the_password_form', 'custom_password_form');

?>