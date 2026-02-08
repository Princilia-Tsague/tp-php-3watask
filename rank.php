<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

include('core/config.php');
include('core/connexion.php');


$db = connectToDB($host, $dbname, $user, $password);


$rankQuery = $db->query("
    SELECT 
    users.id, 
    users.username, 
    COUNT(task.id) as score 
    FROM users 
    LEFT JOIN task ON users.id = task.user_id AND task.is_completed = 1
    GROUP BY users.id 
    ORDER BY score DESC, users.username ASC
");
$rankings = $rankQuery->fetchAll();


$template = 'templates/rank.phtml';
include 'templates/layout.phtml';