<?php
/**
 * Файл конфигурации сервера
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package App
 */
namespace app;

session_start();

$APP_FILE_SIZES = array("image/jpeg"=>1,"image/jpg"=>1,"image/png"=>1,"text/plain"=>100);
$APP_FILE_UNITS = array("image/jpeg"=>"MB","image/jpg"=>"MB","image/png"=>"MB","text/plain"=>"KB");
$APP_FILE_TYPES = array("image/jpeg", "image/jpg", "image/png","text/plain");
$APP_FILE_UNITS_TYPES = array("B", "KB", "MB", "GB", "TB");
define('APP_IMAGE_WIDTH', 320);
define('APP_IMAGE_HEIGHT', 240);
$APP_IMAGE_WIDTH = 320;
$APP_IMAGE_HEIGHT = 240;


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS','');
define('DB_NAME', 'guestbook');
define('APP_PATH',__NAMESPACE__);
define('PATH_CONTROLLERS',__NAMESPACE__.'/controllers');
define('PATH_MODELS',__NAMESPACE__.'/models');
define('PATH_VIEWS',__NAMESPACE__.'/views');
define('PATH_LAYOUTS', APP_PATH.'/layout');
define('PAGE_COUNT',25);
define('PATH_FILE_UPLOADS','/uploads/');
define('CURRENT_URI_GUEST','/guest/list/');
//Статусы от сервера
define('SERVER_CODE_AUTH', 1);//
define('SERVER_CODE_OK',2);//
define('SERVER_CODE_REGISTRATION',3);//
define('SERVER_CODE_ADD_GUEST',4);//
define('SERVER_CODE_UPDATE_GUEST', 5);//

//Определение IP и данные браузера
$ip = '';
$client  = $_SERVER['HTTP_CLIENT_IP'];
$forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = $_SERVER['REMOTE_ADDR'];
if(filter_var($client, FILTER_VALIDATE_IP)){
    $ip = $client;
} else if(filter_var($forward, FILTER_VALIDATE_IP)){
    $ip = $forward;
} else {
    $ip = $remote;
}
define('CLIENT_IP_ADDR', $ip);
define('CLIENT_BROWSER',$_SERVER['HTTP_USER_AGENT']);

