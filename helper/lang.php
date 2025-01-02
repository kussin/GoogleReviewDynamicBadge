<?php

/**
 * Get google reviews
 * @return array Google reviews data
 */
function translate($sString, $aValues = [])
{
    // GET LANG
    $sLangCode = !empty($_GET['lang']) ? trim($_GET['lang']) : DEFAULT_LANG;

    // CHECK TRANSLATIONS
    if (file_exists(BASE_PATH . 'i8n/' . $sLangCode . '.php')) {
        include BASE_PATH . 'i8n/' . $sLangCode . '.php';
    } else {
        include BASE_PATH . 'i8n/' . DEFAULT_LANG . '.php';
    }

    if (!isset($aTranslations[$sString])) {
        // MISSING TRANSLATION
        return $sString;
    }

    // TRANSLATE
    return sprintf($aTranslations[$sString], implode(',', $aValues));
}
