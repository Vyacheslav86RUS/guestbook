<?php
/**
 * Файл модели гостевой книги
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Models
 */

namespace app\models;

use app\core\BaseModels;

/**
 * Модель гостевой книги
 * 
 * Модель наследуется от @see BaseModel
 */
class GuestModel extends BaseModels {

    /**
     * @var mixed Переменная которая возвращает данные 
     */
    private $response;
    
    /**
     * Проверка валидации данных
     * 
     * Проверяет все входные данные на валидацию.
     * Возвращает bool = true если данные владны, иначе возвращает массив ошибки
     * 
     * @param array $data Данные для валидации
     * @return mixed Результат. Возвращает bool или array
     */
    private function isValideData($data){
        $result = true;
        if(isset($data['email'])){
            if(empty($data['email'])){
                return array('error'=>1,'msg'=>'Не указан email');
            }
            if(!parent::isValidEmail($data['email'])){
                return array('error'=>1,'msg'=>'Не верный email!');
            }
        }
        if(isset($data['name'])){
            if(empty($data['name'])){
                return array('error'=>1,'msg'=>'Не указано имя');
            }
            if(parent::getLenghtString($data['name']) < 2){
                return array('error'=>1,'msg'=>'Ваше имя не должно быть меньше 2 символов');
            }
        }
        if(isset($data['hpage'])){
            if($data['hpage'] != ''){
                if(!$this->isValidUrl(parent::escapeSpecialCharacters($data['hpage']))){
                    return array('error'=>1,'msg'=>'Не верный url');
                }
            }
        }
        if(isset($data['gmsg'])){
            if(empty($data['gmsg'])){
                return array('error'=>1,'msg'=>'Не указан текст сообщения');
            }
            if(parent::getLenghtString($data['gmsg']) < 5){
                return array('error'=>1,'msg'=>'Ваше сообщение не должно быть меньше 5 символов');
            }
        }
        return $result;
    }
    
    /**
     * Валидация URL адреса
     * 
     * Валидация URL адреса по регулярному выражению
     * 
     * @param string $url
     * @return boolean
     */
    private function isValidUrl($url){
        $isValid = true;
        if(!preg_match('%^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z0-9\x{00a1}-\x{ffff}][a-z0-9\x{00a1}-\x{ffff}_-]{0,62})?[a-z0-9\x{00a1}-\x{ffff}]\.)+(?:[a-z\x{00a1}-\x{ffff}]{2,}\.?))(?::\d{2,5})?(?:[/?#]\S*)?$%iu', $url)){
            $isValid = false;
	}
        return $isValid;
    }
    
    /**
     * Проверка файла
     * 
     * Валидация файла на его размер и mime-type
     * Возвращает bool = true если файл подходит условию, иначе строку ошибки
     * 
     * @global array $APP_FILE_TYPES Массив mime типов. @see confing.php
     * @global array $APP_FILE_SIZES Массив размеров. @see confing.php
     * @global array $APP_FILE_UNITS Массивединиц измерений размеров файлов. @see confing.php
     * @param File $file Объект - Файл
     * @return mixed Результат. bool или string
     */
    private function isValidFile($file){
        global $APP_FILE_TYPES,$APP_FILE_SIZES,$APP_FILE_UNITS;
        $isValid = true;
        if(!in_array($file['type'], $APP_FILE_TYPES)){
            $isValid = 'Файла '.$file['name'].' не является image/jpeg,image/jpg,image/png,text/plain '.$file['type'];
        } else {
            $size = $this->getSizesFile($APP_FILE_SIZES[$file['type']], $APP_FILE_UNITS[$file['type']]);
            if($file['size'] > $size){
                $isValid = 'Файла '.$file['name'].'  должен быть не больше '.$APP_FILE_SIZES[$file['type']].$APP_FILE_UNITS[$file['type']];
            }
        }
        return $isValid;
    }
    
    /**
     * Получение размера файла
     * 
     * @global type $APP_FILE_UNITS_TYPES Массив наименовай единиц измерений размеров файлов. @see confing.php
     * @param int $size размер файла, который разрешен файлу.
     * @param string $unit Наименование единицы измерения.
     * @return int Разрешенный размер файла.
     */
    private function getSizesFile($size,$unit){
        global $APP_FILE_UNITS_TYPES;
        $result = 0;
        $serch = array_search($unit, $APP_FILE_UNITS_TYPES);
        if(in_array($unit, $APP_FILE_UNITS_TYPES)){
            while($serch > 0){
                $size *= 1024;
                $serch -= 1;
            }
            $result = $size;
        }
        return $result;
    }
    
    /**
     * Тестовый метод для проверки файла
     * 
     * @param File $file
     * @return array
     */
    public function checkFile($file){
        $result = array();
        if(!empty($file)){
            $check = $this->isValidFile($file);
            if($check !== true){
                $result['error'] = 1;
                $result['msg'] = $check;
            } else {
                $name = basename($file['name']);
                move_uploaded_file($file['tmp_name'], PATH_FILE_UPLOADS.$name);
            } 
        } else {
            $result = array('error'=>1,'msg'=>'Файл не указан');
        }
        return $result;
    }
    
    /**
     * Добавление записи гостевой книге
     * 
     * Подготавливает данные на запись и обновление данных в бд
     * 
     * @param array $data Данные от пользователя.
     * @param File $file Файл прикрепленный пользователем.
     * @return array Результат.
     */
    public function addGuest($data,$file){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            $this->response = $isValide;
        } else {
            $r = $this->inserGuest($data);
            //return $r;
            if(is_bool($r) === false){
                if(!empty($file)){
                    $check = $this->isValidFile($file);
                    if($check !== true){
                        $this->response = array('error'=>1,'msg'=>$check);
                    } else {
                        $file_name = $file['tmp_name'];
                        $expansion = explode('.', $file['name']);
                        $name = basename($r.'.'.$expansion[1]);
                        list($width,$height,$type) = getimagesize($file_name);
                        if($expansion[1] !== 'txt' && $width <= APP_IMAGE_WIDTH && $height <= APP_IMAGE_HEIGHT){
                            //move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name);
                            move_uploaded_file($file_name, $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name);
                        } else {
                            switch ($type){
                                case IMAGETYPE_JPEG:
                                    $img = imagecreatefromjpeg($file_name);
                                    $new_image = imagecreatetruecolor(APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT);
                                    imagecopyresampled($new_image, $img, 0, 0, 0, 0, APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT, imagesx($img), imagesy($img));
                                    imageJpeg($new_image, $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name, 100);
                                    break;
                                case IMAGETYPE_GIF:
                                    $img = imagecreatefromgif($file_name);
                                    $new_image = imagecreatetruecolor(APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT);
                                    imagecopyresampled($new_image, $img, 0, 0, 0, 0, APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT, imagesx($img), imagesy($img));
                                    imageGif($new_image, $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name);
                                    break;
                                case IMAGETYPE_PNG:
                                    $img = imagecreatefrompng($file_name);
                                    $new_image = imagecreatetruecolor(APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT);
                                    imagecopyresampled($new_image, $img, 0, 0, 0, 0, APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT, imagesx($img), imagesy($img));
                                    imagePng($new_image, $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name);
                                    break;
                            }
                            imagedestroy($img);
                        }
                    }
                    $update = $this->updateGuest(array('fpath'=>PATH_FILE_UPLOADS.$name), array('id'=>$r));
                    if(is_bool($update) === true){
                        $this->response = array('error'=>0,'status'=>SERVER_CODE_ADD_GUEST);
                    } else {
                        $this->response = array('error'=>1,'msg'=>'Не удалось записать файл на сообщение');
                    }
                } else {
                    $this->response = array('error'=>0,'status'=>SERVER_CODE_ADD_GUEST);
                }
            } else {
                $this->response = array('msg'=>'Не получилось записать данные в базу','error'=>1);
            }
        }
        return $this->response;
    }
    
    /**
     * Редактирование сообщений
     * 
     * @param array $data
     * @param Integer $id
     * @param File $file
     * @return mixed false или array
     */
    public function editGuest($data,$id,$file=null){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            $this->response = $isValide;
        } else {
            if(isset($data['fpath'])){
                $r = $this->getGuest('row', array('id'=>$id));
                if($r['fpath'] !== ''){
                    unlink($_SERVER['DOCUMENT_ROOT'].$r['fpath']);
                }
            }
            if (!empty($file)) {
                $check = $this->isValidFile($file);
                if ($check !== true) {
                    $this->response = array('error' => 1, 'msg' => $check);
                } else {
                    $file_name = $file['tmp_name'];
                    $expansion = explode('.', $file['name']);
                    $name = basename($id . '.' . $expansion[1]);
                    list($width, $height, $type) = getimagesize($file_name);
                    if ($expansion[1] !== 'txt' && $width <= APP_IMAGE_WIDTH && $height <= APP_IMAGE_HEIGHT) {
                        //move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name);
                        move_uploaded_file($file_name, $_SERVER['DOCUMENT_ROOT'] . PATH_FILE_UPLOADS . $name);
                    } else {
                        switch ($type) {
                            case IMAGETYPE_JPEG:
                                $img = imagecreatefromjpeg($file_name);
                                $new_image = imagecreatetruecolor(APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT);
                                imagecopyresampled($new_image, $img, 0, 0, 0, 0, APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT, imagesx($img), imagesy($img));
                                imageJpeg($new_image, $_SERVER['DOCUMENT_ROOT'] . PATH_FILE_UPLOADS . $name, 100);
                                break;
                            case IMAGETYPE_GIF:
                                $img = imagecreatefromgif($file_name);
                                $new_image = imagecreatetruecolor(APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT);
                                imagecopyresampled($new_image, $img, 0, 0, 0, 0, APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT, imagesx($img), imagesy($img));
                                imageGif($new_image, $_SERVER['DOCUMENT_ROOT'] . PATH_FILE_UPLOADS . $name);
                                break;
                            case IMAGETYPE_PNG:
                                $img = imagecreatefrompng($file_name);
                                $new_image = imagecreatetruecolor(APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT);
                                imagecopyresampled($new_image, $img, 0, 0, 0, 0, APP_IMAGE_WIDTH, APP_IMAGE_HEIGHT, imagesx($img), imagesy($img));
                                imagePng($new_image, $_SERVER['DOCUMENT_ROOT'] . PATH_FILE_UPLOADS . $name);
                                break;
                        }
                        imagedestroy($img);
                    }
                    $data['fpath'] = PATH_FILE_UPLOADS.$name;
                }
            } else {
                $this->response = array('error' => 0, 'status' => SERVER_CODE_ADD_GUEST);
            }
            $update = $this->updateGuest($data, array('id'=>$id));
            if(is_bool($update) === true){
                $this->response = array('error'=>0,'status'=>SERVER_CODE_UPDATE_GUEST);
            } else {
                $this->response = array('error'=>1,'msg'=>'Не удалось редактировать данные');
            }
        }
        return $this->response;
    }
    
    /**
     * Запись в БД
     * 
     * Записывает в БД данные о сообщение в гостевой книге
     * 
     * @param array $data Даные для записи
     * @return integer @see getLastId
     */
    public function inserGuest($data){
        $data['cdate'] = time();
        $data['uip'] = CLIENT_IP_ADDR;
        $data['ubrowser'] = CLIENT_BROWSER;
        if(isset($_SESSION['uid']) && intval($_SESSION['uid']) != 0){
            $data['uid'] = intval($_SESSION['uid']);
        }
        $sql = parent::createSqlText(array_keys($data), 'INSERT');
        $table = 'gmsg';
        $sql = str_replace('#table#', $table, $sql);
        $data_sql = parent::createDataSql($data);
        parent::sqlInsert($sql, $data_sql);
        return parent::getLastId();
    }
    
    /**
     * Обновление записи в БД
     * 
     * Обновляет запись в БД по необходимым параметрам
     * 
     * @param array $data Данные, которые нужно обновить.
     * @param array $where Данные, по которым происходит изменения записи
     * @return mixed Результат. @see sqlUpdate
     */
    public function updateGuest($data,$where=NULL){
        $sql = parent::createSqlText(array_keys($data),'UPDATE');
        $table = 'gmsg';
        $where_update = '';
        $sql = str_replace('#table#', $table, $sql);
        if($where != NULL){
            $where_update = parent::createSqlText(array_keys($where), 'WHERE');
            $data = array_merge($data,$where);
        }
        $data_sql = parent::createDataSql($data);
        return parent::sqlUpdate($sql.' '.$where_update, $data_sql);
    }
    
    /**
     * Получение записей гостевой книги
     * 
     * Получение из БД записей гостевой книги по параметрам
     * Параметры могут быть all,row,count
     * 
     * @param string $type Параметры
     * @param array $data Необходимые данные для запроса
     * @return mixed @see sqlSelect
     */
    public function getGuest($type='all',$data=array()){
        $type_sql = '';
        $table = 'gmsg';
        $sql_text = '';
        $data_sql = array();
        switch ($type) {
            case 'all':
                $keys = array('id','name','email','uid','hpage','gmsg','fpath','cdate');
                $sql = parent::createSqlText($keys);
                $sql = str_replace('#table#', $table, $sql);
                $limit = parent::createSqlText(array_keys($data),'LIMIT');
                $sql_text = $sql.' '.$limit;
                $data_sql = parent::createDataSql($data);
                $type_sql = 'all';
                break;
            case 'row':
                //$sql = 'SELECT id,name,email,uid,hpage,gmsg,fpath,cdate FROM gmsg';
                $keys = array('id','name','email','uid','hpage','gmsg','fpath','cdate');
                $sql = parent::createSqlText($keys);
                $sql = str_replace('#table#', $table, $sql);
                $where = parent::createSqlText(array_keys($data),'WHERE');
                $sql_text = $sql.' '.$where;
                $data_sql = parent::createDataSql($data);
                $type_sql = 'row';
                break;
            case 'count':
                $sql_text = 'SELECT COUNT(id) FROM gmsg';
                $type_sql = 'value';
                $data_sql = array();
                break;
        }
        return parent::sqlSelect($sql_text, $data_sql, $type_sql);
        //var_dump(parent::sqlSelect($sql_text, $data_sql, $type_sql));
    }
}
