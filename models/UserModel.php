<?php
    require_once 'db_connect.php'; //Connecting to users database

    class UserModel {
        protected static function getDB() {
            global $pdo;
            return $pdo;
        }

        public static function createUser($post) { 
            $db = static::getDB();
            $sql = "INSERT INTO users (firstName, lastName, username, email, password) VALUES (:firstName, :lastName, :username, :email, :password)"; //Query to add user to database
            $stmt = $db->prepare($sql);

            $success = $stmt->execute([
                ':firstName' => $post['firstName'],
                ':lastName' => $post['lastName'],
                ':username' => $post['username'],
                ':email' => $post['email'],
                ':password' => $post['password'],
            ]);

            return $success ? $db->lastInsertId() : false;
        }

        public static function getUserById($id) {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        }
    }



?>