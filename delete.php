<?php //POST entry point for hard deletes - admin only! 
    require 'config/init.php';
    //Checks that delete action is being made by admin and profile owner
    if ($_SESSION['role'] !== 'admin' && $_SESSION['userID'] !== $user['id']) {
        header("Location: profile.php?error=" . urlencode("You do not have permission to edit this profile."));
        exit;
    }
    require_once BASE_PATH . '/controllers/UserController.php';

    UserController::delete();
?>