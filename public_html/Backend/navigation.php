<?php
function displayNav()
{
    include("../storage.php");

    // fetching user
    $userID = $_SESSION['token'];
    $getUser = "SELECT * from Users WHERE ID = $userID";
    $user = $mySQL->query($getUser)->fetch_assoc();
    $firstname = $user["full_name"];

    if (str_contains($firstname, ' ')) {
        $firstname = strtok($firstname, ' ');
    }

    // Display navn bar
    echo '
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../Pages/map.php"><img src="../Assets/Svg/LogoTribble.svg" alt="Logo" width="140px" height="40px"></a>
            <a class="navbar-brand" href="../Pages/error.php"><img src="../Assets/Svg/phone.svg" alt="Logo" width="20px"></a>
            <div class="collapse navbar-collapse bg-green px-3" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <button class="cross" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <img src="../Assets/Svg/cross.svg" alt="cross" width="30px">
                    </button>
                    <p class="menuh1">Hello ' . $firstname . '</p>
                    <p class="menu">Good to see you!</p>

                    <li class="nav-item active">
                        <a class="nav-link" href="../Pages/map.php">Map</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../Pages/profile.php">My profile</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../Pages/myreservation.php">Reservations</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../Backend/signout.php?action=signOut">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';
}
