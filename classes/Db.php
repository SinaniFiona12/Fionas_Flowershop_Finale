<?php
    abstract class Db {
        private static $conn;

        public static function getConnection() {
            if (self::$conn != null) {
                return self::$conn;
            } else {
                
                $host = 'ssql100.infinityfree.com'; // Jouw MySQL Hostname
                $db = 'if0_40858802_flower';         // Jouw Database Name
                $user = 'if0_40858802';              // Jouw MySQL Username
                $pass = 'JZlKmqdUN5bL';          // Jouw vPanel Password

                // Let op: charset=utf8mb4 toevoegen is slim voor emoji's/speciale tekens
                self::$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
                return self::$conn;
            }
        }
    }
?>