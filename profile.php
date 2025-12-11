<?php
    require 'config/init.php';
    require BASE_PATH . '/controllers/UserController.php';

    if (isset($_GET['logout'])) {
        UserController::logout_user();
    }    
    
    $userId = $_SESSION['userID'] ?? ($_GET['id'] ?? null);
    if (!$userId) {
        header('Location: login.php');
        exit;
    }    

    // Handle profile requests
    $userIsAdmin = $_SESSION['role'] === 'admin';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        UserController::update();
    } elseif (isset($_GET['edit'])) {
        UserController::edit();
    } else {
        if ($userIsAdmin) {
            UserController::dashboard();
        } else {
            UserController::show();
        }
    }
?>