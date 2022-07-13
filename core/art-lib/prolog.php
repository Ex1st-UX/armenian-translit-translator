<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/redbean/rb-mysql.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

require_once('config.php');
require_once('functions.php');
require_once('translate.php');

/*load classes*/
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/classes/InitBot.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/classes/YandexTranslator.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/classes/Translit.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/core/classes/Users.php');
