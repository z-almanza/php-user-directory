<?php
require_once 'config/init.php';
require_once BASE_PATH . '/models/PostModel.php';

class PostController {
    public static function index() {
        $posts = PostModel::getAllPosts();
        require BASE_PATH . '/views/blog/index.php';
    }
    
    public static function adminIndex() {
        $posts = PostModel::getAllPosts();
        require BASE_PATH . '/views/admin/blog/index.php';
    }


    public static function show() {
        $id = $_GET['id'] ?? null;
        $post = $id ? PostModel::getPostById($id) : null;
        if ($post) {
        require BASE_PATH . '/views/blog/show.php';
        } else {
            
            header("Location: profile.php?error=" . urlencode("Post not found." . $id));
            exit;
        }
    }

}    
?>