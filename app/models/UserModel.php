<?php
require 'DB.php';

    class UserModel {
        private $name;
        private $email;
        private $pass;
        private $re_pass;

        private $_db = null;

        public function __construct() {
            $this->_db = DB::getInstence();
        }

        public function setData($name, $email, $pass, $re_pass) {
            $this->name = $name;
            $this->email = $email;
            $this->pass = $pass;
            $this->re_pass = $re_pass;
        }

        public function validForm() {
            $errors = [];
        
            if(strlen($this->name) < 3)
                $errors[] = "Имя слишком короткое";
            if(strlen($this->email) < 3)
                $errors[] = "Email слишком короткий";
            if(strlen($this->pass < 3))
                $errors[] = "Пароль не менее 3 символов";
            if($this->pass != $this->re_pass)
                $errors[] = "Пароли не совпадают";
        
            return empty($errors) ? "Верно" : implode('. ', $errors);
        }

        public function addUser() {
            $sql = 'INSERT INTO users(name, email, pass) VALUES(:name, :email, :pass)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass, PASSWORD_DEFAULT);

            $query->execute(['name' => $this->name, 'email' => $this->email, 'pass' => $pass]);

            $this->setAuth($this->email);
        }

        public function getUser() {
            if (!isset($_COOKIE['login']) || empty($_COOKIE['login'])) {
                return false; // Если cookie не установлен, возвращаем false
            }
        
            $email = $_COOKIE['login'];
            $stmt = $this->_db->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function logOut() {
            setcookie('login', $this->email, time() - 3600, '/');
            unset($_COOKIE['login']);
            header('Location: /user/auth');
        }
        
        public function auth($email, $pass) {
            $stmt = $this->_db->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if (!$user) {
                return 'Пользователь не существует';
            }
        
            if (password_verify($pass, $user['pass'])) {
                $this->email = $email; // Устанавливаем email для метода setAuth
                $this->setAuth($email);
            } else {
                return 'Пароль неверный';
            }
        }
        

        public function setAuth($email) {
            setcookie('login', $email, time() + 3600 * 24, '/');
            header('Location: /user/dashboard');
        }

        public function updateProfileImage($email, $fileName) {
            $stmt = $this->_db->prepare("UPDATE `users` SET `profile_image` = :profile_image WHERE `email` = :email");
            $stmt->bindParam(':profile_image', $fileName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
        }
    }