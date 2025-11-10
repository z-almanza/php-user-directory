<?php // db_connect.php - Links PHP app to MySQL Database
    $host = 'localhost';
    $db   = 'sherd_z_almanza';
    $user = 'sherd_z_almanza';
    $pass = 'QlkWV,-t.~@R';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        exit('Database connection failed: ' . $e->getMessage());
    }
?>