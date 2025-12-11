<?php
require 'config/init.php';
require_once BASE_PATH . '/controllers/PostController.php';

if (isset($_GET['id'])) {
    PostController::show();
} else {
    if ($_SESSION['role'] === 'admin') {
        PostController::adminIndex();
    } else {
        PostController::index();
    }
}

?>
