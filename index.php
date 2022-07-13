<?php
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'] . '/telegram';

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/art-lib/prolog.php');

//checkTelegramConnection();

$init = new \Bot\InitBot(file_get_contents('php://input'));
$init->useAction();