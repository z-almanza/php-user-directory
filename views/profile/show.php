<?php 
    $pageTitle = "Registered";
    include './views/partials/header.php'; ?>

    <h3>User Profile</h3>

    <!-- Display user info from database -->
    <p><strong>First Name:</strong> <?= htmlspecialchars($user['firstName']) ?></p>
    <p><strong>Last Name:</strong> <?= htmlspecialchars($user['lastName']) ?></p>
    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Password:</strong> <?= htmlspecialchars($user['password']) ?></p>

<?php include './views/partials/footer.php'; ?>
