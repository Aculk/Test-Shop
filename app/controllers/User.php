<?php
    class User extends Controller {
        public function reg() {

        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model('UserModel');
            $user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);

            $isValid = $user->validForm();
            if ($isValid === "Верно")
                $user->addUser();
            else 
                $data['message'] = $isValid;
        }

            $this->view('user/reg', $data);
        }

        public function dashboard() {
            $user = $this->model('UserModel');
            $userData = $user->getUser();
        
            if (!$userData) {
                header('Location: /user/auth');
                exit();
            }
        
            if (isset($_POST['exit_btn'])) {
                $user->logOut();
                exit();
            }
        
            $this->view('user/dashboard', $userData);
        }
        
        public function auth() {

            $data = [];
            if(isset($_POST['email'])) {
                $user = $this->model('UserModel');
                $data['message'] = $user->auth($_POST['email'], $_POST['pass']);
            }

            $this->view('user/auth', $data); 
        }

        public function uploadPhoto() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
                    echo "Ошибка загрузки файла.";
                    return;
                }

                $file = $_FILES['profile_image'];

                // Проверка размера файла
                if ($file['size'] > 500 * 1024) { // 500 KB
                    echo "Файл слишком большой. Максимальный размер — 500 КБ.";
                    return;
                }

                // Проверка расширения
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    echo "Недопустимый формат файла. Разрешены только jpg, jpeg, png, gif.";
                    return;
                }

                // Генерация уникального имени файла
                $newFileName = uniqid() . '.' . $extension;
                $uploadDir = 'public/uploads/profile_images/';
                $uploadPath = $uploadDir . $newFileName;

                // Создание директории, если она отсутствует
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Перемещение файла
                if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    echo "Ошибка сохранения файла.";
                    return;
                }

                // Сохранение имени файла в базе данных
                $userModel = $this->model('UserModel');
                $userModel->updateProfileImage($_COOKIE['login'], $newFileName);

                echo "Файл успешно загружен.";
                header('Location: /user/dashboard');
                exit();
            }
        }
    }