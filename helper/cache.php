<?php

/**
 * Get google reviews
 * @return array Google reviews data
 */
function get_cached_reviews($aData) : string
{
    // CHECK CACHE
    $sLatestCacheFile = null;
    $iLatestCacheTime = 0;

    foreach (glob(CACHE_PATH . $aData['language_code'] . '-*.cache') as $sFile) {
        $iFileTime = filemtime($sFile);
        if ($iFileTime > $iLatestCacheTime && (time() - $iFileTime) < CACHE_TIME) {
            $sLatestCacheFile = $sFile;
            $iLatestCacheTime = $iFileTime;
        }
    }

    // LOAD CACHE
    if ($sLatestCacheFile) {
        return file_get_contents($sLatestCacheFile);
    }

    // UPDATE CACHE
    ob_start();

    // INCLUDE TPL FILES
    include_once BASE_PATH . 'inc/xml.inc.php';

    echo '<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 205 205">';
        include_once BASE_PATH . 'badge/generator.inc.php';

        echo '<defs>';
            include_once BASE_PATH . 'badge/defs/style.inc.php';
        echo '</defs>';

        include_once BASE_PATH . 'badge/theme/default.inc.php';
        include_once BASE_PATH . 'badge/label/overall.inc.php';
        include_once BASE_PATH . 'badge/stars/rating.inc.php';
        include_once BASE_PATH . 'badge/label/review-count.php';
    echo '</svg>';

    // BUFFER OUTPUT
    $sHtml = ob_get_clean();

    // CREATE CACHE DIRECTORY
    if (!file_exists(CACHE_PATH)) {
        mkdir(CACHE_PATH, 0777, true); // Ensure the cache directory exists
    }

    // CREATE CACHE FILE
    file_put_contents(CACHE_PATH . $aData['language_code'] . '-' . time() . '.cache', $sHtml);

    // RETURN BADGE
    return $sHtml;
}