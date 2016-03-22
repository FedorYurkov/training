<?php
error_reporting(E_ALL | E_STRICT | E_NOTICE);
session_start();

define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

// Подключение файлов.
require_once(ROOT.DS.'components'.DS.'Autoload.php');

// Вызов маршрутизатора Router.

$router = new Router();
$router->start();


?>