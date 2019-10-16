<?php

namespace app\views;

use app\core\BaseViews;

class View extends BaseViews{
    
    public $title = '';
    
    public function render($content_view, $base_view='main.php',  $data = array(), $page = 1) {
        parent::render($content_view, $base_view, $data, $page);
    }
}
