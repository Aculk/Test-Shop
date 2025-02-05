<?php
class NotFound extends Controller {
    public function index() {
        http_response_code(404); // Устанавливаем статус HTTP 404
        $this->view("errors/404");
    }
}


