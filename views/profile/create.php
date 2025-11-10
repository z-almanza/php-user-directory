<?php 
    $pageTitle = "Register";
    include './views/partials/header.php'; ?>

<!--Displays registration form-->
<fieldset>
    <legend> Registration </legend>
    <form method="POST" action="register.php">
        <!--Accepts user's first name as text input-->
        <label class="form-label" for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($post['firstName'] ?? '') ?>">
        <!--firstName error check and message-->
        <?php if (!empty($errors['firstName'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['firstName']) ?></p>
        <?php endif; ?><br>

        <!--Accepts user's last name as text input-->
        <label class="form-label" for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($post['lastName'] ?? '') ?>">
        <!--lastName error check and message-->
        <?php if (!empty($errors['lastName'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['lastName']) ?></p>
        <?php endif; ?><br>

        <!--Accepts user's username as text input-->
        <label class="form-label" for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($post['username'] ?? '') ?>">
        <!--username error check and message-->
        <?php if (!empty($errors['username'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['username']) ?></p>
        <?php endif; ?><br>

        <!--Accepts user's email as text input-->
        <label class="form-label" for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= htmlspecialchars($post['email'] ?? '') ?>">
        <!--email error check and message-->
        <?php if (!empty($errors['email'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['email']) ?></p>
        <?php endif; ?><br>

        <!--Accepts user's password as text input-->
        <label class="form-label" for="password">Password</label>
        <input type="text" name="password" id="password">
        <!--password error check and message-->
        <?php if (!empty($errors['password'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['password']) ?></p>
        <?php endif; ?><br>

        <!--Accepts user's password again as text input-->
        <label class="form-label" for="passwordVer">Verify Password</label>
        <input type="text" name="passwordVer" id="passwordVer"> 
        <!--passwordVer match error check and message-->
        <?php if (!empty($errors['passwordVer'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['passwordVer']) ?></p>
        <?php endif; ?><br>

        <input class="form-control" type="submit" name="submit" value="Register">
        <?php if (!empty($errors['db'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?><br>
    </form>
</fieldset>

<?php include './views/partials/footer.php' ?>