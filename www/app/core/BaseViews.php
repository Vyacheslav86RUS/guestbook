<?php
/**
 * Файл базового вида
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Core
 */

namespace app\core;

/**
 * Базовый вид
 * 
 * Базовый вид, который подключает страницы
 * @abstract
 */
abstract class BaseViews {
    
    /**
     * Рисует страницу
     * 
     * Отрисовывает необходимую страницу
     * 
     * @param string $content_view Какой шаблон отрисовать
     * @param string $base_view Базовый шаблон. Не обязательный параметр
     * @param array $data Данные необходимые для отрисовки. Не обязательный параметр
     * @return void
     */
    public function render($content_view, $base_view, $data = array()){
        //echo '../layout/'.$base_view;
        include PATH_LAYOUTS.'/'.$base_view;
    }
}
