<!--Displays the registration form for edits-->
<?php //profile owner or admin
    require 'config/init.php';
    //Checks that edit is being made by admin or profile owner
    if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $_SESSION['userID'] !== $user['id']) {
        header("Location: profile.php?error=" . urlencode("You do not have permission to edit this profile."));
        exit;
    }
    $pageTitle = "Edit User";
    include BASE_PATH . '/views/partials/header.php'; 
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

<?php include BASE_PATH . '/views/partials/footer.php'; ?>