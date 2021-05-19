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
  <div class="blur" id="blur" style="background-image: url('/images/MH3.jpg')">
    <button class="home" onclick="document.location='landinglogin.html'"></button>
    <button class="next" onclick="document.location='mainhall4.html'"></button>
    <button class="previous" onclick="document.location='mainhall2.html'"></button>
    <button class="btn-b1" onclick="toggle(1)"></button>
    <button class="btn-b2" onclick="toggle(2)"></button>
    <button class="btn-b3" onclick="toggle(3)"></button>
    <button class="btn-b4" onclick="toggle(4)"></button>
  </div>
  <div id="popup1">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/CSG.png">
    <div class="co-name">
      <h1><b>CSG Indonesia</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Jakarta,<br>
      Indonesia</h3>
      <h4>info@csgindonesia.com</h4>
      <a href="https://csgindonesia.com/"><h5>www.csgindonesia.com</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth9.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>Corporate Secretarial services can help guide you through the challenges
        and changes, easing your administrative burden and allowing you to
        focus on running your business. From basic to strategic compliances,
        administrative to advisory services. From raw data to annual reports and
        sustainability reports. General meetings or public exposes. As well
        preparing for IPO to any corporate actions.</p>
    </div>
  </div>
  <div id="popup2">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/SML.png">
    <div class="co-name">
      <h1><b>Smile Consulting Indonesia</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Jl. Tanjung Duren Timur 6 No. 2A,<br>
        RT 7/RW 3, Grogol Petamburan,<br>
        Jakarta Barat 11470</h3>
      <h4>Info@Smileconsultingindonesia.com</h4>
      <a href="https://smileconsultingindonesia.com/"><h5>www.smileconsultingindonesia.com</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth10.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>Smile Consulting Indonesia
        adalah Bisnis Unit dari PT.
        Mitra Solusi Jakarta. Berdiri sejak tahun 2013 -
        Saat ini. Pengembangan Psikotes
        Online dimulai pada tahun
        2017 - Saat ini</p>
    </div>
  </div>
  <div id="popup3">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/INTW.png">
    <div class="co-name">
      <h1><b>Intiwhiz International</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Intiland Tower M2 Floor<br>
        Jalan Jendral Sudirman 32<br>
        Jakarta 10220, Indonesia</h3>
      <h4>salesmarketing@intiwhiz.com</h4>
      <h5>www.intiwhiz.com</h5>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth11.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>As our identity and characteristics of our brand, we have 6 (six) core attributes as core values, brand attributes 
        that to be used represents the essence of our brand, Intiwhiz Hospitality Management. And also the core attributes 
        of Intiwhiz can be found at all of our hotels. Easy Access, Good Sleep, Good Shower, Info Connectivity, Stylish & Modern,
        and Friendly & Run</p>
    </div>
  </div>
  <div id="popup4">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/SAKA.png">
    <div class="co-name">
      <h1><b>Saka</b></h1>
      <h2>@Career Expo</h2>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth12.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>Saka merupakan sebuah startup yang mendirikan platform berbasis mobile apps untuk menjembatani acara komunitas, 
        swasta maupun pemerintah dengan para volunteer terutama dari kampus atau mahasiswa
      </p>
    </div>
  </div>
</body>
</html>