<?php
session_start();
include('core/config.php');
include('core/connexion.php');
$errors = [];

if(!empty($_POST)){

    $db = connectToDB($host, $dbname, $user, $password);
    
    $username = $_POST['new-username'];
    $email = $_POST['new-email'];
    $userpassword = $_POST['new-password'];
    $errors = array();
    
    $query = $db->prepare("SELECT id FROM users WHERE email = :email OR username = :username");
    $query->execute([':email' => $email, ':username' => $username]);
    if($query->fetch()) {
        $errors['global'] = "This email address or username is already taken.";
    }
    
    $uppercase = preg_match("/[A-Z]/", $userpassword);
    $lowercase = preg_match("/[a-z]/", $userpassword);
    $number = preg_match("/[0-9]/", $userpassword);
    
    
    if (!$uppercase || !$lowercase || !$number || strlen($userpassword) < 8) {
        $errors["password"] = "The password must contain a minimum of 8 characters, including one uppercase letter and one number.";
    }
    
    if(empty($errors)) {
        $userpasswordhash = password_hash($userpassword, PASSWORD_DEFAULT);
        
        $requete = $db->prepare("INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, NOW())");
        
       
        $requete->bindParam(':username', $username, PDO::PARAM_STR);
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':password', $userpasswordhash, PDO::PARAM_STR);
        
       $requete->execute();
       
        
        $_SESSION['flash'] = "Registration successful! You can now log in.";
        header('Location: login.php');
        exit();
    }
    
}

$template = 'templates/register.phtml';
include('templates/layout.phtml');

