var api_base_url = "https://apicatalog.mziq.com/mailer";
var termsDict = [
    // en-US
    {
        blacklistMessage: "This email is on the blacklist of this company and therefore can not be registered!",
        cancel: "Cancel",
        company: "Company",
        fillCompanyField: "Fill company field!",
        fillGroupField: "Select a group!",
        fillEmailField: "Fill e-mail field!",
        fillNameField: "Fill name field!",
        fillProfileField: "Fill profile field!",
        groups: "Language",
        name: "Name",
        profile: "Profile",
        send: "Send",
        subscribedSuccessfully: "Subscribed succesfully!",
        unexpectedError: "Unexpected error on register!",
        errorCaptcha: "There was a problem validating Captcha!",
    },
    // pt-BR
    {
        blacklistMessage: "Este email está na blacklist desta empresa e por isso, não pode ser cadastrado!",
        cancel: "Cancelar",
        company: "Empresa",
        fillCompanyField: "Preencha o campo empresa!",
        fillGroupField: "Selecione um grupo!",
        fillEmailField: "Preencha o campo e-mail!",
        fillNameField: "Preencha o campo nome!",
        fillProfileField: "Preencha o campo perfil!",
        groups: "Idioma",
        name: "Nome",
        profile: "Perfil",
        send: "Enviar",
        subscribedSuccessfully: "Cadastrado com sucesso!",
        unexpectedError: "Erro inesperado ao efetuar registro!",
        errorCaptcha: "Houve um problema na validação do Captcha!",
    },
    // es-ES
    {
        blacklistMessage: "¡Este correo electrónico está en el blacklist de esta empresa y por eso, no puede ser registrado!",
        cancel: "Cancelar",
        company: "Compañia",
        fillCompanyField: "Rellene el campo compañia!",
        fillGroupField: "Seleccione un grupo!",
        fillEmailField: "Rellene el campo e-mail!",
        fillNameField: "Rellene el campo nombre!",
        fillProfileField: "Rellene el campo perfil!",
        groups: "Seleccione los grupos",
        name: "Nombre",
        profile: "Perfil",
        send: "Enviar",
        subscribedSuccessfully: "¡Catastrado con éxito!",
        unexpectedError: "Error inesperado al registrar!",
        errorCaptcha: "Houve um problema na validação do Captcha!",
    },
];
var terms = null;

// Globalize terms according the page language
function globalize_terms() {
    switch (language.toLowerCase()) {
        case "en-us":
            terms = termsDict[0];
            break;
        case "es-es":
            terms = termsDict[2];
            break;
        default:
            terms = termsDict[1];
            break;
    }
    document.getElementById("label_name").innerHTML = terms["name"];
    document.getElementById("label_email").innerHTML = "E-mail";
    document.getElementById("label_company").innerHTML = terms["company"];
    // document.getElementById("label_profile").innerHTML = terms["profile"];
    // document.getElementById("label_groups").innerHTML = terms["groups"];
}

// Get api data and fill profile select
function load_profiles() {
    var ajax = new XMLHttpRequest();
    var targetUrl = api_base_url + "/profiles";

    ajax.open("GET", targetUrl, true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                var sl_profiles = document.getElementById("sl_profiles"); // profiles select
                var perfis = JSON.parse(ajax.responseText).data; // profile array

                // insere na primeira posição.
                perfis.unshift({
                    profile_id: 0,
                    name_pt: "Selecione",
                    name_en: "Select your profile",
                    name_es: "Seleccione",
                });

                // popula select.
                for (var i = 0; i < perfis.length; i++) {
                    var text = "";
                    switch (language.toLowerCase()) {
                        case "pt-br":
                            text = perfis[i].name_pt;
                            break;
                        case "en-us":
                            text = perfis[i].name_en;
                            break;
                        case "es-es":
                            text = perfis[i].name_es;
                            break;
                    }

                    sl_profiles.options[i] = new Option(
                        text,
                        perfis[i].profile_id
                    );
                }
            } else {
                alert("Erro inesperado ao recuperar perfis!");
                // console.dir(ajax);
            }
        }
    };
}

// Get api data and fill groups select
function load_groups() {
    var ajax = new XMLHttpRequest();
    var targetUrl = api_base_url + "/public/company/" + fmId + "/group/language/" + language;

    ajax.open("GET", targetUrl, true);
    ajax.send();

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                var sl_groups = document.getElementById("sl_groups"); // groups select
                var groups = JSON.parse(ajax.responseText).data; // groups array

                // fill select field
                for (var i = 0; i < groups.length; i++) {
                    sl_groups.options[i] = new Option(groups[i].group_name, groups[i].group_id);
                }
            } else {
                alert("Erro inesperado ao recuperar grupos!");
            }
        }
    };
}

// Submit form to api
function submit_form() {
    var name = document.getElementById("txt_name").value.trim();
    var email = document.getElementById("txt_email").value.trim();
    var company = document.getElementById("txt_company").value.trim();
    var profile = document.getElementById("sl_profiles").value;
    var vrecaptcha = grecaptcha.getResponse();

    var sl_groups = document.getElementById("sl_groups");
    var selected_groups = [];

    for (var i = 0; i < sl_groups.length; i++) {
        if (sl_groups[i].selected) selected_groups.push(sl_groups[i].value);
    }

    if (!validate_form(name, email, company, profile, selected_groups, vrecaptcha))
        return;

    var body = {
        contact: {
            company_id: fmId,
            name: name,
            email: email,
            company: company,
            profile: profile,
            origin: 1, // Site
        },
        groups: selected_groups,
        captchaResult: vrecaptcha,
    };

    var ajax = new XMLHttpRequest();
    var targetUrl = api_base_url + "/public/company/" + fmId + "/contact/register";

    ajax.open("POST", targetUrl, true);
    ajax.setRequestHeader("Content-Type", "application/json");
    ajax.send(JSON.stringify(body));

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status === 200) {
                var response = JSON.parse(ajax.responseText);
                var result_code = response.data.result;

                if (result_code === "CONTACT_BLACKLISTED") {
                    alert(terms.blacklistMessage);
                    clear_form();
                } else if (
                    result_code === "CONTACT_SUBSCRIBED" ||
                    result_code === "CONTACT_UPDATED"
                ) {
                    alert(terms.subscribedSuccessfully);
                    clear_form();
                } else {
                    alert(terms.unexpectedError);
                }
            } else if (ajax.status === 400) {
                var response = JSON.parse(ajax.responseText);
                var result_code = response.message;

                switch (result_code) {
                    case "INVALID_CAPTCHA":
                        alert(terms.errorCaptcha);
                        console.log("INVALID_CAPTCHA");
                        clear_form();
                        break;

                    case "CAPTCHA_NOT_PROVIDED":
                        alert(terms.errorCaptcha);
                        console.log("CAPTCHA_NOT_PROVIDED");
                        clear_form();
                        break;

                    case "CAPTCHA_NOT_CONFIGURED":
                        alert(terms.errorCaptcha);
                        console.log("CAPTCHA_NOT_CONFIGURED");
                        clear_form();
                        break;
                }
            } else {
                alert(terms.unexpectedError);
            }
        }
    };
}

// Form validation
function validate_form(name, email, company, profile, selected_groups, vrecaptcha) {
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    if (name.trim() === "") {
        document.getElementById("txt_name").focus();
        alert(terms.fillNameField);
        return false;
    }

    if (!filter.test(email)) {
        alert('Preencha o campo e-mail');
        document.getElementById("txt_email").focus();
        return false;
    }

    if (company.trim() === "") {
        document.getElementById("txt_company").focus();
        alert(terms.fillCompanyField);
        return false;
    }

    if (profile === "0") {
        alert(terms.fillProfileField);
        return false;
    }

    if (selected_groups.length === 0) {
        document.getElementById("sl_groups").focus();
        alert(terms.fillGroupField);
        return false;
    }

    if (vrecaptcha === "") {
        alert("RECAPTCHA INVÁLIDO");
        return false;
    }

    return true;
}

// Reset the form
function clear_form() {
    document.getElementById("txt_name").value = "";
    document.getElementById("txt_email").value = "";
    document.getElementById("txt_company").value = "";
    document.getElementById("sl_profiles").selectedIndex = 0;
    document.getElementById("sl_groups").value = "";
    grecaptcha.reset();
}

document.getElementById("btn_send")?.addEventListener("click", function (event) {
    event.preventDefault();

    // if (!document.getElementById("termos").checked) {
    //     alert("É necessário aceitar os termos de privacidade do site!");
    //     return;
    // }

    submit_form();
});

document.getElementById("btn_cancel")?.addEventListener("click", function (event) {
    clear_form()
});

(function () {
    globalize_terms();
    load_profiles();
    load_groups();
})();

window.addEventListener("mousedown", function(e) {
    var el = e.target;
    if(e.button !== 0) return;

    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
        e.preventDefault();

        // toggle selection
        if (el.hasAttribute('selected')) el.removeAttribute('selected');
        else el.setAttribute('selected', '');

        // hack to correct buggy behavior
        var select = el.parentNode.cloneNode(true);
        el.parentNode.parentNode.replaceChild(select, el.parentNode);
    }
});