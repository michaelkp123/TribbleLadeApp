<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="../Styles/main.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body>
  <div class="TopBoard">
    <img class="logo" src="../Assets/Svg/LogoTribble.svg" alt="Logo">
    <p class="OverText">Welcome back</p>
    <p class="UnderText">It’s good to see yo!</p><br>
  </div>

  <form class="MiddleBoard" action="../Backend/login.php?action=login" method="post">
    <input type="text" name="user_email" placeholder="Email" required>
    <input type="password" name="user_password" placeholder="Password" id="password" required><br>
    <input class="ButtonSignup" type="submit" value="LOGIN">
    <a href="../Pages/signup.php" class="ButtonLogin"> SIGN UP</a>
  </form>
</body>

</html>