<?php
session_start();
ob_start();
include("../storage.php");
require("../Backend/navigation.php");

// fetching user token
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

// fetching location
$sql = "SELECT location_name, longitude, latitude, location_address, location_zip, location_image
FROM Locations";
$result = $mySQL->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <link rel="stylesheet" href="../Styles/main.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<header><?php displayNav(); ?></header>

<!-- Map 
Map from googles API: https://developers.google.com/maps/documentation/javascript/overview
-->

<body>
    <!-- Map div to display map -->
    <div class="map" id="map" style="width:100%;height:100vh;"></div>

    <script>
        var map;
        var geocoder;
        //Fetching marker data from location table
        var locations = [
            <?php while ($row = $result->fetch_assoc()) { ?>['<?php echo addslashes($row["location_name"]); ?>', '<?php echo addslashes($row["location_address"]); ?>', <?php echo addslashes($row["location_zip"]); ?>, '<?php echo addslashes($row["location_image"]); ?>', <?php echo $row["longitude"]; ?>, <?php echo $row["latitude"]; ?>],

            <?php } ?>
        ];
        //Amount of zoom in on map
        var zoom = 5;

        function initMap() {
            //Svg for ladestander
            var image = new google.maps.MarkerImage("../Assets/Svg/ladestander.svg", null, null, null, new google.maps.Size(50, 50));
            //Svg for own location
            var OwnLocation = new google.maps.MarkerImage("../Assets/Svg/Own_Loca.svg", null, null, null, new google.maps.Size(60, 60));
            var infowindow = new google.maps.InfoWindow();

            if (window.matchMedia("(max-width: 768px)").matches) {
                zoom = 13;
            }
            //Get the users location
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    initMap(position.coords.latitude, position.coords.longitude)

                    function initMap(lat, lng) {
                        var myLatLng = {
                            lat,
                            lng
                        };

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            icon: OwnLocation,
                        });
                    }
                },
                function errorCallback(error) {
                    console.log(error)
                }
            );
            //Set map to display Århus every time
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 56.163940293808324,
                    lng: 10.210468723219334
                },
                zoom: 13,
                mapId: '730b1c4b70ea24a2',
                mapTypeControl: false,
                fullscreenControl: false,
                streetviewControl: false
            });

            geocoder = new google.maps.Geocoder();

            for (i = 0; i < locations.length; i++) {
                codeAddress(geocoder, map, locations[i]);
            }
            //Calling the Infowindow from google api
            var infowindow = new google.maps.InfoWindow();
            //Placing markers from the data from the database
            function codeAddress(geocoder, map, address) {

                var myLatLng = {
                    lat: address[4],
                    lng: address[5]
                };

                var marker = new google.maps.Marker({
                    map: map,
                    position: myLatLng,
                    icon: image,
                    name: address[0],
                    address: address[1],
                    zip: address[2],
                    image: address[3],
                    animation: google.maps.Animation.DROP
                });
                //adding eventlistener on marker that opens infowindow with data from database
                marker.addListener('click', function() {
                    infowindow.setContent('<div class="location-card-inner-content"><header class="location-card-header"><h3 class="heading">' +
                        marker.name +
                        '</h3></header><div class="location-card-stander"><p>' +
                        marker.address + ' ' + marker.zip +
                        ' </p></div><div class="address-content"><p></p></div><div class="image-wrapper"><img src="../Assets/Img/Locations/' +
                        marker.image +
                        '.png" alt="Place" width="200" height="100"></img></div><a href="../Backend/findLocation.php?position=' + marker.position + '" class="button">Book Ladestander</a> </div>');
                });
                var activeInfoWindow;
                //Closeing infowindow when click on another one
                marker.addListener("click", function() {
                    if (activeInfoWindow) {
                        activeInfoWindow.close();
                    }
                    infowindow.open(map, marker);
                    activeInfoWindow = infowindow;
                });

            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxwAkZ4eAS755P2G6JXlhmC_WEgctDMOM&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>