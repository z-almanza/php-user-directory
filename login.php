<?php
    require 'config/init.php';
    require 'controllers/UserController.php';

    $controller = new UserController();

    //Passes control to register method in controller
    $controller->login_user();
?>