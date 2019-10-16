<?php
/**
 * Файл маршрутизации
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Core
 */

namespace app\core;

/**
 * Класс маршрутизации
 */
class Router {
    
    /**
     * Запустить маршрутизацию
     * 
     * Получает маршруты, проверяет существуют ли контроллеры и экшены
     * @return void
     */
    public static function run(){
       $controller_name = 'Main';
       $action_name = 'index';
       
       //$routes = explode('/', $_SERVER['REQUEST_URI']);
       $routes = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
       /*if(!empty($routes[1])){
           $controller_name = $routes[1];
       }
       
       if(!empty($routes[2])){
           $action_name = $routes[2];
       }*/
        if(!empty($routes[0])){
           $controller_name = $routes[0];
           unset($routes[0]);
       }
       
       if(!empty($routes[1])){
           $action_name = $routes[1];
           unset($routes[1]);
       }
       $controller_name =  ucfirst($controller_name).'Controller';
       $action_name =  lcfirst($action_name).'Action';

        /*echo "Controller: $controller_name <br>";
	echo "Action: $action_name <br>";
	var_dump($routes).'<br>';*/
       
       $controller_path = PATH_CONTROLLERS.'/'.$controller_name.'.php';
       if(file_exists($controller_path)){
           include $controller_path;
       } else {
           self::Error ();
       }

       $namespace = '\\app\\controllers\\'.$controller_name;
       $controller = new $namespace();
       $action = $action_name;
       
       if(method_exists($controller, $action)){
           //$controller->$action();
           call_user_func_array(array($controller, $action), $routes);
           //array_shift($routes);
           //array_shift($routes);
           //var_dump($routes);
       } else { 
           self::Error ();
       }
    }
    
    /**
     * Перенаправление на страницу ошибки
     */
    public static function Error(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'error/page404/');
        //exit(E_ERROR);
    }
}
