<?php
class Contact extends Controller {
    public function index() {
        $data = []; // Инициализация массива $data

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = $this->model('ContactModel');
            $mail->setData($_POST['name'], $_POST['email'], $_POST['age'], $_POST['message']);

            $isValid = $mail->validForm();
            if ($isValid === "Верно") {
                $result = $mail->mail();
                $data['message'] = $result === true ? "Сообщение успешно отправлено!" : $result;
            } else {
                $data['message'] = $isValid;
            }
        }

        $this->view("contact/index", $data);
    }

    public function about() {
        $this->view("contact/about");
    }
}
