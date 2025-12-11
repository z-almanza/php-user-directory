<?php 
    require 'config/init.php';
    $pageTitle = "Login";
    include BASE_PATH . '/views/partials/header.php'; 
?>

<div class='container'>
    <h3>Login</h3>

    <form method='POST' action="login.php">
        <div class='row'>
            <div class='col'>
                <label for="username">Username</label>
                <input class='form-control' type="text" name="username" id="username" required
                value="<?= htmlspecialchars($post['username']) ?>">
            </div>

            <div class='col'>
                <label for="password">Password</label>
                <input class='form-control' type="password" name="password" id="password" required>
            </div>
        </div><br>

        <?php if (!empty($errors['login'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['login']) ?></p>
        <?php endif; ?>

        <button class='btn btn-primary' type="submit">Login</button>
    </form>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>