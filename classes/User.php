<?php
    include_once(__DIR__ . "/Db.php");

    class User {
        private $email;
        private $password;
        private $fullname;
        private $currency = 1000; // Startbedrag volgens opdracht

        public function setEmail($email) {
            if (empty($email)) {
                throw new Exception("Email mag niet leeg zijn.");
            }
            $this->email = $email;
            return $this;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setPassword($password) {
            if (empty($password) || strlen($password) < 6) {
                throw new Exception("Wachtwoord moet minstens 6 tekens lang zijn.");
            }
            $this->password = $password;
            return $this;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setFullname($fullname) {
            if (empty($fullname)) {
                throw new Exception("Naam mag niet leeg zijn.");
            }
            $this->fullname = $fullname;
            return $this;
        }

        public function getFullname() {
            return $this->fullname;
        }

        public function register() {
            $conn = Db::getConnection();
            
            // Check of email al bestaat
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            if($statement->rowCount() > 0){
                throw new Exception("Dit emailadres is al in gebruik.");
            }

            $options = ['cost' => 12];
            $passwordHash = password_hash($this->password, PASSWORD_DEFAULT, $options);

            $statement = $conn->prepare("INSERT INTO users (email, password, fullname, currency, role) VALUES (:email, :password, :fullname, :currency, 'user')");
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $passwordHash);
            $statement->bindValue(":fullname", $this->fullname);
            $statement->bindValue(":currency", $this->currency);
            
            return $statement->execute();
        }

        public function canLogin() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($this->password, $user['password'])) {
                return $user; // Return user array (inclusief id, role, currency)
            } else {
                return false;
            }
        }

        public function changePassword($newPassword) {
            $conn = Db::getConnection();
            $options = ['cost' => 12];
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT, $options);

            $statement = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
            $statement->bindValue(":password", $passwordHash);
            $statement->bindValue(":email", $this->email);
            return $statement->execute();
        }
    }
?>