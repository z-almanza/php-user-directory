<!--Displays the registration form -->
<?php //public (registration)
    require 'config/init.php';
    $pageTitle = "Register";
    include BASE_PATH . '/views/partials/header.php'; 
    if (isset($_SESSION['role'])) {
        header("Location: profile.php?error=" . urlencode("Already registered."));
        exit;
    }
?>

<div class='container'>
    <h3>Register User</h3>

    <form method='POST' action='register.php'>
        <?php include 'partials/form-fields.php'; ?>
        <button type='submit' class='btn btn-primary'>Register</button>
        <?php if (!empty($errors['db'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?><br>
    </form>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>