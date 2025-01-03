<?php

/**
 * Get google reviews
 * @return array Google reviews data
 */
function get_google_reviews() : array
{
    // Fetch reviews with cURL
    $cHandle = curl_init();

    curl_setopt($cHandle, CURLOPT_HEADER, 0);
    curl_setopt($cHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cHandle, CURLOPT_URL, GOOGLE_URL);

    $sResponse = curl_exec($cHandle);
    curl_close($cHandle);

    // JSON decode the text to associative array
    $aResponse = json_decode($sResponse, 'assoc');

    if ($aResponse === null || !isset($aResponse['result']) || !isset($aResponse['result']['reviews'])) {
        // FALLBACK
        $aResponse = [
            'result' => [
                'name' => 'Google Maps API Request Failed',
                'rating' => FALLBACK_STARS,
                'user_ratings_total' => FALLBACK_REVIEWS,
            ]
        ];
    }

    // RATINF FIX (Minumum 1 star)
    if ($aResponse['result']['rating'] < 1) {
        $aResponse['result']['rating'] = 1;
    }

    // FORMAT RATING
    $aResponse['result']['rating'] = number_format(round($aResponse['result']['rating'], 1), 1);

    // ADD LANGUAGE CODE
    $aResponse['language_code'] = !empty($_GET['lang']) ? trim($_GET['lang']) : DEFAULT_LANG;

    return $aResponse;
}

// Get reviews
$aData = get_google_reviews();