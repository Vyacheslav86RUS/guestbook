<?php
/**
 * Файл модели пользователей
 * 
 * @author Slava V.V. <ProSlavon86@gmail.com>
 * @copyright (c) 2019, Slava V.V.
 * @version 1.0
 * @package Models
 */

namespace app\models;

use app\core\BaseModels;

/**
 * Модель пользователей.
 * 
 * Модель наследуется от @see BaseModel
 */
class UserModel extends BaseModels {
    
    /**
     * Получение логина и пароля пользователя
     * 
     * @param string $name
     * @param string $pass
     * @return mixed @see sqlSelect
     */
    public function getUserByNameAndPass($name,$pass){
        $sql = 'SELECT id,role FROM users WHERE login = :login AND password = :password';
        $data = array(':login'=> parent::escapeSpecialCharacters($name),':password'=> parent::escapeSpecialCharacters($pass));
        return parent::sqlSelect($sql, $data, 'row');
    }
    
    /**
     * Получение email пользователя
     * 
     * @param string $email
     * @return mixed @see sqlSelect
     */
    public function getUserByEmail($email){
        $sql = 'SELECT role FROM users WHERE email = :email';
        $data = array(':email'=> parent::escapeSpecialCharacters($email));
        return parent::sqlSelect($sql, $data, 'row');
    }
    
    /**
     * Получение сообщений написанные пользователем по его почте и обновление сообщений
     * 
     * @param string $email почта пользователя
     * @param integer $id id пользователя
     * @return mixed false или array
     */
    public function updateGuestByEmail($email,$id){
        $sql = 'SELECT id FROM gmsg WHERE email = :email';
        $data = array(':email'=> parent::escapeSpecialCharacters($email));
        $ids = parent::sqlSelect($sql, $data, 'all');
        $sql = 'UPDATE gmsg SET uid = :uid WHERE id = :id';
        foreach ($ids as $key => $value) {
            $data_sql = array(':uid'=>intval($id),'id'=>intval($value['id']));
            parent::sqlUpdate($sql, $data_sql);
        }
    }
    
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
        return $result;
    }
    
    /**
     * Проверка паролей
     * 
     * Проверят одинаковые пароли или нет
     * 
     * @param string $firstPassword Первый пароль.
     * @param string $secondPassword Второй пароль.
     * @return boolean Результат.
     */
    private function checkPassword($firstPassword,$secondPassword){
        $isChecked = true;
        if($firstPassword != $secondPassword){
            $isChecked = false;
        }
        return $isChecked;
    }
    
    /**
     * Аутефикация пользователя
     * 
     * @param array $data Данные пользователя.
     * @return array Результат.
     */
    public function authUser($data){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            return $isValide;
        }
        $result = $this->getUserByNameAndPass($data['login'], $data['inputPassword']);
        if(isset($result['role'])){
            $_SESSION['uid'] = intval($result['id']);
            $_SESSION['role'] = intval($result['role']);
            $result['error'] = 0;
            $result['status'] = SERVER_CODE_AUTH;
            $result['redirect'] = 'http://'.$_SERVER['SERVER_NAME'].'/guest/list';
            return $result;
        } else return array('msg'=>'Нет такого пользователя','error'=>1);
    }
    
    /**
     * Подготовка данных для записи
     * @param array $data Данные пользователя.
     * @return array Результат.
     */
    public function regUser($data){
        $isValide = $this->isValideData($data);
        if($isValide !== true){
            return $isValide;
        }
        $check = $this->getUserByNameAndPass($data['login'], $data['inputPassword']);
        if(isset($check['role'])){
            return array('msg'=>'Такой пользователь уже существует!','check'=>1,'error'=>0);
        }
        $check_email = $this->getUserByEmail($data['email']);
        if(isset($check_email['role'])){
            return array('msg'=>'Пользователь с таким email, уже существует','check'=>1,'error'=>0);
        }
        $data['password'] = $data['inputPassword'];
        $data['dreg'] = time();
        unset($data['confirmPassword']);
        unset($data['inputPassword']);
        $r = $this->inserUser($data);
        if (is_bool($r) === false) {
            $_SESSION['uid'] = intval($r);
            $_SESSION['role'] = 0;
            $this->updateGuestByEmail($data['email'],intval($r));
                    
            $message = '<h1>You have registered</h1>';
            $message .= '<p>Dear, '.ucfirst($data['login']).'.</p>';
            $message .= '<p>You have been successfully registered at <a href="http://'.$_SERVER['SERVER_NAME'].'">'.$_SERVER['SERVER_NAME'].'</a></p>';
            parent::sendEmail($data['email'], 'admin@gmail.com',$message);
            return array('error'=>0,'uid'=> intval($r),'status'=>SERVER_CODE_REGISTRATION,'redirect'=>'http://'.$_SERVER['SERVER_NAME'].'/guest/list');
        } else {
            return array('msg' => 'Не получилось записать данные в базу', 'error' => 1);
        }
    }
    
    /**
     * Запись в БД
     * 
     * Записа данных пользователя в БД
     * 
     * @param array $data Данные, которые нужно записать.
     * @return array Результат. @see getLastId
     */
    public function inserUser($data){
        $sql = parent::createSqlText(array_keys($data),'INSERT');
        $table = 'users';
        $sql = str_replace('#table#', $table, $sql);
        $data_sql = parent::createDataSql($data);
        //return array('s'=>$sql,'d'=>$data_sql);
        parent::sqlInsert($sql, $data_sql);
        return parent::getLastId();
    }
    
}
