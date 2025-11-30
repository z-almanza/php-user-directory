<!--Displays the registration form for edits-->
<?php 
    $pageTitle = "Edit User";
    include 'views/partials/header.php'; 
?>

<div class='container'>
    <h2>Edit User Profile</h2>

    <form method='POST' action='profile.php'>
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        <?php include 'partials/form-fields.php'; ?>
        <button type='submit' class='btn btn-primary'>Save Changes</button>
        <?php if (!empty($errors['db'])): ?>
            <p class="text-danger"><?= htmlspecialchars($errors['db']) ?></p>
        <?php endif; ?><br>
    </form>
</div>

<?php include 'views/partials/footer.php'; ?>