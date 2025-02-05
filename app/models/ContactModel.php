<?php
    class ContactModel {
        private $name;
        private $email;
        private $age;
        private $message;

        public function setData($name, $email, $age, $message) {
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->message = $message;
        }

        public function validForm() {
            $errors = [];
        
            if(strlen($this->name) < 3)
                $errors[] = "Имя слишком короткое";
            if(strlen($this->email) < 3)
                $errors[] = "Email слишком короткий";
            if(!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                $errors[] = "Вы ввели неверный возраст";
            if(strlen($this->message) < 10)
                $errors[] = "Сообщение слишком короткое";
        
            return empty($errors) ? "Верно" : implode('. ', $errors);
        }
        
        
        public function mail() {
            $to = "admin@mail.com";
            $message = "Имя: " . $this->name . ". Возраст: " . $this->age . ". Сообщение: " . $this->message;
        
            $subject = "=?utf-8?B?" . base64_encode("Сообщение с нашего сайта") . "?=";
            $headers = "From: $this->email\r\nReply-to: $this->email\r\nContent-type: text/html; charset=utf-8\r\n";
        
            // Для локального тестирования записываем в файл
            file_put_contents('mail_log.txt', $message, FILE_APPEND);
        
            return true; // Имитация успешной отправки
        }
        

    }