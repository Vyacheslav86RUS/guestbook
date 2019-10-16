<?php
/**
 * Файл для обработки ajax запросов
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package App
 */

include 'confing.php';
include '../vendor/autoload.php';

use app\models\UserModel;
use app\models\GuestModel;

$result = array();
$sql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$sql->exec('SET CHARACTER SET utf8');
$sql->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//$model = new MainModel();

switch ($_GET['id']){
    case 'auth':
        $model = new UserModel();
        if(isset($_POST)){
            $result = $model->authUser($_POST);
        } else $result = array('msg'=>'Нет данных, перезагрузите страницу и попробуйте снова','error'=>1);
        break;
    case 'logout':
        session_unset();
        header('HTTP/1.1 200 OK');
        header("Status: 200 OK");
        header('Location: http://'.$_SERVER['SERVER_NAME']);
        break;
    case 'reg':
        $model = new UserModel();
        if(isset($_POST)){
            $result = $model->regUser($_POST);
        } else $result = array('msg'=>'Нет данных, перезагрузите страницу и попробуйте снова','error'=>1);   
        break;
    case 'gsadd':
        $model = new GuestModel();
        if(isset($_POST)){
            $result = $model->addGuest($_POST, $_FILES['file']);
        } else {
            $result = array('msg'=>'Нет данных, перезагрузите страницу и попробуйте снова','error'=>1);
        }
        break;
    case 'gsedit':
        $model = new GuestModel();
        if(isset($_POST)){
            $id = intval($_POST['id']);
            $data = array('name'=>$_POST['name'],'email'=>$_POST['email'],'hpage'=>$_POST['hpage'],'gmsg'=>$_POST['gmsg']);
            if(isset($_POST['fpath'])){
                $data['fpath'] = $_POST['fpath'];
            }
            $result = $model->editGuest($data,$id,$_FILES['file']);
            //$result = array('d'=>$_POST,'f'=>$_FILES);
        } else {
            $result = array('msg'=>'Нет данных, перезагрузите страницу и попробуйте снова','error'=>1);
        }
        break;
    case 'pag':
        $model = new GuestModel();
        if(isset($_POST)){
            $page = 1;
            $_SESSION['pag'] = intval($_POST['pagination']);
            $count = intval($_SESSION['pag']);
            $start = ($page-1)*$count;
            $data['result'] = $model->getGuest('all',array('start'=>$start,'end'=>$count));
            $data['start'] = $page;
            $data['end'] = $count;
            $data['count'] = $model->getGuest('count');
            ob_start();
            include './layout/list.php';
            $html = ob_get_contents();
            ob_end_clean();
            $result = array('error'=>0,'msg'=>$_SESSION['pag'],'html'=>$html,'status'=>SERVER_CODE_OK);
        }
        break;
    case 'test':
        $result = $_POST;
        break;
}

print json_encode($result);