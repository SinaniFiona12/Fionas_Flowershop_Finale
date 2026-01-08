<?php
    include_once(__DIR__ . "/Db.php");

    class Review {
        private $productId;
        private $userEmail;
        private $text;

        public function setProductId($id) { $this->productId = $id; }
        public function setUserEmail($email) { $this->userEmail = $email; }
        public function setText($text) { 
            if(empty($text)) throw new Exception("Review cannot be empty.");
            $this->text = $text; 
        }

        public function save() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO reviews (product_id, user_email, text) VALUES (:pid, :email, :text)");
            $statement->bindValue(":pid", $this->productId);
            $statement->bindValue(":email", $this->userEmail);
            $statement->bindValue(":text", $this->text);
            return $statement->execute();
        }

        public static function getAllForProduct($productId) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM reviews WHERE product_id = :pid ORDER BY date DESC");
            $statement->bindValue(":pid", $productId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>