<?php

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

require_once(str_replace('\\\\','/',dirname(__FILE__)).'/configuration.php');

mysqli_connect($GLOBALS['config']['bd_hostname'], $GLOBALS['config']['bd_username'], $GLOBALS['config']['bd_password']) or die("Не могу подключиться к БД!");
mysqli_select_db($GLOBALS['config']['bd_basename']) or die("БД отсутствует!");
mysqli_set_charset('utf8mb4');

?>