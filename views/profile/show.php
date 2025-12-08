<?php 
    require 'config/init.php';
    $pageTitle = "Registered";
    include 'views/partials/header.php'; 
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

        <a class="btn btn-warning" href="profile.php?edit&id=<?= htmlspecialchars($user['id']) ?>">Edit Profile</a>
        <a class="btn btn-danger" href="deactivate.php?id=<?= htmlspecialchars($user['id']) ?>">Deactivate Profile</a>
    </div>

<?php include 'views/partials/footer.php'; ?>