<?php //Shows all blog posts
    require 'config/init.php';
    //Checks that profile shows up if user is admin or profile owner
    $pageTitle = "Blog Posts";
    include BASE_PATH . '/views/partials/header.php'; 

    if (!isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
        header("Location: profile.php?error=" . urlencode("You do not have permission to view this blog."));
        exit;
    }
?>
    <h2>Edit Post Here</h2>  

<?php include BASE_PATH . '/views/partials/footer.php'; ?>