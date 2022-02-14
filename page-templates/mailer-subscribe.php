<?php /* Template Name: MZ - Mailer subscribe */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>

<div class="wpContent--mailer container">
    <form metod="post" class="custom_form form-send-mail mailing">
        <!-- <h3 class="title"><?php _e("Cadastre-se para receber nossas informações por e-mail:", LANG_DOMAIN); ?></h3> -->
        <input type="hidden" name="action" value="mziq_contato_site">
        <input type="hidden" name="page" value="notificacion-email">

        <fieldset>
            <label id="label_name" for="txt_name"><?php _e("Nome", LANG_DOMAIN); ?></label>
            <input class="" type="text" id="txt_name" placeholder="" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required />
        </fieldset>

        <fieldset>
            <label id="label_email" for="txt_email"><?php _e("E-mail", LANG_DOMAIN); ?></label>
            <input class="" type="email" id="txt_email" placeholder="" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required />
        </fieldset>

        <fieldset>
            <label id="label_company" for="txt_company"><?php _e("Empresa", LANG_DOMAIN); ?></label>
            <input class="" type="text" id="txt_company" placeholder="" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required />
        </fieldset>

        <fieldset class="list">
            <label id="label_profile" for="sl_profiles"><?php _e("Perfil", LANG_DOMAIN); ?></label>
            <select id="sl_profiles">
                <option>
                    <?php _e("Carregando...", LANG_DOMAIN); ?>
                </option>
            </select>
        </fieldset>

        <fieldset class="list">
            <label class="multiple" id="label_groups" for="sl_groups"></label>
            <div class="select__multiple">
                <select class="select__multiple--options" id="sl_groups" placeholder="<?php _e("Grupo", LANG_DOMAIN); ?>" size="3" multiple></select>
            </div>
        </fieldset>

        <fieldset class="terms">
            <input type="checkbox" class="input-check" id="termos" name="termos" onchange="document.querySelector('.btn[type=submit]').disabled = !this.checked;">
            <label for="termos" class="label-check"><?php the_field("termsAcceptanceText", "options"); ?></label>
        </fieldset>
        <!-- <textarea class="terms mb-4" rows="10" readonly><?php the_field("privacyTerms", "options"); ?></textarea> -->

        <fieldset>
            <?php
                $attr = array( 'data-theme' => 'light' );
                do_action( 'recaptcha_print' , $attr );
            ?>
        </fieldset>

        <button id="btn_send" class="btn btn-submit" type="submit" disabled><?php _e('Enviar',LANG_DOMAIN);?></button>
    </form>
</div>

<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>