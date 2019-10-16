<?php
/**
 * Файл контроллер для ошибок
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Controllers
 */


namespace app\controllers;

use app\core\BaseControllers;
use app\models\ErrorModel;

/**
 * Контроллер ошибок
 *
 */
class ErrorController extends BaseControllers{
    
    /**
     * Создание экземпляра контроллера
     * 
     */
    public function __construct() {
        $model = new ErrorModel();
        parent::__construct($model, $view);
    }
    
    /**
     * index страница
     */
    public function indexAction() {
        
    }
    
    /**
     * Страница 404
     * 
     * Отрисовывает страницу 404, если не найден url адрес
     */
    public function page404Action(){
        $this->view->title = 'Ошибка';
        $this->view->render('404.php');
    }
}
