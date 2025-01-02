<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");

// Additional headers for preflight requests
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

header('Content-Type: image/svg+xml');