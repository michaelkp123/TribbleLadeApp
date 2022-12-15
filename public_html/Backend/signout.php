<?php
session_start();
ob_start();
include("../storage.php");
require ('./upload_image.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

// User log out
if ($action == 'signOut') {
    $_SESSION["token"] = null;
    header('location: ../Pages/login.php');
} else {
    header('location: ../Pages/login.php');
}
