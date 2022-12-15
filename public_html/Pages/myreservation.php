<?php
session_start();
ob_start();
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

// fetching reservation
$userID = $_SESSION['token'];
$getReservation = "SELECT * from Reservations WHERE userID = $userID";
$reservationResult = $mySQL->query($getReservation);

$reservation = [];
foreach ($reservationResult as $value) {
    array_push($reservation, $value);
}

echo '<div class="container"></div>';

// Displays all reservations for the selected user
for ($i = 0; $i < count($reservation); $i++) {
    $getChargers = 'SELECT * from Chargers WHERE ID = ' . $reservation[$i]["chargerID"];
    $chargerResult = $mySQL->query($getChargers)->fetch_assoc();

    $getLocation = 'SELECT * from Locations WHERE ID = ' . $chargerResult["locationID"];
    $locationResult = $mySQL->query($getLocation)->fetch_assoc();;

    echo  '<div class="blur" id="blur">
    <ul class="cards">
            <li><img src="../Assets/Img/Locations/'.$locationResult["location_image"] .'.png" width="100%" />
                <div class="details">
                    <span>
                        <p class="card-title"> ' .  $locationResult["location_name"] . '</p>
                    </span>
                    <span style="text-overflow: ellipsis;max-width: 200px;white-space: nowrap;overflow: hidden;"><img class="png" src="../Assets/Img/Icons/location.png" alt="Logo" width="40px" height="40px"> ' .  $locationResult["location_address"] . ' </span>
                    <span><img class="png" src="../Assets/Img/Icons/electrical.png" alt="Logo" width="40px" height="40px"> ' .  $chargerResult["charging_type"] . ' </span>
                    <button onclick="myFunction' .  $i + 1 . '()" class="btn">Details</button>
                </div>
            </li>
        </ul>
        </div>
    <script>
    function myFunction' . $i + 1 . '() {
        var a = document.querySelector("#popup' . $i + 1 . '");
        a.classList.add("active");
        var i = document.getElementById("blur");
        i.style.filter = "blur(8px)";
    }

    function myClose' . $i + 1 . ' () {
        var a = document.querySelector("#popup' . $i + 1 . '");
        a.classList.remove("active");
        var i = document.getElementById("blur");
        i.style.filter = "";
    }
    </script>
    ';

    echo '<div class="popup" id="popup' . $i + 1 . '" style="display: none;">
            <div class="popup-header">
                <button onclick="myClose' . $i + 1 . '()" class="close-button">&times;</button>
                <div class="title-popup">' .  $locationResult["location_name"] . '</div>
                <div class="body-popup">
                    <span><img class="png" src="../Assets/Img/Icons/location.png" alt="Logo">
                        <div class="text">
                            <h2>Addresse</h2>
                            <p> ' .  $locationResult["location_address"] . '</p>
                        </div>
                    </span> <br>
    
                    <span><img class="png" src="../Assets/Svg/charger_Chademo.svg" alt="Logo">
                        <div class="text">
                            <h2>Chargertype</h2>
                            <p>' .  $chargerResult["charging_type"] . '</p>
                        </div>
                    </span> <br>
                    <div class="time">
                        <span><img class="png" src="../Assets/Svg/clock.svg" alt="Logo">
                            <div class="text">
                                <h2>Starttime</h2>
                                <p>' .  $reservation[$i]["start_time"] . '</p>
                            </div>
    
                        </span>
                        <span><img class="png" src="../Assets/Svg/clock.svg" alt="Logo">
                            <div class="text">
                                <h2>Endtime</h2>
                                <p>' .  $reservation[$i]["end_time"] . '</p>
                            </div>
                        </span>
                    </div>
                </div>
                <img src="../Assets/Img/Locations/'.$locationResult["location_image"] .'.png" width="100%" />
                <a href="../Backend/cancel.php?action=cancel&reservation=' . $reservation[$i]["ID"] . '"><button type="cancelbutton">Cancel Reservation</button></a>
            </div>
        </div>
 ';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My reservations</title>
    <link rel="stylesheet" href="../Styles/main.css">
    <link rel="stylesheet" href="../Styles/Popup.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/29c8abed28.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <header>
        <?php displayNav(); ?>
    </header>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxwAkZ4eAS755P2G6JXlhmC_WEgctDMOM&callback=initMap"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>