<?php 
    include_once 'userModel.php';
    $rows = getUsers($pdo);

    $pageTitle = "User Database";
    include 'header.php';
?>

<!--Alternative PHP syntax to display user data in HTML table-->
<?php if ($rows): ?>
    <table class="table">
        <caption>List of Users</caption>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Email</th>
    </tr>
    <?php foreach ($rows as $row): 
        $id = htmlspecialchars($row['id']);
        $firstName = htmlspecialchars($row['firstname']);
        $lastName = htmlspecialchars($row['lastname']);
        $username = htmlspecialchars($row['username']);
        $email = htmlspecialchars($row['email']);
    ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $firstName ?></td>
        <td><?= $lastName ?></td>
        <td><?= $username ?></td>
        <td><?= $email ?></td>
    </tr>
    <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>
    
<?php include 'footer.php'; ?>