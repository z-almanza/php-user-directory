<?php
    require_once 'controllers/UserController.php';

    // Handle profile requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        UserController::update();
    } elseif (isset($_GET['edit'])) {
        UserController::edit();
    } else {
        UserController::show();
    }
?>