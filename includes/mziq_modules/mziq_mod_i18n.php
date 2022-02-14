<?php

function getI18NLanguageCodeForApi()
{
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        return "pt_BR";
    } else if (ICL_LANGUAGE_CODE == 'en') {
        return "en_US";
    } else if (ICL_LANGUAGE_CODE == 'es') {
        return "es_ES";
    }
}
function getI18NLanguageCodeForMailing()
{
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        return "pt-BR";
    } else if (ICL_LANGUAGE_CODE == 'en') {
        return "en-US";
    } else if (ICL_LANGUAGE_CODE == 'es') {
        return "es-ES";
    }
}
function getDateFieldAsShortDateI18N($postId, $fieldName)
{
    $dateField = get_post_meta($postId, $fieldName, true);
    $dateObj = DateTime::createFromFormat('Ymd', $dateField);
    return date_i18n(getShortDateFormat(), $dateObj->getTimestamp());
}

function getDateTimeFieldAsShortDateI18N($postId, $fieldName)
{
    try {
        $dateField = get_post_meta($postId, $fieldName, true);
        if ($dateField === '') {
            return "";
        }

        $tmp = $dateField;
        $dateObj = DateTime::createFromFormat('U', $dateField);
        $dateAsText = date_i18n(getShortDateFormat(), $dateObj->getTimestamp());
        return $dateAsText;
    } catch (Exception $e) {
        $errorMessage = "Error Converting #: " . $postId . " with value: '" . $tmp . "' to DateTime Text";
        return $errorMessage;
    }
}


function getI18NUrl($originalUrl, $hasQueryString = false)
{
    $formattedUrl = $originalUrl . ($hasQueryString === false ? "?" : "&") . "lang=" . ICL_LANGUAGE_CODE;
    return $formattedUrl;
}

/** 
 * Returns the date format according to the language for Javascript Code
 */
function i18n_date_js_format()
{
    //Moment.JS Format i18N
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        echo "DD/MM/YYYY";
    } else if (ICL_LANGUAGE_CODE == 'en') {
        echo "MM/DD/YYYY";
    } else {
        echo "MM/DD/YYYY";
    }
}

/** 
 * Returns the date format according to the language for PHP DATE code
 */
function i18n_date_php_format()
{
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        return "d/m/Y";
    } else if (ICL_LANGUAGE_CODE == 'en') {
        return 'm/d/Y';
    } else {
        return 'm/d/Y';
    }
}

/** 
 * Returns the MONTH format according to the language for JS code
 */
function i18n_date_js_format_month()
{
    //Moment.JS Format i18N
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        echo "M";
    } else if (ICL_LANGUAGE_CODE == 'en') {
        echo "M";
    } else {
        echo "M";
    }
}

function getShortDateFormat()
{
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        return "d/m/Y";
    } else if (ICL_LANGUAGE_CODE == 'en') {
        return "m/d/Y";
    } else {
        return "m/d/Y";
    }
}

function getLongDateTimeFormat()
{
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        return 'j/n/y @ G:i';
    } else if (ICL_LANGUAGE_CODE == 'en') {
        return 'n/j/y @ g:i a';
    } else {
        return 'n/j/y @ g:i a';
    }
}

function getMomentJsShortDateFormat()
{
    if (ICL_LANGUAGE_CODE == 'pt-br') {
        return 'j/n/y @ G:i';
    } else if (ICL_LANGUAGE_CODE == 'en') {
        return 'n/j/y @ g:i a';
    } else {
        return 'n/j/y @ g:i a';
    }
}

function wpmziq_get_language_switcher()
{
    if (function_exists('icl_get_languages')) {
        $languages = wpml_get_active_languages_filter('', 'skip_missing=0&orderby=code&order=asc');
        if (!empty($languages)) {

            foreach ($languages as $l) {
                $active = $l['active'] ? 'active' : null;

                // This shows EN, PT, ES
                $langCode = substr($l['language_code'], 0, 2);

                // This returns Português, English, Español
                $title = $l["native_name"];

                echo <<<LANG
                    <a class="$active $langCode" href="{$l['url']}" title="$title">$langCode</a>
                LANG;
            }
        }
    }
}
