<?php

namespace app\controllers;

use app\core\BaseControllers;
use app\models\MainModel;

class MainController extends BaseControllers {
    
    public function __construct() {
        $model = new MainModel();
        parent::__construct($model);
    }
    
    public function indexAction(){
        $this->view->title = 'Default';
        $this->view->render('index.php');
    }
    public function regAction(){
        $this->title = 'Регистрация';
        $this->view->render('registration.php');
    }
    
    public function loginAction(){
        $this->view->title = 'Вход';
        $this->view->render('login.php');
    }
    
    public function authAction(){
        $result = array();
        if(isset($_POST)){
            $result = $this->model->authUser($_POST);
        } else $result = array('msg'=>'Нет данных, перезагрузите страницу и попробуйте снова','error'=>1);
        echo json_encode($result);
    }
    
    public function registrationAction(){
        
    }
    
    public function testAction(){
        $this->view->title = 'Главная';
        $this->view->render('404.php');
    }
    public function guestAction(){
        $this->view->title = 'Главная';
        $data = $this->model->getGuest('all',array('start'=>0,'end'=>PAGE_COUNT));
        $this->view->render('guest.php','main.php',$data);
    }
    
    public function errorAction(){
        $this->view->title = 'Ошибка';
        $this->view->render('404.php');
    }
}
