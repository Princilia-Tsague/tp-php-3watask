<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

include('core/config.php');
include('core/connexion.php');

$db = connectToDB($host, $dbname, $user, $password);
$userId = $_SESSION['user']['id'];

$deleteTasks = $db->prepare("DELETE FROM task WHERE user_id = :id");
$deleteTasks->execute([':id' => $userId]);

$deleteUser = $db->prepare("DELETE FROM users WHERE id = :id");
$deleteUser->execute([':id' => $userId]);

session_destroy();


header('Location: login.php?message=account_deleted');
exit();