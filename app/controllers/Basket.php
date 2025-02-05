<?php
class Basket extends Controller {
    public function index() {
        $data = [];
        $cart = $this->model('BasketModel');

        if (isset($_POST['item_id'])) {
            $cart->addToCart($_POST['item_id']);
        }

        if (!$cart->isSetSession()) {
            $data['empty'] = 'Пустая корзина';
        } else {
            $products = $this->model('Products');
            $data['products'] = $products->getProductsCart($cart->getSession());
        }

        $this->view('basket/index', $data);
    }

    public function removeItem() {
        if (isset($_POST['item_id'])) {
            $cart = $this->model('BasketModel');
            $cart->removeFromCart($_POST['item_id']);
        }
        header('Location: /basket');
    }

    public function clearCart() {
        $cart = $this->model('BasketModel');
        $cart->deleteSession();
        header('Location: /basket');
    }

    public function confirm() {
        echo $_POST['amount'];
    }
}
