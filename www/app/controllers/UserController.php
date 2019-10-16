<?php
/**
 * Файл контроллер пользователей
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Controllers
 */

namespace app\controllers;


use app\core\BaseControllers;
use app\models\UserModel;

/**
 * Контроллер пользователей
 */
class UserController extends BaseControllers {
    
    /**
     * Конструктор пользователей
     * 
     * Вызывает базовый __construct() контроллера и туда передается модель пользователей
     */
    public function __construct() {
        $model = new UserModel();
        parent::__construct($model);
    }

    /**
     * Логина пользователя
     * 
     * Страницп логина пользователя
     */
    public function loginAction(){
        $this->view->title = 'Вход';
        $this->view->render('login.php');
    }
    
    /**
     * Регистрация пользователя
     * 
     * Страница регистрации пользователя
     */
    public function regAction(){
        $this->title = 'Регистрация';
        $this->view->render('registration.php');
    }
    
    public function testAction(){
        $data = $this->model->updateGuestByEmail('Vlad@mail.ru',11);
    }
}
