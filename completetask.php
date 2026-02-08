<?php
session_start();
include('core/config.php');
include('core/connexion.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: account.php?error=missing_id');
    exit();
}

$db = connectToDB($host, $dbname, $user, $password);
$id = (int)$_GET['id'];
$userId = (int)$_SESSION['user']['id'];

$query = $db->prepare("UPDATE task SET is_completed = 1 WHERE id = :id AND user_id = :userId");
$query->execute([
    ':id' => $id,
    ':userId' => $userId
]);

header('Location: account.php');
exit();