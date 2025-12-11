<?php
require_once 'db_connect.php';

class PostModel {
    protected static function getDB() {
        global $pdo;
        return $pdo;
    }
    
    public static function getAllPosts() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY publish_date DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getPostById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>