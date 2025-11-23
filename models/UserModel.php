<?php
    require_once 'db_connect.php';

    class UserModel {
        protected static function getDB() {
            global $pdo;
            return $pdo;
        }

        //Uses user inserted data to create user
        public static function createUser($post) {
            $db = static::getDB();
            $sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES (:firstname, :lastname, :username, :email, :password)";
            $stmt = $db->prepare($sql);

            $success = $stmt->execute([
                ':firstname' => $post['firstName'],
                ':lastname' => $post['lastName'],
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