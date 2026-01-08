<?php
    include_once(__DIR__ . "/Db.php");

    class Product {
        private $name;
        private $description;
        private $category;
        private $price;
        private $stock;
        private $color;
        private $image;

        // Setters
        public function setName($name) {
            if(empty($name)) throw new Exception("Naam is verplicht.");
            $this->name = $name;
            return $this;
        }
        public function setDescription($description) {
            $this->description = $description;
            return $this;
        }
        public function setCategory($category) {
            $this->category = $category;
            return $this;
        }
        public function setPrice($price) {
            if($price < 0) throw new Exception("Prijs mag niet negatief zijn.");
            $this->price = $price;
            return $this;
        }
        public function setStock($stock) {
            $this->stock = $stock;
            return $this;
        }
        public function setColor($color) {
            $this->color = $color;
            return $this;
        }
        public function setImage($image) {
            $this->image = $image;
            return $this;
        }

        // Methods
        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO products (name, description, category, price, stock, color, image) VALUES (:name, :description, :category, :price, :stock, :color, :image)");
            $statement->bindValue(":name", $this->name);
            $statement->bindValue(":description", $this->description);
            $statement->bindValue(":category", $this->category);
            $statement->bindValue(":price", $this->price);
            $statement->bindValue(":stock", $this->stock);
            $statement->bindValue(":color", $this->color);
            $statement->bindValue(":image", $this->image);
            return $statement->execute();
        }

        public static function getAll() {
            $conn = Db::getConnection();
            $statement = $conn->query("SELECT * FROM products");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getByCategory($category) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM products WHERE category = :category");
            $statement->bindValue(":category", $category);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getById($id) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM products WHERE id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public static function delete($id) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("DELETE FROM products WHERE id = :id");
            $statement->bindValue(":id", $id);
            return $statement->execute();
        }
    }
?>