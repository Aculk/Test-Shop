<?php
class App {
    protected $controller = 'Home'; // Контроллер по умолчанию
    protected $method = 'index';    // Метод по умолчанию
    protected $params = [];         // Параметры

    public function __construct() {
        $url = $this->parseUrl();

        // Проверка существования контроллера
        if (isset($url[0]) && file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        } elseif (isset($url[0])) {
            // Если контроллер не найден, вызываем страницу 404
            $this->controller = 'NotFound';
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Проверка метода в контроллере
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        } elseif ($this->controller instanceof NotFound) {
            $this->method = 'index'; // Устанавливаем метод для страницы 404
        }

        // Получение оставшихся параметров
        $this->params = $url ? array_values($url) : [];

        // Вызов контроллера и метода с параметрами
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(
                rtrim($_GET['url'], '/'),
                FILTER_SANITIZE_URL
            ));
        }
        return [];
    }
}
