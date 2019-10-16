<?php

namespace app\models;

use app\core\BaseModels;

class MainModel extends BaseModels{
    
    //public $result = array();
    private $select = array();
    
    public function getUserByNameAndPass($name,$pass){
        $sql = 'SELECT role FROM users WHERE login = :login AND password = :password';
        $data = array(':login'=> parent::escapeSpecialCharacters($name),':password'=> parent::escapeSpecialCharacters($pass));
        return parent::sqlSelect($sql, $data, 'row');
    }
    
    public function getUserByEmail($email){
        $sql = 'SELECT role FROM users WHERE email = :email';
        $data = array(':email'=> parent::escapeSpecialCharacters($email));
        return parent::sqlSelect($sql, $data, 'row');
    }
        
    private function isValideData($data){
        $result = true;
        if(isset($data['login'])){
            if(empty($data['login'])){
                return array('error'=>1,'msg'=>'Не указан логин');
            }
            if(parent::getLenghtString($data['login']) < 5){
                return array('error'=>1,'msg'=>'Ваш логин не должен быть меньше 5 символов');
            }
        }
        if(isset($data['inputPassword'])){
            if(empty($data['inputPassword'])){
                return array('error'=>1,'msg'=>'Не указан пароль');
            }
            if(parent::getLenghtString($data['inputPassword']) < 5){
                return array('error'=>1,'msg'=>'Ваш пароль не должен быть меньше 5 символов');
            }
        }
        if(isset($data['email'])){
            if(empty($data['email'])){
                return array('error'=>1,'msg'=>'Не указан email');
            }
            if(!parent::isValidEmail($data['email'])){
                return array('error'=>1,'msg'=>'Не верный email!');
            }
        }
        if(isset($data['inputPassword']) && isset($data['confirmPassword'])){
            if(empty($data['inputPassword']) || empty($data['confirmPassword'])){
                return array('error'=>1,'msg'=>'Не указан пароль');
            }
            if(parent::getLenghtString($data['inputPassword']) < 5){
                return array('error'=>1,'msg'=>'Ваш пароль не должен быть меньше 5 символов');
            }
            if(!$this->checkPassword(parent::escapeSpecialCharacters($data['inputPassword']), parent::escapeSpecialCharacters($data['confirmPassword']))){
                return array('error'=>1,'msg'=>'Пароли не совпадают');
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
    private function isValidUrl($url){
        $isValid = true;
        if(!preg_match('%^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z0-9\x{00a1}-\x{ffff}][a-z0-9\x{00a1}-\x{ffff}_-]{0,62})?[a-z0-9\x{00a1}-\x{ffff}]\.)+(?:[a-z\x{00a1}-\x{ffff}]{2,}\.?))(?::\d{2,5})?(?:[/?#]\S*)?$%iu', $url)){
            $isValid = false;
	}
	//if(!filter_var($url,FILTER_VALIDATE_URL)){
        //  $isValid = false;
	//}
        return $isValid;
    }
    
    private function checkPassword($firstPassword,$secondPassword){
        $isChecked = true;
        if($firstPassword != $secondPassword){
            $isChecked = false;
        }
        return $isChecked;
    }
    
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
    //Тестовый метод для проверки файла
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
    
    public function authUser($data){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            return $isValide;
        }
        $result = $this->getUserByNameAndPass($data['login'], $data['inputPassword']);
        if(isset($result['role'])){
            $result['error'] = 0;
            $result['status'] = SERVER_CODE_AUTH;
            return $result;
        } else return array('msg'=>'Нет такого пользователя','error'=>1);
    }
    
    public function regUser($data){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            return $isValide;
        }
        $check = $this->getUserByNameAndPass($data['login'], $data['inputPassword']);
        if(isset($check['role'])){
            return array('msg'=>'Такой пользователь уже существует!','check'=>1);
        }
        $check_email = $this->getUserByEmail($data['email']);
        if(isset($check_email['role'])){
            return array('msg'=>'Пользователь с таким email, уже существует','check'=>1);
        }
        $r = $this->inserUser($data);
        if (is_bool($r) === false) {
            return array('error'=>0,'uid'=> intval($r),'status'=>SERVER_CODE_REGISTRATION);
        } else {
            return array('msg' => 'Не получилось записать данные в базу', 'error' => 1);
        }
    }
    
    public function inserUser($data){
        /*$sql = 'INSERT INTO users (login,password,email,dreg) VALUES (:login,:password,:email,:dreg)';
        $data_sql = array(
            ':login'=> parent::escapeSpecialCharacters($data['login']),
            ':password'=> parent::escapeSpecialCharacters($data['inputPassword']),
            ':email'=> parent::escapeSpecialCharacters($data['email']),
            ':dreg'=>time()
        );*/
        $sql = parent::createSqlText(array_keys($data),'INSERT');
        $table = 'users';
        $sql = str_replace('#table#', $table, $sql);
        $data_sql = parent::createDataSql($data);
        parent::sqlInsert($sql, $data_sql);
        return parent::getLastId();
    }
    
    public function addGuest($data,$file){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            return $isValide;
        }
        $r = $this->inserGuest($data);
        //return $r;
        if(is_bool($r) === false){
            if(!empty($file)){
                $check = $this->isValidFile($file);
                if($check !== true){
                    return array('error'=>1,'msg'=>$check);
                } else {
                    $expansion = explode('.', $file['name']);
                    $name = basename($r.'.'.$expansion[1]);
                    move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].PATH_FILE_UPLOADS.$name);
                }
                $update = $this->updateGuest(array('fpath'=>PATH_FILE_UPLOADS.$name), array('id'=>$r));
                if(is_bool($update) === true){
                    return array('error'=>0,'status'=>SERVER_CODE_ADD_GUEST);
                } else {
                    return array('error'=>1,'msg'=>'Не удалось записать файл на сообщение');
                }
            }
            return array('error'=>0,'status'=>SERVER_CODE_ADD_GUEST);
        } else {
            return array('msg'=>'Не получилось записать данные в базу','error'=>1);
        }
    }
    
    public function inserGuest($data){
        /*$sql = 'INSERT INTO gmsg (name,email,hpage,gmsg,cdate,uip,ubrowser) VALUES (:name,:email,:hpage,:gmsg,:cdate,:uip,:ubrowser)';
         *       "INSERT INTO gmsg (name,email,hpage, msg, cdate, uip, ubrowser) VALUES (:name, :email, :hpage, :msg, :cdate, :uip, :ubrowser)"
        $data_sql = array(
            ':name'=> parent::escapeSpecialCharacters($data['name']),
            ':email'=> parent::escapeSpecialCharacters($data['email']),
            ':hpage'=> parent::escapeSpecialCharacters($data['hpage']),
            ':gmsg'=> parent::escapeSpecialCharacters($data['msg']),
            ':cdate'=>time(),
            ':uip'=> parent::escapeSpecialCharacters(CLIENT_IP_ADDR),
            ':ubrowser'=> parent::escapeSpecialCharacters(CLIENT_BROWSER)
        );*/
        $data['cdate'] = time();
        $data['uip'] = CLIENT_IP_ADDR;
        $data['ubrowser'] = CLIENT_BROWSER;
        $sql = parent::createSqlText(array_keys($data), 'INSERT');
        $table = 'gmsg';
        $sql = str_replace('#table#', $table, $sql);
        $data_sql = parent::createDataSql($data);
        parent::sqlInsert($sql, $data_sql);
        return parent::getLastId();
        //return array('sql'=>$sql,'d'=>$data_sql);
    }
    
    public function updateGuest($data,$where=NULL){
        /*$sql = 'UPDATE gmsg SET ';
        $data_sql = array();
        $where_update = '';
        foreach ($data as $key => $value) {
            if(is_numeric($value)){
                $data_sql[':'.$key] = intval($value);
                $sql .= $key.' = :'.$key.', ';
            } else {
                $data_sql[':'.$key] = parent::escapeSpecialCharacters($value);
                $sql .= $key.' = :'.$key.', ';
            }
        }
        $sql = trim($sql);
        if ($sql{strlen($sql)-1} == ',') {
            $sql = substr($sql,0,-1);
        }
        if($where != NULL){
            $where_update = 'WHERE ';
            foreach ($where as $k => $v) {
                if(is_numeric($v)){
                    $data_sql[':'.$k] = intval($v);
                    $where_update .= $k.' = :'.$k.', ';
                } else {
                    $data_sql[':'.$k] = parent::escapeSpecialCharacters($v);
                    $where_update .= $k.' = :'.$k.', ';
                }
            }
            $where_update = trim($where_update);
            if ($where_update{strlen($where_update)-1} == ',') {
                $where_update = substr($where_update,0,-1);
            }
        }*/
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
        //return array('sql'=>$sql.' '.$where_update,'d'=>$data_sql);
    }
    
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
                $sql = 'SELECT id,name,email,uid,hpage,gmsg,fpath,cdate FROM gmsg';
                break;
        }
        return parent::sqlSelect($sql_text, $data_sql, $type_sql);
        //return array('sql'=>$sql_text,'d'=>$data_sql,'t'=>$type_sql);
    }
}
