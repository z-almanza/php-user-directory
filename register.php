<?php //Entry point - load controller
    require_once 'controllers/UserController.php';

    $controller = new UserController();
    //Passes control to register method in controller
    $controller->register();
?>