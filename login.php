<?php
session_start();


if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header("Location: account.php");
    exit();
}

include('core/config.php');
include('core/connexion.php');

if (!empty($_POST)) {
    $db = connectToDB($host, $dbname, $user, $password);
    $username = $_POST['username'];
    $userpassword = $_POST['password'];

    $query = $db->prepare("SELECT * FROM users WHERE username = :username");
    $query->execute([':username' => $username]);
    $userInDb = $query->fetch();
    
    if ($userInDb && password_verify($userpassword, $userInDb['password'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = [
            'id' => $userInDb['id'],
            'username' => $userInDb['username']
        ];
        
        header("Location: account.php");
        exit();
    } else {
        $error = "Incorrect login details. Please try again.";
    }

}


$template='templates/login.phtml';

include 'templates/layout.phtml';