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
    <h2>Posts</h2>  

    <a class='btn btn-primary' href="views/admin/blog/create.php" class="btn btn-danger">Add Post</a><br><br>

    <?php foreach ($posts as $post): ?>
    <div class='row mb-2' id="<?= htmlspecialchars($post['id']) ?>">
        <div class='col-md-8'>
            <div class='card'>
                <h3 class='mb-o text-dark'><?= htmlspecialchars($post['title']) ?></h3>
                <div class='mb-1 text-muted'>Author <?= htmlspecialchars($post['author_id']) ?> - Posted <?= htmlspecialchars($post['publish_date']) ?></div>
                <p class='card-text mb-auto'><?= htmlspecialchars($post['body']) ?></p>
            </div>
        </div>
        <div class='col-md-4'>
            <div>
                <a class='btn btn-primary' href="views/admin/blog/edit.php?id=<?= $post['id'] ?>" class="btn btn-danger">Edit Post</a>
                <a class='btn btn-danger' href="views/admin/blog/edit.php?id=<?= $post['id'] ?>" class="btn btn-danger">Delete Post</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>


<?php include BASE_PATH . '/views/partials/footer.php'; ?>