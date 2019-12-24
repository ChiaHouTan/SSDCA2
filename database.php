<?php
    $dsn = 'mysql:host=localhost;dbname=php-crud';
    $username = 'root';
    $password = 'root';
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>