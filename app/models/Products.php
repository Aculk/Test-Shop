<?php
    require 'DB.php';

    class Products {
        private $_db;
    
        public function __construct() {
            $this->_db = DB::getInstence();
        }
    
        public function getPaginatedProducts($offset, $limit) {
            $stmt = $this->_db->prepare("SELECT * FROM `products` ORDER BY `id` DESC LIMIT :offset, :limit");
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getTotalProductsCount() {
            $stmt = $this->_db->query("SELECT COUNT(*) AS total FROM `products`");
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        }

        public function getProductsLimited($order = 'id', $limit = 3) {
            $stmt = $this->_db->prepare("SELECT * FROM `products` ORDER BY $order DESC LIMIT :limit");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductsCategory($category) {
            $stmt = $this->_db->prepare("SELECT * FROM `products` WHERE `category` = :category ORDER BY `id` DESC");
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getOneProduct($id) {
            $stmt = $this->_db->prepare("SELECT * FROM `products` WHERE `id` = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getProductsCart($items) {
            $result = $this->_db->query("SELECT * FROM `products` WHERE `id` IN ($items)");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
    }
    