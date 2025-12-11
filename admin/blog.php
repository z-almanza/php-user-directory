<?php //Entry point for admin dashboard - admin only! 
    require 'config/init.php';
    require_once BASE_PATH . '/controllers/PostController.php';

    /*if ($_SESSION['role'] !== 'admin') {
        header("Location: index.php?error=" . urlencode("Access denied. Admins only."));
        exit;
    }*/

    PostController::adminIndex();
?>