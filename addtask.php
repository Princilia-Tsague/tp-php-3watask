<?php
session_start();
include('core/config.php');
include('core/connexion.php');

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title'])) {
    
    $db = connectToDB($host, $dbname, $user, $password);
    
    
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $userId = $_SESSION['user']['id'];
    
    
    $urgent = isset($_POST['urgent']) ? 1 : 0;
    $important = isset($_POST['important']) ? 1 : 0;

    
$query = $db->prepare("
    INSERT INTO task (title, content, is_urgent, is_important, user_id, created_at) 
    VALUES (:title, :content, :is_urgent, :is_important, :user_id, NOW())
");


$query->execute([
    ':title'        => $_POST['title'],
    ':content'      => $_POST['content'],
    ':is_urgent'    => isset($_POST['urgent']) ? 1 : 0,
    ':is_important' => isset($_POST['important']) ? 1 : 0,
    ':user_id'      => $_SESSION['user']['id']
]);

    
    header('Location: account.php');
    exit();
} else {
    
    header('Location: account.php?error=empty');
    exit();
}