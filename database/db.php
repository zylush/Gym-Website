<?php
// db.php
$use_database = false;  // Change to true if use MySQL database

if ($use_database) {
    

    $dsn = 'mysql:host=localhost;dbname=gym;charset=utf8';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }


} else {
    $pdo = null; // No database connection
}
?>