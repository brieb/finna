<?php

session_start();
define('DS', DIRECTORY_SEPARATOR);
define('PATH_WWW_ROOT', dirname(__FILE__));
define('PATH_APP_ROOT', dirname(PATH_WWW_ROOT));
set_include_path('../');

require_once('util.php');
require_once('config/config.php');
require_once('model.php');
require_once('controller.php');
require_once('dispatch.php');

$config = Config::getInstance();

removeMagicQuotes();
$page = dispatch(!empty($_GET['url']) ? $_GET['url'] : '');

if (!$config->isAjax && !empty($page)) {
    require_once($page);
}

?>