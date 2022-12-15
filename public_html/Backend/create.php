<?php
session_start();
ob_start();
include '../storage.php';
require './upload_image.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

// Create user in database
if ($action == 'createUser') {
    $email =            $_REQUEST['Email'];
    $login_password =   password_hash($_REQUEST['Password'], PASSWORD_DEFAULT); //password encryption
    $fullname =         $_REQUEST['Fullname'];
    $address =          $_REQUEST['Address'];
    $zip =              $_REQUEST['Zipcode'];
    $payment_type =     'manual'; //Default value (optionally changed on profile page)
    $password_lengt =   strlen($_REQUEST['Password']);
    $image =            '!default_profile.png';

    if ($_FILES["Imagefile"]["name"] !== '') {

        //makes image unique for each user
        $image = mt_rand(1000000000, 9999999999) . $_FILES["Imagefile"]["name"];

        //Upload image to website
        move_uploaded_file($_FILES["Imagefile"]["tmp_name"], ("../Assets/Img/Profiles/" . $image));
    }

    //Creating new user in the database from the form input
    $addNewUserQuery = $mySQL->query("CALL CreateUser('$email', '$login_password', '$password_lengt', '$fullname', '$address', '$zip', '$image', '$payment_type')");

    //Selects the users ID as session token
    $_SESSION["token"] = $mySQL->query("Select ID from Users order by ID DESC LIMIT 1")->fetch_object()->ID;

    //Redirect to map
    header("location:../Pages/map.php?user=". $_SESSION["token"]);
} else {
    header("location:../Pages/error.php");
}
?>