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

$userID = $_SESSION['token'];

// fetching user
$getUser = "SELECT * from Users WHERE ID = $userID";
$user = $mySQL->query($getUser)->fetch_assoc();
$image = $user["user_image"];

// fetching credentials
$getCredentials = "SELECT user_email, user_password, user_password_lenght from Credentials WHERE ID = $userID";
$credentials = $mySQL->query($getCredentials)->fetch_assoc();

//anonymous password
$anonPassword = "";
for ($i = 0; $i < $credentials["user_password_lenght"]; $i++) {
    $anonPassword = $anonPassword . "*";
}
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
    <link rel="stylesheet" href="../Styles/main.css">
    <script src="https://kit.fontawesome.com/29c8abed28.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<header>
    <?php displayNav(); ?>
</header>

<body>
    <div class="container-profile">
        <div class="profile-box-edit">
            <?php echo '<img src="../Assets/Img/Profiles/' . $image . '" class="profile-pic" id="Imagesource">' ?>
            <form action="../Backend/update.php?action=updateUser" method="post" enctype="multipart/form-data">
                <?php echo '<input type="file" name="Imagefile" id="Imagefile" >'; ?></br></br>
                <p class="ProfilePictureText" id="Error"></p></br>

                <div class="input-boxes"><i class="fa-solid fa-user"></i>
                    <?php echo '<input type="Fullname" name="Fullname" value="' . $user["full_name"] . '"><br>'; ?>
                </div>

                <div class="input-boxes">
                    <i class="fa-solid fa-road"></i>
                    <?php echo '<input type="Street" name="Address" value="' . $user["user_address"] . '"><br>'; ?>
                </div>
                <div class="input-boxes">
                    <i class="fa-solid fa-house"></i>
                    <?php echo '<input type="Postcode" name="Zipcode" value="' . $user["zip"] . '" c><br>'; ?>
                </div>

                <div class="input-boxes">
                    <i class="fa-solid fa-envelope"></i>
                    <?php echo '<input type="email" name="Email" value="' . $credentials["user_email"] . '"><br>'; ?>
                </div>
                <div class="input-boxes">
                    <i class="fa-solid fa-lock"></i>
                    <?php echo '<input type="password" name="Password" value="' . $anonPassword . '" id="password"><br>'; ?>
                </div>

                <button class="Button-edit-profile" type="submit" id="ButtonSubmit">Save changes</button>
            </form>
        </div>

        <script src="../JS/uploadImage.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>