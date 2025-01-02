<?php
require_once 'config.inc.php';

header("HTTP/1.0 404 Not Found");
header("Location: " . REDIRECT_URL);
die();