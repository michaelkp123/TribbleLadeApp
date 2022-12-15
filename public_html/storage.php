<?php
$server = "mysql98.unoeuro.com";
$username = "frederikemilolsen_dk";
$password = "DwAxe2p3nbBdg69RtGym";
$database = "frederikemilolsen_dk_db_tribble";
$mySQL = new mysqli($server, $username, $password, $database);

// Check connection
if (!$mySQL) {
    die("Could not connect to the MySQL server: " . mysqli_connect_error());
}
?>