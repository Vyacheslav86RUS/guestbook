<?php
/**
 * Файл точки входа
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package guestbook.ru
 */


/**
 * Просмотр ощибок на экране
 */
ini_set('display_errors', 1);
/**
 * Подключение к сайту конфигурацию
 */
include 'app/confing.php';
/**
 * Подключение авто загрузки классов
 */
include 'vendor/autoload.php';

use app\core\Router;
use app\core\BaseViews;


//spl_autoload_register(function ($className){
    //echo $className.'<br>';
//    include $className.'.php';
//});

/**
 * Объект подключения к БД
 * @see PDO
 */
$sql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
/**
 * Установка кодировки
 * @see PDO
 */
$sql->exec('SET CHARACTER SET utf8');
/**
 * Передаем обработку подготавливаемого запроса самой БД
 * @see PDO
 */
$sql->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
/**
 * Объект маршрутизации
 * @see Route
 */
$router = new Router();
/**
 * Запускаем маршрутизацию
 * @see Route
 */
$router::run();

//
//$sql_text = 'SELECT * FROM users WHERE role=:role';
//$data = array(':role'=>1);
//$result = $sql->prepare($sql_text);
//$result->execute($data);
//var_dump($result->fetchAll(PDO::FETCH_ASSOC));
