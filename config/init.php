<?php 
    session_start();
    date_default_timezone_set('America/Chicago');

    //Session username set in login_user method in UserController
    $displayName = $_SESSION['username'] ?? null;
?>