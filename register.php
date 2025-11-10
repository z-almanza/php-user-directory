<?php //Entry point
    require_once 'controllers/UserController.php';

    $controller = new UserController(); 
    $controller->register(); //Passes control to a method in user controller
?>