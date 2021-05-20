<?php
require_once "db.php";
if (!$user->isLogged()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
}
$currentUser = $user->getProfile();

if (isset($_POST['changerole'])) {
  $user->changeRole();
  $currentUser = $user->getProfile();
}

if (isset($_POST['bookmark']) && isset($_POST['loker'])) {
  $user->bookmark($_SESSION['userid'], $_POST['loker']);
}

if (isset($_POST['remove']) && isset($_POST['loker'])) {
  $user->removeBookmark($_SESSION['userid'], $_POST['loker']);
}

$data = $user->getloker($_SESSION['userid']);
$error = $user->getError();
$bookmark = $user->getBookmark($_SESSION['userid']);

?>

<!DOCTYPE html>

<head>
  <title>Main Hall</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/landing.css" rel="stylesheet" type="text/css">
  <script defer src="js/script.js"></script>
</head>

<body>
  <div class="blur" id="blur" style="background-image: url('images/MH5.jpg')">
    <button class="home" onclick="document.location='landinglogin.php'"></button>
    <button class="next"></button>
    <button class="previous" onclick="document.location='mainhall2.php'"></button>
    <button class="btn-b1" onclick="toggle(1)"></button>
    <button class="btn-b2" onclick="toggle(2)"></button>
    <button class="btn-b3" onclick="toggle(3)"></button>
    <button class="btn-b4" onclick="toggle(4)"></button>
  </div>
  <div id="popup1">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/IAMB.png">
    <div class="co-name">
      <h1><b>I AM Beauty</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>
        Intiland Tower<br>
        2nd Floor, Jl. Jenderal Sudirman 32 <br>
        Jakarta 10220, Indonesia</h3>
      <h4>investoranakmuda@gmail.com</h4>
      <a href="https://iamcommunity.co.id/">
        <h5>www.iamcommunity.co.id</h5>
      </a>
    </div>
    <div class="biodata">
      <p>O U R &nbsp;P R O D U C T</p>
    </div>
    <div class="inlineform-buttons">
      <button class="btnspecial" id="special" onclick="puggle()"></button>
      <div class="photo_wrap">
        <img class="iambeauty_img" src="images/IAMB1.jpeg">
        <img class="iambeauty_img" src="images/IAMB2.jpeg">
        <img class="iambeauty_img" src="images/IAMB3.jpeg">
        <img class="iambeauty_img" src="images/IAMB4.jpeg">
        <img class="iambeauty_img" src="images/IAMB5.jpeg">
        <img class="iambeauty_img" src="images/IAMB6.jpeg">
      </div>
    </div>
  </div>
</body>

</html>