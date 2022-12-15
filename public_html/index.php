<?php
session_start();
if (isset($_SESSION['token']) && $_SESSION['token'] != null) {
  header("location: ./Pages/map.php");
}
?>

<!-- onboarding.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Onboarding</title>
  <link rel="stylesheet" href="../Styles/main.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active" id="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2" id="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3" id="3"></li>
      <a data-target="#carouselExampleIndicators" data-slide="prev" class="Prev" id="Prev" onclick="test(id)" hidden="hidden">PREV</a>
      <a data-target="#carouselExampleIndicators" data-slide="next" class="Next" id="Next" onclick="test(id)">NEXT</a>
    </ol>

    <form class=" MiddleBoard">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="boarding-img">
            <img class="boarding" src="../Assets/Img/Icons/map1-modified.png" alt="Logo">
          </div>
          <p class="OverText">Explore</p>
          <p class="UnderText">Find the best chargers in your city</p><br>
        </div>

        <div class="carousel-item">
          <div class="boarding-img">
            <img class="boarding" src="../Assets/Img/Icons/phone-modified.png" alt="Logo">
          </div>
          <p class="OverText">Book Charger</p>
          <p class="UnderText">Book chargers wherever you want</p><br>
        </div>

        <div class="carousel-item">
          <div class="boarding-img">
            <img class="boarding" src="../Assets/Img/Icons/car-modified.png" alt="Logo">
          </div>
          <p class="OverText">No queues</p>
          <p class="UnderText">Avoid waiting and use your time more effectivly</p><br>
          <input class="ButtonStart" type="button" value="SIGN UP" id="ButtonSubmit" onclick="window.location.href='../Pages/signup.php'"><br>
        </div>
      </div>
    </form>
  </div>

  <script src="../JS/validatePassword.js"></script>
  <script src="../JS/uploadImage.js"></script>
  <script src="../JS/sliderManager.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>