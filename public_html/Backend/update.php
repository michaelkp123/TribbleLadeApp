<?php
session_start();
include("../storage.php");
require __DIR__ . './upload_image.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

// Update user in the database
if ($action == 'updateUser') {
        $userID =           $_SESSION["token"];
        $email =            $_REQUEST['Email'];
        $login_password =   password_hash($_REQUEST['Password'], PASSWORD_DEFAULT); //password encryption
        $password_lengt =   strlen($_REQUEST['Password']);
        $fullname =         $_REQUEST['Fullname'];
        $address =          $_REQUEST['Address'];
        $zip =              $_REQUEST['Zipcode'];
        $payment_type =     'manual'; //Default value (optionally changed on profile page)

        // fetching image
        $getUser = "SELECT user_image from Users WHERE ID = $userID";
        $image = ($mySQL->query($getUser)->fetch_assoc())["user_image"];

        // rename files for specific user
        if ($_FILES["Imagefile"]["name"] !== '') {
                $image = $userID . $_FILES["Imagefile"]["name"];

                //Upload image to website
                move_uploaded_file($_FILES["Imagefile"]["tmp_name"], ("../Assets/Img/Profiles/" . $image));
        }

        //Creating new user in the database from the form input
        $addNewUserQuery = $mySQL->query("CALL UpdateUser($userID, '$email', '$login_password', '$password_lengt', '$fullname', '$address', '$zip', '$image', '$payment_type')");

        //Redirect to map
        header('location: ../Pages/profile.php?user=' . $_SESSION["token"]);
} else {
        header('location: ../Pages/error.php');
}
