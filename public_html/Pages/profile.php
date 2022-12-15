<?php
session_start();
include("../storage.php");
require("../Backend/navigation.php");

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = '0';
}
if ($_SESSION['token'] == 0) {
    header("location: ../pages/login.php");
}

// fetching user
$userID = $_SESSION['token'];
$getUser = "SELECT * from Users WHERE ID = $userID";
$user = $mySQL->query($getUser)->fetch_assoc();
$firstname = $user["full_name"];
$image = $user["user_image"];

if (str_contains($firstname, ' ')) {
    $firstname = strtok($firstname, ' ');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../Styles/main.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/29c8abed28.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<header><?php displayNav(); ?></header>

<body>
    <div class="container-profile">
        <div class="profile-box">
            <?php echo '<img src="../Assets/Img/Profiles/' . $image . '" class="profile-pic">' ?>

            <p class="Name"><?php echo $user["full_name"] ?></p>

            <a href="./editprofile.php" class="sub-menu-link">
                <i class="fa-solid fa-user"></i>
                <p>Edit profile</p>

            </a>
            <a href="../Pages/error.php" class="sub-menu-link">
                <i class="fa-solid fa-circle-info"></i>
                <p>Help & support</p>

            </a>
            <a href="../Pages/error.php" class="sub-menu-link">
                <i class="fa-solid fa-car"></i>
                <p>My vehicle</p>
            </a>

            <a href="../Backend/signout.php" class="sub-menu-link-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>Log out</p>
            </a>
        </div>

        <script src="../myscripts.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxwAkZ4eAS755P2G6JXlhmC_WEgctDMOM&callback=initMap"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>