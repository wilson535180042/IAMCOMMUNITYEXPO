<?php
require_once "db.php";
if (!$user->isLogged()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
} ?>
<!DOCTYPE html>

<head>
  <title>Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/afterlog.css" rel="stylesheet" type="text/css">
  <script defer src="js/afterlog.js"></script>
</head>

<body>
  <div class="blur"></div>
  <div class="popup">
    <img class="img1" src="images/POP1.png">
    <img class="img2" src="images/UP1.png">
    <img class="img3" src="images/LOGO.png">
    <div class="co-name">
      <h1><b>Welcome to Career Expo</b></h1>
      <h2>by I AM Community</h2>
      <div class="slideshow-container">
        <div class="mySlides fade">
          <div class="numbertext">1 / 4</div>
          <div class="text">Hello, welcome to Career Expo by I AM Community!
            we will guide you through some basics</div>
        </div>
        <div class="mySlides fade">
          <div class="numbertext">2 / 4</div>
          <div class="text">You can access your personal <b>Account Dashboard</b> through clicking
            <b>Account Button</b>.
          </div>
        </div>
        <div class="mySlides fade">
          <div class="numbertext">3 / 4</div>
          <div class="text">In your account information, you can see what
            companies you're interested in and contact them
            via zoom.</div>
        </div>
        <div class="mySlides fade">
          <div class="numbertext">4 / 4</div>
          <div class="texts">Click here to start your career journey with us!</div>
          <a href="landinglogin.php"><button type="submit" class="boton tonbo">T A K E &nbsp;M E &nbsp;T H E R E !</button></a>
        </div>
      </div>
      <br>
      <div style="text-align:center" class="dots">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
      </div>
    </div>
  </div>
</body>

</html>