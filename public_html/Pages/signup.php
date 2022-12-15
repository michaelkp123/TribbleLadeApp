<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="../Styles/main.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div class="TopBoard">
    <img class="logo" src="../Assets/Svg/LogoTribble.svg" alt="Logo">
    <p class="OverText">Welcome Onboard</p>
    <p class="UnderText">Let’s help you meet up your tasks</p><br>
  </div>

  <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active" id="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2" id="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3" id="3"></li>
      <a data-target="#carouselExampleIndicators" data-slide="prev" class="Prev" id="Prev" onclick="signupManager(id)" hidden="hidden">PREV</a>
      <a data-target="#carouselExampleIndicators" data-slide="next" class="Next" id="Next" onclick="signupManager(id)">NEXT</a>
    </ol>

    <form class=" MiddleBoard" action="../Backend/create.php?action=createUser" method="post" enctype="multipart/form-data">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <input type="email" name="Email" placeholder="Email" required><br>
          <input type="password" name="Password" placeholder="Password" id="password" required><br>
          <input type="password" name="ConfirmPassword" placeholder="Repeat Password" id="confirm_password" required><br>
        </div>

        <div class="carousel-item">
          <input type="text" name="Fullname" placeholder="Full name" required><br>
          <input type="text" name="Address" placeholder="Address" required><br>
          <input type="number" name="Zipcode" placeholder="Zipcode" required><br>
        </div>

        <div class="carousel-item">
          <img src="../Assets/Img/Profiles/!default_profile.png" class="profile-pic" id="Imagesource"></br>
          <input type="file" name="Imagefile" id="Imagefile"><br>
          <p class="ProfilePictureText">Upload a picture (JPG or PNG)</p>
          <p class="ProfilePictureText" id="Error"></p></br>
          <input class="ButtonSignup" type="submit" value="SIGN UP" id="ButtonSubmit"><br>
        </div>
      </div>
    </form>
  </div>

  <div class="smallLow">
    <p class="SmalltextLow">Already have an account?</p><a href="../Pages/login.php" class="SmallbuttonLow">LOG IN</a>
  </div>

  <script src="../JS/validatePassword.js"></script>
  <script src="../JS/uploadImage.js"></script>
  <script src="../JS/sliderManager.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>