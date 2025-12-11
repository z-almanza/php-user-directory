<?php //Entry point - load controller
    require 'config/init.php';
    require_once BASE_PATH . '/controllers/UserController.php';

    $controller = new UserController();

    //Passes control to register method in controller
    $controller->register();
?>