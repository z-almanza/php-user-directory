<?php 
    require 'config/init.php';
    $pageTitle = "Deactivate Account";
    include 'views/partials/header.php'; 
?>

    <h2>Confirm Deactivation</h2>
    <p>Are you sure you want to deactivate this account? You must contact the webmaster to reactivate it.</p>

    <form method="post" action="deactivate.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
    <button type="submit" name="deactivate" class="btn btn-danger">Confirm Deactivation</button>
    <a href="profile.php?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-secondary">Cancel</a>
    </form>

<?php include 'views/partials/footer.php'; ?>
