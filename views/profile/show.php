<?php //Profile owner or admin
    require 'config/init.php';
    //Checks that profile shows up if user is admin or profile owner
    $pageTitle = "Registered";
    include BASE_PATH . '/views/partials/header.php'; 

    if (!isset($_SESSION['role']) && $_SESSION['userID'] !== $_GET['id']) {
        header("Location: profile.php?error=" . urlencode("You do not have permission to view this profile. You are not an admin or the specified user."));
        exit;
    }
?>
    <div class='container'>
        <h3>User Profile</h3>

        <!-- Display user info from database -->
        <table class='table'>
            <tr>
                <td><strong>First Name</strong></td>
                <td><?= htmlspecialchars($user['firstname']) ?></td>
            </tr>
            <tr>
                <td><strong>Last Name</strong></td>
                <td><?= htmlspecialchars($user['lastname']) ?></td>
            </tr>
            <tr>
                <td><strong>Username</strong></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
            <tr>
                <td><strong>Password</strong></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
            </tr>
        </table><br>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): //Only allows admins to access user list ?>
            <a class='btn btn-primary' href="admin/dashboard.php">User List</a>
        <?php endif; ?>

        <a class="btn btn-warning" href="profile.php?edit&id=<?= htmlspecialchars($user['id']) ?>">Edit Profile</a>
        <a class="btn btn-danger" href="deactivate.php?id=<?= htmlspecialchars($user['id']) ?>">Deactivate Profile</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): //Only allows admins to delete account ?>
            <a class='btn btn-danger' href="delete.php?id=<?= $user['id'] ?>" class="btn btn-danger">Delete User</a>
        <?php endif; ?>
    </div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>