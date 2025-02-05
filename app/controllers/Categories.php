<?php
class Categories extends Controller {
    public function index($page = 1) {
        $products = $this->model('Products');

        // Количество товаров на одной странице
        $limit = 3;

        // Общее количество товаров
        $totalProducts = $products->getTotalProductsCount();

        // Общее количество страниц
        $totalPages = ceil($totalProducts / $limit);

        // Проверка на существование страницы
        if ($page < 1 || $page > $totalPages) {
            http_response_code(404);
            $this->view('errors/404'); // Подключаем страницу 404
            return;
        }

        // Смещение для SQL-запроса
        $offset = ($page - 1) * $limit;

        // Получаем товары для текущей страницы
        $paginatedProducts = $products->getPaginatedProducts($offset, $limit);

        // Передаём данные в представление
        $data = [
            'products' => $paginatedProducts,
            'title' => 'Все товары на сайте',
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];

        $this->view('categories/index', $data);
    }

    public function shoes() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('shoes'), 'title' => 'Категория обувь'];
        $this->view('categories/index', $data);
    }

    public function hats() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('hats'), 'title' => 'Категория кепки'];
        $this->view('categories/index', $data);
    }

    public function shirts() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('shirts'), 'title' => 'Категория футболки'];
        $this->view('categories/index', $data);
    }

    public function watches() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('watches'), 'title' => 'Категория часы'];
        $this->view('categories/index', $data);
    }

    
}
