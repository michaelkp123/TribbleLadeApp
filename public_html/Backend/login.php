<?php
session_start();
ob_start();
include("../storage.php");

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

// User login
if ($action == 'login') {
    $email = isset($_REQUEST["user_email"]) ? $_REQUEST["user_email"] : "";
    $password = isset($_REQUEST["user_password"]) ? $_REQUEST["user_password"] : "";

    // Fetching credentials 
    $getCredentials = 'SELECT * from Credentials WHERE user_email = "' . $email . '"';
    $credentials = $mySQL->query($getCredentials)->fetch_assoc();

    // Verifying password
    if ($credentials != NULL) {
        if (password_verify($password, $credentials["user_password"])) {
            $userID = $credentials["userID"];
            $_SESSION["token"] = $mySQL->query('Select * from Users where ID = ' . $userID)->fetch_object()->ID;
            header('location:../Pages/map.php?user=' . $userID);
        } else {
            die("Error: the password is incorrect.");
        }
    } else {
        die("Error: there is no user registered on this email.");
    }
} else {
    header('location: ../Pages/error.php');
}
