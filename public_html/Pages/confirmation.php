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

$reservationID = isset($_REQUEST['reservation']) ? $_REQUEST['reservation'] : "";

//Check reservation ID
if ($reservationID == "") {
    header('location: ../Pages/error.php');
}

// fetching reservation
$userID = $_SESSION['token'];
$getReservation = "SELECT * from Reservations WHERE ID = $reservationID";
$reservationResult = $mySQL->query($getReservation);

$reservation = [];
foreach ($reservationResult as $value) {
    array_push($reservation, $value);
}

// fetching charger
$chargerID = $reservation[0]["chargerID"];
$getCharger = "SELECT * from Chargers WHERE ID = $chargerID LIMIT 1";
$chargerResult = $mySQL->query($getCharger);
$charger = [];
foreach ($chargerResult as $value) {
    array_push($charger, $value);
}

// fetching location
$locationID = $charger[0]["locationID"];
$getLocation = "SELECT * from Locations WHERE ID = $locationID";
$locationResult = $mySQL->query($getLocation);
$location = [];
foreach ($locationResult as $value) {
    array_push($location, $value);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="../Styles/main.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/29c8abed28.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<header><?php displayNav(); ?></header>

<body>
    <div class="container-profile">
        <div class="booking-box">
            <a href="../Pages/map.php"><button class="close-button">&times;</button></a>
            <img src="..\Assets\Img\Icons\checkmark.png" width="40px" height="40px" padding-bottom="20px" />
            <h2>You booked it!</h2>
            <img src="..\Assets\Img\Icons\qr-code.png" width="100px" height="100px" />
            <p class="bookingtext1">My vehicle</p>
            <p class="bookingtext2">123-452-12</p>
            <hr>

            <div class="time-booking">
                <div class="starttime">
                    <p class="item1">From</p>
                    <p class="item2"><?php echo substr($reservation[0]["start_time"], 10) ?></p>
                    <p class="item3"><?php echo substr($reservation[0]["start_time"], 0, 10) ?></p>
                </div>

                <div class="endtime">
                    <p class="item1">To</p>
                    <p class="item2"><?php echo substr($reservation[0]["end_time"], 10) ?></p>
                    <p class="item3"><?php echo substr($reservation[0]["end_time"], 0, 10) ?></p>
                </div>
            </div>

            <hr>
            <div class="addressbox">
                <div class="address-booking">
                    <p class="item4">Address</p>
                    <p class="item5"><?php echo $location[0]["location_address"] ?></p>
                    <p class="item5"><?php echo $location[0]["location_zip"] ?></p>
                </div>
                <div class="address-picture">
                    <img src="..\Assets\Img\Locations\CarlBlochsGade 28,8000ÅrhusSmall.png" width="80px" height="80px" />
                </div>
            </div>
            <button type="bookingbutton">Get directions</button>
            </a>
        </div>

</body>
</section>
<script src="../JS/validatePassword.js"></script>
<script src="../JS/uploadImage.js"></script>
<script src="../JS/sliderManager.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>