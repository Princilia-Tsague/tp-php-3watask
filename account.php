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

$userQuery = $db->prepare("SELECT email, created_at FROM users WHERE id = :id");
$userQuery->execute([':id' => $userId]);
$userInfo = $userQuery->fetch();


$taskQuery = $db->prepare("SELECT * FROM task WHERE user_id = :id AND is_completed = 0 ORDER BY created_at DESC");
$taskQuery->execute([':id' => $userId]);
$tasks = $taskQuery->fetchAll();


$historyQuery = $db->prepare("SELECT * FROM task WHERE user_id = :id AND is_completed = 1 ORDER BY created_at DESC");
$historyQuery->execute([':id' => $userId]);
$completedTasks = $historyQuery->fetchAll();


$countQuery = $db->prepare("SELECT COUNT(*) FROM task WHERE user_id = :id AND is_completed = 1");
$countQuery->execute([':id' => $userId]);
$doneCount = $countQuery->fetchColumn();


$rankQuery = $db->query("
    SELECT users.id, COUNT(task.id) as total_done 
    FROM users 
    LEFT JOIN task ON users.id = task.user_id AND task.is_completed = 1
    GROUP BY users.id 
    ORDER BY total_done DESC
");
$globalRanking = $rankQuery->fetchAll();


$myRank = 0;
foreach ($globalRanking as $index => $row) {
    if ($row['id'] == $userId) {
        $myRank = $index + 1;
        break;
    }
}


$badgeContent = ""; 
if ($myRank === 1) {
    $badgeContent = '<img src="assets/image/imgone.png" class="rank-badge" alt="1st">';
} elseif ($myRank === 2) {
    $badgeContent = '<img src="assets/image/imgtwo.png" class="rank-badge" alt="2nd">';
} elseif ($myRank === 3) {
    $badgeContent = '<img src="assets/image/imgthree.png" class="rank-badge" alt="3rd">';
} else {
    $badgeContent = '<span class="rank-number">#' . $myRank . '</span>';
}

$template = 'templates/account.phtml';
include 'templates/layout.phtml';