<!--Admin view/manage users view-->
<?php include 'config/init.php';
    $pageTitle = "Admin Dashboard";
    include BASE_PATH . '/views/partials/header.php'; 
    if ($_SESSION['role'] !== 'admin') {
        header("Location: profile.php?error=" . urlencode("Unauthorized action."));
        exit;
    }
?>

<h2>Admin Dashboard</h2>
<table class='table'>
  <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= htmlspecialchars($user['id']) ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td><?= $user['is_blocked'] ? 'Blocked' : 'Active' ?></td>
        <td>
          <a class='btn btn-primary' href="profile.php?edit&id=<?= urlencode($user['id']) ?>">Edit</a>
          <a class='btn btn-danger' href="deactivate.php?id=<?= urlencode($user['id']) ?>">Deactivate</a>
          <a class='btn btn-danger' href="delete.php?id=<?= urlencode($user['id']) ?>">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>