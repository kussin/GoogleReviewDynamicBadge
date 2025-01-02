<?php
require_once 'config.inc.php';
require_once 'inc/header.inc.php';

require_once 'helper/lang.php';

require_once 'api/data.php';

include_once 'inc/xml.inc.php';
?>
<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 205 205">
    <defs>
        <?php include_once 'badge/defs/style.inc.php'; ?>
    </defs>
    <?php include_once 'badge/theme/default.inc.php'; ?>
    <?php include_once 'badge/label/overall.inc.php'; ?>
    <?php include_once 'badge/stars/rating.inc.php'; ?>
    <?php include_once 'badge/label/review-count.php'; ?>
</svg>