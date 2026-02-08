<?php
include('config.php');

function connectToDB($host, $dbname, $user, $password) {
    $dsn = "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8";
    
    try {
        $db = new PDO($dsn, $user, $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $db;
        
    } catch (PDOException $e) {
        die('Unable to create account : ' . $e->getMessage());
    }    
    
}