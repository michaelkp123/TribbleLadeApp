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

$locationID = isset($_REQUEST['locationID']) ? $_REQUEST['locationID'] : "";

if ($locationID != '""' && $locationID != null) {

    // fetching location
    $getLocation = "SELECT * from Locations WHERE ID = $locationID";
    $location = $mySQL->query($getLocation)->fetch_assoc();

    // find chargers for location and mark availability
    $chargers = findAvailableNow($locationID);
} else {
    header('location: ../Pages/error.php');
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

<body>

    <header><?php displayNav(); ?></header>

    <!-- Bootstrap Carousel 
    https://getbootstrap.com/docs/4.0/components/carousel/
    -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" disabled data-bs-slide-to="0" class="test active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" disabled data-bs-slide-to="1" class="test" aria-label="Slide 2" id="slide2"></button>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" id="prev" onclick="prev()" hidden>PREV</button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" id="next" onclick="next()" disabled>NEXT</button>
        </div>

        <form class="MiddleBoard" action="../Backend/book.php?action=selectTime" method="post" enctype="multipart/form-data">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="TopBoard">
                        <p class="OverText" style="margin-top: 13vh; margin-bottom: 8vh;">Choose Charger Type</p>
                    </div>

                    <!-- Choose Charger Type -->
                    <?php
                    foreach ($chargers as $value) {
                        $i = 0;
                        $image = "charger_CCS";

                        // Mark availability
                        if ($value["isAvailable"] === true) {
                            $available = 1;
                            $color = "green";
                        } else {
                            $available = 0;
                            $color = "red";
                        }

                        //fetch image
                        if ($value["charging_type"] == 'CHAdeMO (50kW)') {
                            $image = "charger_Chademo";
                        } else if (substr($value["charging_type"], 0, 6) == 'Type 2') {
                            $image = "charger_Type2";
                        }

                        echo '
                    <div class="Type">
                        <img src="../Assets/Svg/' . $image . '.svg" alt="AC" width="85px" style="margin-top: 2vh; margin-bottom: 2vh;">
                        <div>
                            <p class="TypeHeader">' . $value["charging_type"] . '</p>
                            <p class="TypeSecond" style="color:' . $color . '">' . $available . ' available</p>
                        </div>
                        <input type="radio" name="ChargerID" class="Radio" value="' . $value["ID"] . '" onclick="typechosen(' . $value["ID"] . ')"> <br>
                    </div>';
                        $i++;
                    }
                    ?>
                </div>

                <!-- Datepicker
                https://bootstrap-datepicker.readthedocs.io/en/latest/
                -->
                <?php echo '
                <div class="carousel-item" data-interval="false">
                    <div class="TopBoard">
                        <p class="OverText" style="margin-top: 13vh; margin-bottom: 8vh;">Schedule Appointment</p>
                    </div>

                    <div class="col-md-8">
                        <div id="datetimepicker" style="margin-bottom: 10vh;">
                            <input type="hidden" id="my_hidden_input" name="date">
                        </div>
                    </div>';
                ?>
                <input id="schedule" class="ButtonSignup" type="submit" value="choose time">
            </div>
        </form>
    </div>

    <script src="../JS/datapicker.js"></script>
    <script src="../JS/sliderManager.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>