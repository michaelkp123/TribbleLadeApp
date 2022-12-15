<?php
session_start();
include("../storage.php");

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
$reservationID = isset($_REQUEST['reservation']) ? $_REQUEST['reservation'] : "";

//Cancel the selected reservation
if ($action == 'cancel') {
    if ($reservationID != null && $reservationID != "") {
        $deleteReservation = "DELETE FROM Reservations WHERE ID = $reservationID";
        $reservationResult = $mySQL->query($deleteReservation);
        header('location: ../Pages/myreservation.php');
    } else {
        header('location: ../Pages/error.php');
    }
} else {
    header('location: ../Pages/error.php');
}
