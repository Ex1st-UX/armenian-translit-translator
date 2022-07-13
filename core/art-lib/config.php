<?php

define('DEBUG_MODE', true);

require_once('db.php');

if (DEBUG_MODE) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}