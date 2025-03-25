<?php

/**
 * Get google reviews
 * @return string Google reviews content
 */
function get_cached_reviews($aData) : string
{
    $sFormat = $aData['format'] ?? 'badge';

    switch ($sFormat) {
        case 'mini':
            return get_summary($aData);

        case 'badge':
        default:
            return get_badge($aData);
    }
}

/**
 * Get google reviews svg badge
 * @return string Google reviews svg badge
 */
function get_badge($aData) : string
{
    // CHECK CACHE
    $sLatestCacheFile = null;
    $iLatestCacheTime = 0;

    foreach (glob(CACHE_PATH . $aData['language_code'] . '-badge-*.cache') as $sFile) {
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
    file_put_contents(CACHE_PATH . $aData['language_code'] . '-badge-' . time() . '.cache', $sHtml);

    // RETURN BADGE
    return $sHtml;
}

/**
 * Get google reviews summary
 * @return string Google reviews summary html markup
 */
function get_summary($aData) : string
{
    // CHECK CACHE
    $sLatestCacheFile = null;
    $iLatestCacheTime = 0;

    foreach (glob(CACHE_PATH . $aData['language_code'] . '-mini-*.cache') as $sFile) {
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

    // SET VALUES
    $sRating = $aData['result']['rating'] . '/5';
    $iReviewCount = (int) $aData['result']['user_ratings_total'] + REVIEW_OFFSET;

    $dStars = (double) $aData['result']['rating'];

    switch (true) {
//    case $dStars > 4.5 :
//        $sStars = '5-stars';
//        break;

        case $dStars <= 1 :
            $sBadgeUrl = CDN_URL .'images/stars/1-star.svg';
            $sRatingGrade = translate('BAD');
            break;

        case $dStars <= 1.5 :
            $sBadgeUrl = CDN_URL .'images/stars/1-5-stars.svg';
            $sRatingGrade = translate('POOR');
            break;

        case $dStars <= 2 :
            $sBadgeUrl = CDN_URL .'images/stars/2-stars.svg';
            $sRatingGrade = translate('ALRIGHT');
            break;

        case $dStars <= 2.5 :
            $sBadgeUrl = CDN_URL .'images/stars/2-5-stars.svg';
            $sRatingGrade = translate('OK');
            break;

        case $dStars <= 3 :
            $sBadgeUrl = CDN_URL .'images/stars/3-stars.svg';
            $sRatingGrade = translate('AVERAGE');
            break;

        case $dStars <= 3.5 :
            $sBadgeUrl = CDN_URL .'images/stars/4-stars.svg';
            $sRatingGrade = translate('GOOD');
            break;

        case $dStars <= 4 :
            $sBadgeUrl = CDN_URL .'images/stars/4-stars.svg';
            $sRatingGrade = translate('GREAT');
            break;

        case $dStars <= 4.5 :
            $sBadgeUrl = CDN_URL .'images/stars/4-5-stars.svg';
            $sRatingGrade = translate('EXCELLENT');
            break;

        default :
            $sBadgeUrl = CDN_URL .'images/stars/5-stars.svg';
            $sRatingGrade = translate('EXCELLENT');
            break;
    }

    // UPDATE CACHE
    ob_start();

    // MARKUP
    $aHtml = [];

    $aHtml[] = '<p id="kussin-google-review-dynamic-summary-wrapper">';
        $aHtml[] = '<span class="kussin-google-review-dynamic-rating"><strong>' . $sRating . '</strong></span>';
        $aHtml[] = '<img
            alt=""
            src="' . $sBadgeUrl . '"
            fetchpriority="low"
            decoding="async"
            loading="lazy"
            width="' . MINI_STARS_WIDTH . '"
            height="' . MINI_STARS_HEIGHT . '"
            sizes="75vw"
            data-action="url"
            data-href="#kussin-google-review-dynamic-summary-badge"
            data-target="_self"
            data-pf-type="Image4"
            store="[object Object]"
            class="kussin-google-review-dynamic-stars">';
        $aHtml[] = '<span class="kussin-google-review-dynamic-grade">&quot;' . $sRatingGrade . '&quot;</span>';
        $aHtml[] = '&nbsp;|&nbsp;';
        $aHtml[] = '<span class="kussin-google-review-dynamic-count" title="' . translate('SUMMARIZED_REVIEWS') . '">' . translate('REVIEWS', [$iReviewCount]) . '</span>';
    $aHtml[] = '</p>';

    echo implode(PHP_EOL, $aHtml);

    // BUFFER OUTPUT
    $sHtml = ob_get_clean();

    // CREATE CACHE DIRECTORY
    if (!file_exists(CACHE_PATH)) {
        mkdir(CACHE_PATH, 0777, true); // Ensure the cache directory exists
    }

    // CREATE CACHE FILE
    file_put_contents(CACHE_PATH . $aData['language_code'] . '-mini-' . time() . '.cache', $sHtml);

    // RETURN BADGE
    return $sHtml;
}