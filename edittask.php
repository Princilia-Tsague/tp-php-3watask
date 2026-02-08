<?php
session_start();
if (!isset($_SESSION['loggedIn'])) { header('Location: login.php'); exit(); }

include('core/config.php');
include('core/connexion.php');
$db = connectToDB($host, $dbname, $user, $password);


if (!isset($_GET['id'])) { header('Location: account.php'); exit(); }

$query = $db->prepare("SELECT * FROM task WHERE id = :id AND user_id = :user_id");
$query->execute([':id' => $_GET['id'], ':user_id' => $_SESSION['user']['id']]);
$task = $query->fetch();

if (!$task) { 
    header('Location: account.php'); 
    exit(); 
    
}


if (!empty($_POST)) {
    $update = $db->prepare("
        UPDATE task 
        SET title = :title, content = :content, is_urgent = :is_urgent, is_important = :is_important 
        WHERE id = :id AND user_id = :user_id
    ");
    
    $update->execute([
        ':title'     => $_POST['title'],
        ':content'   => $_POST['content'],
        ':is_urgent'    => isset($_POST['urgent']) ? 1 : 0,
        ':is_important' => isset($_POST['important']) ? 1 : 0,
        ':id'        => $_GET['id'],
        ':user_id'   => $_SESSION['user']['id']
    ]);

    header('Location: account.php');
    exit();
}

$template = 'templates/edit_task.phtml';
include 'templates/layout.phtml';