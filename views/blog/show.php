<?php //Shows all blog posts
    require 'config/init.php';
    //Checks that profile shows up if user is admin or profile owner
    $pageTitle = "Blog Post";
    include BASE_PATH . '/views/partials/header.php'; 
?>
    <h2>Post</h2>

    <?php if ($post): ?>
    <div class='row'>
        <div class='card'>
            <h3 class='mb-o text-dark'><?= htmlspecialchars($post['title']) ?></h3>
            <div class='mb-1 text-muted'>Author <?= htmlspecialchars($post['author_id']) ?> - Posted <?= htmlspecialchars($post['publish_date']) ?></div>
            <p class='card-text mb-auto'><?= htmlspecialchars($post['body']) ?></p>
        </div>
    </div>
    <?php endif; ?>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>