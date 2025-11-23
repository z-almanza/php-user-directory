<?php 
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
        </table>
    </div>

<?php include 'views/partials/footer.php'; ?>