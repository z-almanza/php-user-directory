<!--Confirmation view for deleting accounts-->
<?php //profile owner or admin
    require 'config/init.php';
    //Checks that deletion is being made by admin or profile owner
    if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $_SESSION['userID'] !== $user['id']) {
        header("Location: profile.php?error=" . urlencode("You do not have permission to deactivate this profile."));
        exit;
    }
    $pageTitle = "Delete Account";
    include BASE_PATH . '/views/partials/header.php'; 
?>

<form method="post" action="../../delete.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
    <p>Are you sure you want to delete this account? This action cannot be undone.</p>
    <button class='btn btn-danger' type="submit" name="delete">Confirm Delete</button>
    <a href="profile.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-secondary">Cancel</a>
</form>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>