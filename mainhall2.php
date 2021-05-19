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
  <div class="blur" id="blur" style="background-image: url('/images/MH2.jpg')">
    <button class="home" onclick="document.location='landinglogin.html'"></button>
    <button class="next" onclick="document.location='mainhall3.html'"></button>
    <button class="previous" onclick="document.location='mainhall.html'"></button>
    <button class="btn-b1" onclick="toggle(1)"></button>
    <button class="btn-b2" onclick="toggle(2)"></button>
    <button class="btn-b3" onclick="toggle(3)"></button>
    <button class="btn-b4" onclick="toggle(4)"></button>
  </div>
  <div id="popup1">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/EUSH.png">
    <div class="co-name">
      <h1><b>Cushman & Wakefield</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Indonesia Stock Exchange Building Tower II<br>
        Lt. 16/F, Jl. Jend. sudirman kav 52-53<br>
        South Jakarta City, Jakarta 12190</h3>
      <h4>-</h4>
      <a href="https://agungpodomoroland.com/"><h5>www.agungpodomoroland.com</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth13.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p> Fueled by ideas, expertise and
        dedication across borders and
        beyond service lines, we create
        real estate solutions to prepare
        our clients for what’s next.</p>
    </div>
  </div>
  <div id="popup2">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/SJA.png">
    <div class="co-name">
      <h1><b>Santos Jaya Abadi</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>MNC Tower, Jl. Kebon Sirih,<br> 
        RT.15/RW.7, Kb. Sirih, Kec. Menteng,<br> 
        Kota Jakarta Pusat, 10340</h3>
      <h4>-</h4>
      <a href="https://kapalapiglobal.com/santos/?lang=id"><h5>Website Santos Jaya Abadi</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth6.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf" style="font-size: 5px">
      <p>We aim to achieve the sustainable market leadership position by delivering excellent value to our customers through continuous innovation, world-class processes, financial strength, and great people.<br><br>
        PT Santos Jaya Abadi is one of the biggest coffee roasting company in South East Asia. from 80 years experience of roasting coffee, tasting coffee, and finding the best coffee from Indonesia as well as other parts of the world. We are proud to offer some of the world finest whole beans coffee available worldwide.<br> 
      </p>
    </div>
  </div>
  <div id="popup3">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/PIGJ.png">
    <div class="co-name">
      <h1><b>Pigijo</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Plaza 89 lantai 12 suite 22-23,<br> 
        Jl. H. R. Rasuna Said No.6, Kuningan,<br>
        South Jakarta City, Jakarta 12940</h3>
      <h4>-</h4>
      <a href="https://pigijo.com/"><h5>www.pigijo.com</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth7.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>PT Tourindo Guide Indonesia Tbk, Pigijo merupakan perusahaan startup
        teknologi di bidang pariwisata, yang resmi melantai di Papan Akselerasi PT
        Bursa Efek lndonesia (Bursa) pada tanggal 8 Januari 2020. Berdiri sejak 2017,
        saat ini Pigijo memiliki gerakan #SupportLocalExpert yang membantu
        mengedukasi dan memberdayakan para pegiat pariwisata, khususnya para
        pemandu lokal dan UMKM.</p>
    </div>
  </div>
  <div id="popup4">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/YMYC.png">
    <div class="co-name">
      <h1><b>Yummy Corp</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Yummy Corp HQ.<br>
        Foresta Business Loft 2, Units 3-5.<br> 
        Tangerang, Banten 15339</h3>
      <h4>cs@yummybox.id</h4>
      <a href="https://www.yummybox.id/"><h5>www.yummybox.id</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth8.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="video">
      <div class="embed-responsive embed-responsive-21by9">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/BF7LDcy6E9A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</body>
</html>