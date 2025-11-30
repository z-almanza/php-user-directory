<!--Only contains inputs and labels-->
<div class='row'>
    <div class='col'>
        <label for='firstName'>First Name</label>
        <input type='text' id='firstName' name='firstName' class="form-control" value="<?= htmlspecialchars($user['firstname'] ?? $post['firstName'] ?? '') ?>">
        <?php if (!empty($errors['firstName'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['firstName']) ?></p>
        <?php endif; ?>
    </div>
    <div class='col'>
        <label for='lastName'>Last Name</label>
        <input type='text' id='lastName' name='lastName' class="form-control" value="<?= htmlspecialchars($user['lastname'] ?? $post['lastName'] ?? '') ?>">
        <?php if (!empty($errors['lastName'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['lastName']) ?></p>
        <?php endif; ?>
    </div>
</div><br>

<div class='row'>
    <div class='col'>
        <label for='username'>Username</label>
        <input type='text' id='username' name='username' class="form-control" value="<?= htmlspecialchars($user['username'] ?? $post['username'] ?? '') ?>">
        <?php if (!empty($errors['username'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['username']) ?></p>
        <?php endif; ?>
    </div>
    <div class='col'>
        <label for='email'>Email</label>
        <input type='email' id='email' name='email' class="form-control" value="<?= htmlspecialchars($user['email'] ?? $post['email'] ?? '') ?>">
        <?php if (!empty($errors['email'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['email']) ?></p>
        <?php endif; ?>
    </div>
</div><br>

<div class='row'>
    <div class='col'>
        <label for='password'>Password</label>
        <input type='text' id='password' name='password' class="form-control" value="<?= htmlspecialchars($user['password'] ?? $post['password'] ?? '') ?>">
        <?php if (!empty($errors['password'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['password']) ?></p>
        <?php endif; ?>
    </div>
    <div class='col'>
        <label for='passwordVer'>Verify Password</label>
        <input type='text' id='passwordVer' name='passwordVer' class="form-control" value="<?= htmlspecialchars($user['passwordVer'] ?? $post['passwordVer'] ?? '') ?>">
        <?php if (!empty($errors['passwordVer'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['passwordVer']) ?></p>
        <?php endif; ?>
    </div>
</div><br>