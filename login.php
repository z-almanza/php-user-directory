<?php
    require 'config/init.php';
    require BASE_PATH . '/controllers/UserController.php';

    $controller = new UserController();

    //Passes control to register method in controller
    $controller->login_user();
?>