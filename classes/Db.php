<?php
    abstract class Db {
        private static $conn;

        public static function getConnection() {
            if (self::$conn != null) {
                return self::$conn;
            } else {
                self::$conn = new PDO('mysql:host=localhost;dbname=flowershop', 'root', '');
                return self::$conn;
            }
        }
    }
?>