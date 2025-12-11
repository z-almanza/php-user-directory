<!--Reusable header-->
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="This page does not include content assisted by AI tools but will indicate if it does. Professor Herd\'s class articles and W3Schools were used for guidance.">
        <!--Customizable Title-->
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="views/partials/styles.css">
    </head>

    <body>
    <div class="container">
    <header>
        <h1>PHP Programming - Zamantha Almanza</h1>
    </header>
    <nav>
        <a href="userView.php">Users</a> | 
        <a href="register.php">Register</a>
    </nav>
    <main>
        
        <div class='container'>
        <!--Uses displayName from init.php file to greet users-->
            <?php if ($displayName): ?>
                <h2>Welcome <?= $_SESSION['role'] ?>, <?= htmlspecialchars($displayName) ?>!</h2>
            <?php else: ?>
                <h2>Welcome, guest.</h2>
            <?php endif; ?>
        </div>

        <!--If user is logged in, only logout button will show. Else, both register and sign in button show.-->
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="profile.php?id=<?= $_SESSION['userID'] ?>" class="btn btn-success">Dashboard</a>
        <?php endif; ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="index.php" class="btn btn-success">Blog</a>
        <?php else: ?>
            <a href="index.php" class="btn btn-success">Blog</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['userID'])): ?>
            <a href="profile.php?logout=true" class="btn btn-success">Logout</a>
        <?php else: ?>
            <a href="register.php" class="btn btn-success">Register</a>
            <a href="login.php" class="btn btn-success">Sign In</a>
        <?php endif; ?><br><br>
        
        

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
