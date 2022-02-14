<form id="contact_form" class="custom_form talkIr">
    <input type="hidden" name="page" id="send_to_email" value="<?php the_field('talkToRiEmail'); ?>">

    <fieldset>
        <label for="contato_nome"><?php _e('Nome', LANG_DOMAIN); ?></label>
        <input name="nome" id="contato_nome" type="text" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required>
        
        <span class="error error_nome" style="display: none;"></span>
    </fieldset>

    <fieldset>
        <label for="contato_email"><?php _e('E-mail', LANG_DOMAIN); ?></label>
        <input name="email" id="contato_email" type="email" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required>

        <span class="error error_email" style="display: none;"></span>
    </fieldset>

    <fieldset>
        <label for="contato_telefone"><?php _e('Telefone', LANG_DOMAIN); ?></label>
        <input name="telefone" id="contato_telefone" type="text" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required>

        <span class="error error_telefone" style="display: none;"></span>
    </fieldset>

    <fieldset>
        <label for="contato_empresa"><?php _e('Empresa', LANG_DOMAIN); ?></label>
        <input name="empresa" id="contato_empresa" type="text" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" >

        <span class="error error_empresa" style="display: none;"></span>
    </fieldset>

    <fieldset>
        <label for="contato_mensagem"><?php _e('Mensagem', LANG_DOMAIN); ?></label>
        <textarea name="mensagem" rows="3" cols="10" id="contato_mensagem" placeholder="" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required></textarea>

        <span class="error error_mensagem" style="display: none;"></span>
    </fieldset>

    <fieldset class="terms">
        <input type="checkbox" class="input-check" id="termos" name="termos" onchange="document.querySelector('.btns .submit').disabled = !this.checked;">
        <label for="termos" class="label-check"><?php the_field("termsAcceptanceText", "options"); ?></label>
    </fieldset>
    <!-- <textarea class="terms mb-4" rows="10" readonly><?php the_field("privacyTerms", "options"); ?></textarea> -->

    <fieldset>
        <?php
            // RECAPTCHA - PASSO 1
            $attr = array(
                'data-theme' => 'light',
            );
            do_action('recaptcha_print', $attr);
        ?>
        <span class="error error_captcha" style="display: none;"></span>
    </fieldset>

    <div class="btns">
        <button type="submit" class="btn submit" disabled><?php _e('Enviar', LANG_DOMAIN); ?></button>
        <button type="button" class="btn alt" onclick="contact_form.reset(); grecaptcha.reset();"><?php _e('Limpar', LANG_DOMAIN); ?></button>
    </div>
</form>
<div class="success-box">
    <?php _e('E-mail enviado com sucesso!', LANG_DOMAIN); ?>
</div>

<div class="fail-box">
    <?php _e('Ocorreu um erro, tente novamente mais tarde.', LANG_DOMAIN); ?>
</div>