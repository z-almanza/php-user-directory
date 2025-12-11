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
            $sql = "INSERT INTO users (firstname, lastname, username, email, password, role, is_blocked) VALUES (:firstname, :lastname, :username, :email, :password, 'user', 0)";
            $stmt = $db->prepare($sql);

            $success = $stmt->execute([
                ':firstname' => $post['firstName'],
                ':lastname' => $post['lastName'],
                ':username' => $post['username'],
                ':email' => $post['email'],
                ':password' => password_hash($post['password'], PASSWORD_DEFAULT),
            ]);

            return $success ? $db->lastInsertId() : false;
        }

        //Returns user info by ID
        public static function getUserById($id) {
            $db = static::getDB();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        }

        //Updates user info
        public static function updateUser($id, $firstName, $lastName, $username, $email, $password) {
            global $pdo;

            $fields = [
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'username' => $username
            ];

            $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, username = :username";

            //If new password exists, setting it with a hash
            if (!empty($password)) {
                $fields['password'] = password_hash($password, PASSWORD_DEFAULT);
                $sql += ", password = :password";
            }

            $sql += " WHERE id = :id";
            $fields['id'] = $id;

            $stmt = $pdo->prepare($sql);
            return $stmt->execute($fields);
        }

        //Soft blocks user by ID
        public static function deactivateUser($id) {
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE users SET is_blocked = 1 WHERE id = :id LIMIT 1");
            return $stmt->execute([':id' => $id]);
        }

        //Finds user in database by username
        public static function findByUsername($username) { 
            $db = static::getDB(); 
            $stmt = $db->prepare("SELECT id, username, password, role, is_blocked FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);

            return $stmt->fetch();
        }

        //Updates user password by ID
        public static function update_password_by_id($id, $hashedPassword) {
            global $pdo;

            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
            return $stmt->execute([
                ':password' => $hashedPassword,
                ':id' => $id
            ]);
        }

        //Admin function to get all users
        public static function getAllUsers() {
            global $pdo;
            $stmt = $pdo->query("SELECT id, username, role, is_blocked FROM users ORDER BY id ASC");
            return $stmt->fetchAll();
        }

        //Admin function to update user's role
        public static function updateRole($userId, $newRole) {
            global $pdo;
            $stmt = $pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
            $stmt->execute(['role' => $newRole, 'id' => $userId]);
        }

        //Admin function to set user status to 'block'
        public static function setBlockStatus($userId, $blockStatus) {
            global $pdo;
            $stmt = $pdo->prepare("UPDATE users SET is_blocked = :blocked WHERE id = :id");
            $stmt->execute(['blocked' => $blockStatus, 'id' => $userId]);
        }

        //Admin function to delete user
        public static function deleteUser($id) {
            $db = static::getDB();
            $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        }
    }
?>