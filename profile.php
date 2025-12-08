<?php
    require 'config/init.php';
    require 'controllers/UserController.php';

    if (isset($_GET['logout'])) {
        UserController::logout_user();
    }    
    
    $userId = $_SESSION['userID'] ?? ($_GET['id'] ?? null);
    if (!$userId) {
        header('Location: login.php');
        exit;
    }

    // Handle profile requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        UserController::update();
    } elseif (isset($_GET['edit'])) {
        UserController::edit();
    } else {
        UserController::show();
    }
?>