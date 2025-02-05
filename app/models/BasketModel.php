<?php
session_start();
class BasketModel {
    private $session_name = 'cart';

    public function isSetSession() {
        return isset($_SESSION[$this->session_name]);
    }

    public function deleteSession() {
        unset($_SESSION[$this->session_name]);
    }

    public function getSession() {
        return $_SESSION[$this->session_name];
    }

    public function addToCart($itemID) {
        if (!$this->isSetSession()) {
            $_SESSION[$this->session_name] = $itemID;
        } else {
            $items = explode(',', $_SESSION[$this->session_name]);
            if (!in_array($itemID, $items)) {
                $items[] = $itemID;
            }
            $_SESSION[$this->session_name] = implode(',', $items);
        }
    }

    public function removeFromCart($itemID) {
        if ($this->isSetSession()) {
            $items = explode(',', $_SESSION[$this->session_name]);
            $items = array_diff($items, [$itemID]);
            $_SESSION[$this->session_name] = implode(',', $items);
        }
    }

    public function countItems() {
        if (!$this->isSetSession()) {
            return 0;
        } else {
            $items = explode(',', $_SESSION[$this->session_name]);
            return count($items);
        }
    }
}
