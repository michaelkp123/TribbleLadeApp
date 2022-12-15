<?php
session_start();
include("../storage.php");
require("../Backend/navigation.php");
require '../Backend/findAvailableChargers.php';

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = '0';
}
if ($_SESSION['token'] == 0) {
    header("location: ../pages/login.php");
}

$charger = isset($_REQUEST['charger']) ? $_REQUEST['charger'] : "";
$date = isset($_REQUEST['date']) ? $_REQUEST['date'] : "";

if ($charger === '""' || $date === '""') {
    header('location: ../Pages/map.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book charger</title>
    <link rel="stylesheet" href="../Styles/main.css">
    <link rel="stylesheet" href="../Styles/datapicker.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
</head>

<header><?php displayNav(); ?></header>

<body>

    <?php
    echo '<div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="false">
        <form class="MiddleBoard" action="../Backend/book.php?action=bookCharger&charger=' . $charger . '" method="post" enctype="multipart/form-data">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="TopBoard">
                        <p class="OverText" style="margin-top: 13vh; margin-bottom: 8vh;">Choose time</p>
                    </div>';
    ?>

    <!-- Choose time -->
    <?php
    $options = findAvailableTimes($charger, $date);
    echo '<select name="Time" class="form-select" multiple aria-label="multiple select example">' . $options . '</select>';
    ?>
    <?php
    echo
    '<script>
                        //sets the max time range for the slider in reference to the next reservation
                        function setTimeRange(maxRange) {
                        document.getElementById("formControlRange").disabled = false;
                        document.getElementById("formControlRange").setAttribute("max", 0);
                        document.getElementById("formControlRange").setAttribute("min", 0);
                        document.getElementById("rangeval").disabled = false;
                        document.getElementById("rangeval").setAttribute("value", 0);
                        document.getElementById("rangeval").textContent = 0;
                        document.getElementById("formControlRange").setAttribute("max", maxRange);
                        document.getElementById("schedule").disabled = false;
                        document.getElementById("schedule").style.opacity = 100;
                        }
                    </script>'
    ?>

    <!-- Choose needed amount of time -->
    <p class="rangeText" style="margin-top: 4vh; margin-bottom: 2vh;">How long?</p>
    <div class="container" style="margin-bottom: 5vh;">
        <form>
            <div class="form-group">
                <input name="Duration" step='.5' type="range" min="0" max="0" class="form-control-range" id="formControlRange" onInput="$('#rangeval').html($(this).val())" disabled> <br>
                <span style="font-size: 15px;" id="rangeval" disabled>
                    <!-- Default value -->
                </span> <span style="font-size: 15px;"> hours</span>
            </div>
        </form>
    </div>

    <input id="schedule" class="ButtonSignup" type="submit" value="SCHEDULE" style="opacity:50%" disabled><br>

    <script src="../JS/datapicker.js"></script>
    <script src="../JS/sliderManager.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>