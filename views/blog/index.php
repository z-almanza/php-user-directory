<?php //Shows all blog posts
    require 'config/init.php';
    //Checks that profile shows up if user is admin or profile owner
    $pageTitle = "Blog Posts";
    include BASE_PATH . '/views/partials/header.php'; 
?>
    <h2>Posts</h2>

    <?php foreach ($posts as $post): ?>
    <div class='row' id="<?= htmlspecialchars($post['id']) ?>">
        <div class='card'>
            <h3 class='mb-o text-dark'><?= htmlspecialchars($post['title']) ?></h3>
            <div class='mb-1 text-muted'>Author <?= htmlspecialchars($post['author_id']) ?> - Posted <?= htmlspecialchars($post['publish_date']) ?></div>
            <p class='card-text mb-auto'><?= htmlspecialchars($post['body']) ?></p>
        </div>
    </div>
    <?php endforeach; ?>


<?php include BASE_PATH . '/views/partials/footer.php'; ?>