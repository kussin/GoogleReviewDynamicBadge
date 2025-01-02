<?

$dStars = (double) $aData['result']['rating'];

switch (true) {
//    case $dStars > 4.5 :
//        $sStars = '5-stars';
//        break;

    case $dStars <= 1 :
        $sStars = '1-star';
        break;

    case $dStars <= 1.5 :
        $sStars = '1-5-stars';
        break;

    case $dStars <= 2 :
        $sStars = '2-stars';
        break;

    case $dStars <= 2.5 :
        $sStars = '2-5-stars';
        break;

    case $dStars <= 3 :
        $sStars = '3-stars';
        break;

    case $dStars <= 3.5 :
        $sStars = '3-5-stars';
        break;

    case $dStars <= 4 :
        $sStars = '4-stars';
        break;

    case $dStars <= 4.5 :
        $sStars = '4-5-stars';
        break;

    default :
        $sStars = '5-stars';
        break;
}

include_once BASE_PATH . 'badge/stars/inc/' . $sStars . '.inc.php';