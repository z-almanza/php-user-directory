<?php 
    session_start();
    date_default_timezone_set('America/Chicago');

    //Define absolute path to the project root
    define('BASE_PATH', dirname(__DIR__)); // /home1/sherd/public_html/webdev/z_almanza/php-user-directory

    //Session username set in login_user method in UserController
    $displayName = $_SESSION['username'] ?? null;

    //Function to check if user is logged in by checking if userID exists
    /*function isLoggedIn() { 
        return (isset($_SESSION['userID']));
    }

    //Function to check if user is admin by making sure role exists first and that role is admin role
    function isAdmin() {
        return ((isset($_SESSION['role'])) && ($_SESSION['role'] === 'admin'));
    }

    //Function to check if user is a valid user by making sure userID exists and is the same as session user ID
    function isUser($id) {
        return ((isset($_SESSION['userID'])) && ($_SESSION['userID'] === $id));
    }*/
?>