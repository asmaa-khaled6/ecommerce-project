<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Check if user is Admin
function isAdmin()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


// Check if user is User
function isUser()
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}


// Allow Admin only
function adminOnly()
{
    if (!isAdmin()) {
        header("Location: /nti/FinalProject/ecommerce-project/index.php");
        exit;
    }
}

?>