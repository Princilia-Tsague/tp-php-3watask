<?php
session_start();
include('core/config.php');
include('core/connexion.php');

if (isset($_GET['id'])) {
    $db = connectToDB($host, $dbname, $user, $password);
    $query = $db->prepare("DELETE FROM task WHERE id = :id AND user_id = :user_id");
    $query->execute([
        ':id' => $_GET['id'],
        ':user_id' => $_SESSION['user']['id']
    ]);
}

header('Location: account.php');
exit();