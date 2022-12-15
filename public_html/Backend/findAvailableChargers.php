<?php

/* Checks current availability for all chargers on a location */
function findAvailableNow($locationID)
{
    include("../storage.php");
    $currentTime = date('Y-m-d H:i:s');

    // fetch chargers
    $getChargers = "SELECT * from Chargers WHERE locationID = $locationID";
    $chargersResult = $mySQL->query($getChargers);
    $chargers = [];
    foreach ($chargersResult as $value) {
        array_push($chargers, $value);
    }

    // mark current availability
    for ($i = 0; $i < count($chargers); $i++) {
        if (isAvailable($chargers[$i]["ID"], $currentTime)) {
            $chargers[$i]["isAvailable"] = true;
        } else {
            $chargers[$i]["isAvailable"] = false;
        }
    }

    return $chargers;
}

/* Checks whether charger is available on a given time */
function isAvailable($chargerID, $dateTime)
{
    include("../storage.php");
    $available = true;

    // fetch reservations
    $getReservations = "SELECT * from Reservations WHERE chargerID = $chargerID";
    $reservationResult = $mySQL->query($getReservations);

    foreach ($reservationResult as $value) {
        if (($dateTime >= $value["start_time"]) && ($dateTime < $value["end_time"])) {
            $available = false;
        }
    }

    return $available;
}

/* Calculates all available time ranges for a charger from a given date */
function findAvailableTimes($chargerID, $bookingdate)
{
    include("../storage.php");

    // time values for display
    $displayTimes = [
        '00:00', '00:30', '01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:30', '05:30', '06:30', '07:00',
        '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00',
        '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00',
        '19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00', '23:30'
    ];

    // calculate availability & time ranges and display as options in front end
    $options = "";
    for ($i = 0; $i < count($displayTimes); $i++) {
        $currentDate = substr($bookingdate, 0, 10);
        $currentDatetime = $currentDate . ' ' . $displayTimes[$i] . ':00';
        $currentTimeRange = 21600;
        $formatted = date_create(str_replace('/', '-', $currentDatetime));
        $currentDatetime = date_format($formatted, "Y-m-d H:i:s");

        // fetch reservations 
        $getReservations = 'SELECT * from Reservations WHERE chargerID = ' . $chargerID . ' AND start_time > "' . $currentDatetime . '" ORDER BY start_time asc LIMIT 1';
        $reservationResult = $mySQL->query($getReservations)->fetch_assoc();

        // set the max time range for given reservation
        if ($reservationResult != null) {
            $startTime = substr($currentDatetime, 0, 16);
            $endTime = substr($reservationResult["start_time"], 0, 16);
            $currentTimeRange = strtotime($endTime) - strtotime($startTime);
            $currentTimeRange = $currentTimeRange / 3600;
        }
        if ($currentTimeRange > 6) { // max 6 hours
            $currentTimeRange = 6;
        }
        if ($currentTimeRange < 0) { // negative values not allowed
            $currentTimeRange = 0;
        }

        if (isAvailable($chargerID, $currentDatetime)) {
            $options = $options . '<option onclick="setTimeRange(' . $currentTimeRange . ')" ' . ' value="' . $currentDatetime . '" >' . $displayTimes[$i] . '</option>';
        } else {
            $options = $options . '<option style="color:red" disabled>' . $displayTimes[$i] . '</option>';
        }
    }
    return $options;
}

/* Show "prev"-button */
function clickNext()
{
    echo '<script>document.getElementById("prev").hidden = false;</script>';
}
