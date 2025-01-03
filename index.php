<?php
require_once 'config.inc.php';
require_once 'inc/header.inc.php';

require_once 'helper/cache.php';
require_once 'helper/lang.php';

require_once 'api/data.php';

echo get_cached_reviews($aData);
exit;