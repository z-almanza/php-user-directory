<?php
    include_once 'db_connect.php';

    //Function that fetches all rows from users table and returns them as an array of associative arrays
    function getUsers(PDO $pdo): array {
        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query); //Using prepared statements for query
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>