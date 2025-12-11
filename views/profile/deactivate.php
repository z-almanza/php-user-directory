<?php //profile owner or admin
    require 'config/init.php';
    //Checks that deactivation is being made by admin or profile owner
    if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin' && $_SESSION['userID'] !== $user['id']) {
        header("Location: profile.php?error=" . urlencode("You do not have permission to deactivate this profile."));
        exit;
    }
    $pageTitle = "Deactivate Account";
    include BASE_PATH . '/views/partials/header.php'; 
?>

    <h2>Confirm Deactivation</h2>
    <p>Are you sure you want to deactivate this account? You must contact the webmaster to reactivate it.</p>

    <form method="post" action="deactivate.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
    <button type="submit" name="deactivate" class="btn btn-danger">Confirm Deactivation</button>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="admin/dashboard.php" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <a href="profile.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-secondary">Cancel</a>
    <?php endif; ?>    
    </form>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>
