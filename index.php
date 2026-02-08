<?php
session_start();

if (isset($_SESSION['loggedIn'])) { 
    header('Location: account.php'); 
    exit(); 
    
}

$template = 'templates/index.phtml';
include 'templates/layout.phtml';