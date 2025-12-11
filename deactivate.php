<?php
    require 'config/init.php';
    require_once BASE_PATH . '/controllers/UserController.php';
    UserController::deactivate();
?>