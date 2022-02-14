<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
<script>
    $('#contato_nome').blur(function() {
        var contatoNome = $('#contato_nome').val().trim();
        var filterName = /(?<!\S)[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ]+(?!\S)/g;
        if (contatoNome == "") {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_nome').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector(".error_nome").style.display = "";
            return false;
        } else if (contatoNome.length < 3) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_nome').innerText = '<?php _e('Por favor, forneça ao menos 3 caracteres.', LANG_DOMAIN); ?>';
            document.querySelector(".error_nome").style.display = "";
            return false;
        } else if (!filterName.test(contatoNome)) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_nome').innerText = '<?php _e('O campo deve conter apenas letras e apenas um espaço entre palavras.', LANG_DOMAIN); ?>';
            document.querySelector(".error_nome").style.display = "";
            return false;
        } else {
            document.querySelector('.error_nome').style.display = "none";
            $(this).removeClass('invalid');
            $(this).addClass('valid');
        }
    });

    $('#contato_email').blur(function() {
        var contatoEmail = $('#contato_email').val().trim();
        var filterMail = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if ((contatoEmail == "")) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_email').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_email').style.display = "";
            return false;
        } else if (!filterMail.test(contatoEmail)) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_email').innerText = '<?php _e('Por favor, forneça um endereço de email válido.', LANG_DOMAIN); ?>';
            document.querySelector('.error_email').style.display = "";
            return false;
        } else {
            document.querySelector('.error_email').style.display = "none";;
            $(this).removeClass('invalid');
            $(this).addClass('valid');
        }
    });

    $('#contato_telefone')
        .mask("(99) 9999-99999")
        .focusout(function(event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(99) 99999-9999");
            } else {
                element.mask("(99) 9999-99999");
            }
    });
    
    $('#contato_telefone').blur(function() {
        var contatoTelefone = $('#contato_telefone').val().trim();
        var filterPhone = /(\(\d{2}\)\s)(\d{4,5}\-\d{4})/g;
        if ((contatoTelefone == "")) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_telefone').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_telefone').style.display = "";
            return false;
        } else if (!filterPhone.test(contatoTelefone)) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_telefone').innerText = '<?php _e('Por favor, forneça um telefone válido.', LANG_DOMAIN); ?>';
            document.querySelector('.error_telefone').style.display = "";
            return false;
        } else {
            document.querySelector('.error_telefone').style.display = "none";
            $(this).removeClass('invalid');
            $(this).addClass('valid');
        }
    });

    $('#contato_empresa').blur(function() {
        var contatoEmpresa = $('#contato_empresa').val().trim();
        if ((contatoEmpresa == "")) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_empresa').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_empresa').style.display = "";
            return false;
        } else if (contatoEmpresa.length < 3) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_empresa').innerText = '<?php _e('Por favor, forneça ao menos 3 caracteres.', LANG_DOMAIN); ?>';
            document.querySelector('.error_empresa').style.display = "";
            return false;
        } else {
            document.querySelector('.error_empresa').style.display = "none";
            $(this).removeClass('invalid');
            $(this).addClass('valid');
        }
    });

    $('#contato_mensagem').blur(function() {
        var contatoMensagem = $('#contato_mensagem').val().trim();
        var filterMensagem = /(?<!\S)[0-9A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ]+(?!\S)/g;
        if ((contatoMensagem == "")) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_mensagem').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_mensagem').style.display = "";
            return false;
        } else if (contatoMensagem.length < 10) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_mensagem').innerText = '<?php _e('Por favor, forneça ao menos 10 caracteres.', LANG_DOMAIN); ?>';
            document.querySelector('.error_mensagem').style.display = "";
            return false;
        } else if (!filterMensagem.test(contatoMensagem)) {
            this.classList.remove("valid");
            $(this).addClass('invalid');
            document.querySelector('.error_mensagem').innerText = '<?php _e('O campo deve conter apenas letras, números e apenas um espaço entre palavras.', LANG_DOMAIN); ?>';
            document.querySelector('.error_mensagem').style.display = "";
            return false;
        } else {
            document.querySelector('.error_mensagem').style.display = "none";
            $(this).removeClass('invalid');
            $(this).addClass('valid');
        }
    });

    document.querySelector('.g-recaptcha').addEventListener('click', function() {
        document.querySelector('.error_captcha').style.display = "none";
        // function isCaptchaChecked() {
        //   return grecaptcha && grecaptcha.getResponse().length !== 0;
        // }

        // if (isCaptchaChecked()) {
        // }

    });

    const form = document.getElementById("contact_form");

    form.addEventListener("submit", function(e) {
        e.preventDefault();
        document.querySelector(".fail-box").style.display = "";
        
        const contatoNome = document.getElementById('contato_nome')?.value;
        const contatoTelefone = document.getElementById('contato_telefone')?.value;
        const contatoEmail = document.getElementById('contato_email')?.value;
        const contatoEmpresa = document.getElementById('contato_empresa')?.value;
        const contatoMensagem = document.getElementById('contato_mensagem')?.value;
        const sendToEmail = document.getElementById('send_to_email')?.value;
        const terms = document.getElementById('terms');
        const vrecaptcha = grecaptcha.getResponse();

        //validar campos
        const filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

        if (contatoNome == "") {
            this.classList.remove("valid");
            document.querySelector('.error_nome').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector(".error_nome").style.display = "";
        }

        if ((contatoEmail == "")) {
            this.classList.remove("valid");
            document.querySelector('.error_email').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_email').style.display = "";
        }

        if ((contatoTelefone == "")) {
            this.classList.remove("valid");
            document.querySelector('.error_telefone').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_telefone').style.display = "";
        }

        if ((contatoEmpresa == "")) {
            this.classList.remove("valid");
            document.querySelector('.error_empresa').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_empresa').style.display = "";
        }

        if ((contatoMensagem == "")) {
            this.classList.remove("valid");
            document.querySelector('.error_mensagem').innerText = '<?php _e('Campo obrigatório.', LANG_DOMAIN); ?>';
            document.querySelector('.error_mensagem').style.display = "";
        }

        if (document.getElementById('contato_nome')?.classList.contains('valid') && document.getElementById('contato_email')?.classList.contains('valid') && document.getElementById('contato_telefone')?.classList.contains('valid') && document.getElementById('contato_empresa')?.classList.contains('valid') && document.getElementById('contato_mensagem')?.classList.contains('valid')) {
            document.getElementById('contact_form').classList.add('validationClear');
        }

        if (vrecaptcha === "") {
            document.querySelector('.error_captcha').style.display = "";
            document.querySelector('.error_captcha').innerText = '<?php _e("Preencha o captcha", LANG_DOMAIN); ?>';
            return false;
        }

        var reqContactIR = {
            action: 'mziq_contato_site',
            page: 'fale-com-ri',
            contato_nome: contatoNome,
            contato_telefone: contatoTelefone,
            contato_email: contatoEmail,
            contato_empresa: contatoEmpresa,
            contato_mensagem: contatoMensagem,
            sendToEmail: sendToEmail,
            "g-recaptcha-response": vrecaptcha
        };

        const ajax = new XMLHttpRequest();
        ajax.open("POST", ajaxurl);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function(res, e) {
            console.log(res, e);
            if (ajax.readyState == 4) {
                var result = JSON.parse(res.target.response);

                if (ajax.status === 200) {
                    if (result.success == true) {
                        document.getElementById("contact_form").remove();
                        document.querySelector(".success-box").style.display = "block";
                    }else {
                        document.querySelector(".fail-box").style.display = "block";
                        form.reset();
                    }
                }else {
                    form.reset();
                    alert("Error: " + result.message);
                }

                grecaptcha.reset();
            }
        };

        var reqItems = [];
        for(key in reqContactIR) {
            reqItems.push(encodeURIComponent(key) +"="+ encodeURIComponent(reqContactIR[key]));
        }

        ajax.send(reqItems.join('&'));
    })
</script>