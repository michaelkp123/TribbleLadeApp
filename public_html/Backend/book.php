<?php
session_start();
include("../storage.php");

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

//Select time duration
if ($action == 'selectTime') {
    if (isset($_REQUEST['ChargerID']) && isset($_REQUEST['date'])) {
        header('location: ../Pages/selectTime.php?charger=' . $_REQUEST['ChargerID'] . '&date=' . $_REQUEST['date']);
    } else {
        header('location: ../Pages/error.php');
    }
}

//Book charger
else if ($action == 'bookCharger') {

    $charger = isset($_REQUEST['charger']) ? $_REQUEST['charger'] : "";

    if ($charger != "") {
        if (isset($_REQUEST['Duration']) && isset($_SESSION["token"])) {
            $chargerID =        $charger;
            $userID =           $_SESSION["token"];
            $start_time =       $_REQUEST['Time'];
            $duration =         $_REQUEST['Duration'];

            //format date to match SQL database
            $formatted = date_create(str_replace('/', '-', $start_time));
            $start_time = date_format($formatted, "Y-m-d H:i:s");

            //Creating new user in the database from the form input
            $createReservationQuery = $mySQL->query("CALL CreateReservation('$chargerID', '$userID', '$start_time', '$duration')");

            //Selects the users ID as session token
            $reservationID = $mySQL->query("Select ID from Reservations order by ID DESC LIMIT 1")->fetch_object()->ID;

            if ($reservationID != null) {
                //Redirect to map
                header('location: ../Pages/confirmation.php?reservation=' . $reservationID);
            } else {
                header('location: ../Pages/error.php');
            }
        } else {
            header('location: ../Pages/error.php');
        }
    }
} else {
    header('location: ../Pages/error.php');
}
