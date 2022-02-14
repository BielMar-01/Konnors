<?php
// define the wp_mail_failed callback 
function action_wp_mail_failed($wp_error) {
    return error_log(print_r($wp_error, true));
}

// add the action 
add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);

/**
* Returns the Mailing Variables to send email
*/
function mziq_get_contato_vars($page, $contatoNome, $sendToEmail) {
    if($page == 'fale-com-ri') {
        return array(
            "TO" => $sendToEmail,
            "SUBJECT" => "[Relações com Investidores] Fale com RI - " . $contatoNome, 
            "HEADERS" => array(
                "From: MZiQ <noreply@mziq.com>",
                //'Cc: email-here@mzgroup.com', //CAN'T INCLUDE SAME EMAIL WITH WP_MAIL, MUST BE DIFFERENT THAN TO/BCC
                //'Bcc: email-here@mzgroup.com'
            ),
        );
    }
    else if($page == 'avalie-o-site') {
        return array(
            "TO" => $sendToEmail,
            "SUBJECT" => "[Relações com Investidores] Avaliação Sobre o Site - " . $contatoNome,
            "HEADERS" => array(
                "From: MZiQ <noreply@mziq.com>",
                //'Cc: email-here@mzgroup.com', //CAN'T INCLUDE SAME EMAIL WITH WP_MAIL, MUST BE DIFFERENT THAN TO/BCC
                //'Bcc: email-here@mzgroup.com'
            ),
        );
    }
}

/**
* Adds a contact to the mailing list and sends an email with its information
*/
function mziq_contato_site() {
    $recaptcha_valid = apply_filters('recaptcha_valid', null)  !== false;

    if(!$recaptcha_valid) {
        $result = array(
            "success" => false,
            "message" => __("Captcha Inválido!", LANG_DOMAIN),
            "recaptcha-approved" =>  $recaptcha_valid
        );
        echo json_encode($result);
        exit;
    }

    try {
        $templateContent = null;
        $templateVars = null;
        $inclui_anexo = isset($_POST['inclui_anexo']) ? $_POST['inclui_anexo'] : false;

        // Fale com RI
        $sendToEmail = $_POST["sendToEmail"];
        $page = $_POST['page'];
        $contatoNome = $_POST["contato_nome"];
        $contatoEmail = $_POST["contato_email"];
        $contatoTelefone = $_POST["contato_telefone"];
        $contatoEmpresa = $_POST["contato_empresa"];
        $contatoMensagem = $_POST["contato_mensagem"];

        // $siteQualidadeConteudo = $_POST["site_qualidade_conteudo"];
        // $siteFacilidade = $_POST["site_facilidade"];
        // $siteRapidez = $_POST["site_rapidez"];
        // $siteAdequacaoGrafica = $_POST["site_adequacao_grafica"];
        // $siteTempoCarregamento = $_POST["site_tempo_carregamento"];
        // $siteVariedade = $_POST["site_variedade"];
        // $siteFrequencia = $_POST["site_frequencia"];
        // $siteComentario = $_POST["site_comentario"];

        if($page == 'fale-com-ri') {
            $templateContent = file_get_contents(TEMPLATEPATH . '/email_templates/contato_site.html');
            $templateVars = array(
                '{{name}}'            => $contatoNome,
                '{{email_address}}'   => $contatoEmail,
                '{{contact_phone}}'   => $contatoTelefone,
                '{{company}}'         => $contatoEmpresa,
                '{{mensage}}'         => $contatoMensagem,
            );
        }
        // else if($page == 'avalie-o-site') {
        //     $templateContent = file_get_contents(TEMPLATEPATH . '/email_templates/cadastro_feedback_site.html');
        //     $templateVars = array(
        //         '{{name}}'            => $contatoNome,
        //         '{{email_address}}'   => $contatoEmail,
        //         '{{contact_phone}}'   => $contatoTelefone,
        //         '{{site_qualidade_conteudo}}'  => $siteQualidadeConteudo,
        //         '{{site_facilidade}}'         => $siteFacilidade,
        //         '{{site_rapidez}}'             => $siteRapidez,
        //         '{{site_adequacao_grafica}}'   => $siteAdequacaoGrafica,
        //         '{{site_tempo_carregamento}}'   => $siteTempoCarregamento,
        //         '{{site_variedade}}'   => $siteVariedade,
        //         '{{site_frequencia}}'   => $siteFrequencia,
        //         '{{site_comentario}}'          => $siteComentario,
        //         '{{contato_mensagem}}'         => $contatoMensagem,
        //     );
        // }

        $emailBody = strtr($templateContent, $templateVars);
        $emailConfig = mziq_get_contato_vars($page, $contatoNome, $sendToEmail);

        if(!$inclui_anexo) {
            // Email Content
            $emailResult = wp_mail($emailConfig["TO"], $emailConfig["SUBJECT"], $emailBody, $emailConfig["HEADERS"]);

            // Response
            $result = array(
                "success" => $emailResult === true,
                "message" => $emailResult === true ? __("Mensagem enviada com sucesso!", LANG_DOMAIN) : __("Erro ao enviar mensagem!!!", LANG_DOMAIN),
            );

            echo json_encode($result);
            exit;
        }
        // else {
        //     if (!function_exists('wp_handle_upload')) 
        //         require_once(ABSPATH . 'wp-admin/includes/file.php');
            
        //     $uploadedfile = $_FILES['file'];
        //     $upload_overrides = array('test_form' => false);
        //     $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
        //     $feedback = "";
                
        //     if ($movefile && !isset($movefile['error'])) 
        //         $feedback = "File Upload Successfully - " . $movefile['file'];
        //     else 
        //         $feedback =  $movefile['error'];
            
        //     $emailResult = wp_mail($emailConfig["TO"], $emailConfig["SUBJECT"], $emailBody, $emailConfig["HEADERS"]);

        //     $result = array(
        //                 "success" => $emailResult === true,
        //                 "message" => $emailResult === true ? __("Mensagem enviada com sucesso!", LANG_DOMAIN) : __("Erro ao enviar mensagem!", LANG_DOMAIN),
        //                 "feedback" => $feedback,
        //                 "TO" => $emailConfig["TO"],
        //                 "SUBJECT" => $emailConfig["SUBJECT"],
        //                 "HEADERS" => $emailConfig["HEADERS"]
        //     );
            
        //     echo json_encode($result);
        //     exit;
        // }
    } catch (Exception $e) {
        echo json_encode($e);
        exit;
    }
}

add_action(MZ_AJAX_LOGG_PREFFIX . "mziq_contato_site", "mziq_contato_site");
add_action(MZ_AJAX_ANON_PREFFIX . "mziq_contato_site", "mziq_contato_site");
?>
