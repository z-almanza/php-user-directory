<!--Displays the registration form -->
<?php 
    $pageTitle = "Register";
    include 'views/partials/header.php'; 
?>

<div class='container'>
    <h2>Register User</h2>

    <form method='POST' action='register.php'>
        <div class='row'>
            <div class='col'>
                <label for='firstName'>First Name</label>
                <input id='firstName' name='firstName' class="form-control" value="<?= htmlspecialchars($post['firstName'] ?? '') ?>">
                <?php if (!empty($errors['firstName'])): ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['firstName']) ?></p>
                <?php endif; ?>
            </div>
            <div class='col'>
                <label for='lastName'>Last Name</label>
                <input id='lastName' name='lastName' class="form-control" value="<?= htmlspecialchars($post['lastName'] ?? '') ?>">
                <?php if (!empty($errors['lastName'])): ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['lastName']) ?></p>
                <?php endif; ?>
            </div>
        </div><br>

        <div class='row'>
            <div class='col'>
                <label for='username'>Username</label>
                <input id='username' name='username' class="form-control" value="<?= htmlspecialchars($post['username'] ?? '') ?>">
                <?php if (!empty($errors['username'])): ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['username']) ?></p>
                <?php endif; ?>
            </div>
            <div class='col'>
                <label for='email'>Email</label>
                <input id='email' name='email' class="form-control" value="<?= htmlspecialchars($post['email'] ?? '') ?>">
                <?php if (!empty($errors['email'])): ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['email']) ?></p>
                <?php endif; ?>
            </div>
        </div><br>

        <div class='row'>
            <div class='col'>
                <label for='password'>Password</label>
                <input id='password' name='password' class="form-control" value="<?= htmlspecialchars($post['password'] ?? '') ?>">
                <?php if (!empty($errors['password'])): ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>
            <div class='col'>
                <label for='passwordVer'>Verify Password</label>
                <input id='passwordVer' name='passwordVer' class="form-control" value="<?= htmlspecialchars($post['passwordVer'] ?? '') ?>">
                <?php if (!empty($errors['passwordVer'])): ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['passwordVer']) ?></p>
                <?php endif; ?>
            </div>
        </div><br>

        <button type='submit' class='button btn-primary'>Register</button>
        <?php if (!empty($errors['db'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?><br>
    </form>
</div>

<?php include 'views/partials/footer.php'; ?>