<!--Displays the registration form -->
<?php 
    require 'config/init.php';
    $pageTitle = "Register";
    include 'views/partials/header.php'; 
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

<?php include 'views/partials/footer.php'; ?>