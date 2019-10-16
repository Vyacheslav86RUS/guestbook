<?php
/**
 * Файл контроллер гостевой книги
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Controllers
 */


namespace app\controllers;


use app\core\BaseControllers;
use app\models\GuestModel;

/**
 * Контроллер гостевой книги
 * 
 */
class GuestController extends BaseControllers {
    
    /**
     * Конструктор гостевой книги
     * 
     * Вызывает базовый __construct() контроллера и туда передается модель пользователей
     */
    public function __construct() {
        $model = new GuestModel();
        parent::__construct($model);
    }
    
    /**
     * Список сообщений гостевой книги
     * 
     * Получение записей гостевой книги и подгружается вид
     * 
     * @param integer $page Текущая страница
     */
    public function listAction($page = 1){
        $this->view->title = 'Главная';
        $count = 0;
        if(isset($_SESSION['pag']) && intval($_SESSION['pag']) > 0){
            $count = intval($_SESSION['pag']);
        } else {
            $count = PAGE_COUNT;
        }
        $start = ($page-1)*$count;
        $data['result'] = $this->model->getGuest('all',array('start'=>$start,'end'=>$count));
        $data['start'] = $page;
        $data['end'] = $count;
        $data['count'] = $this->model->getGuest('count');
        $this->view->render('guest.php','main.php',$data);
    }
    
    /**
     * Редактирование сообщений
     * 
     * @param integer $id сообщения
     */
    public function editAction($id){
        $this->view->title = 'Редактирование';
        if(isset($_SESSION) && isset($_SESSION['uid']) && intval($_SESSION['role']) === 1){
            $data = $this->model->getGuest('row',array('id'=> intval($id)));
            $this->view->render('edit.php','main.php',$data);
        } else {
            header('HTTP/1.1 200 OK');
            header("Status: 200 OK");
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/guest/list');
        }
    }
}
