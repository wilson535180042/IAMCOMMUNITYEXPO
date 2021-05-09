<?php
require_once "db.php";
if (!$user->isLogged()) {
  header("location: http://localhost/contohexpo/");
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
    <img class="img3" src="images/DILD.png">
    <div class="co-name">
      <h1><b>Agung Podomoro Land</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>APL Tower 43rd Floor, Podomoro City<br>
        Jl. Let. Jend. S. Parman Kav. 28<br>
        Jakarta 11470 Indonesia</h3>
      <h4>-</h4>
      <a href="https://agungpodomoroland.com/"><h5>www.agungpodomoroland.com</h5></a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth5.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>PT Agung Podomoro Land Tbk. (APLN) is a leading integrated diversified real estate owner, developer and manager
      in the retail, commercial, and residential real estate segments with diversified holdings. We have an integrated
      property development model, from land acquisition and/or sourcing, to design and development, to project management,
      sales, commercial leasing and marketing, to the operation and management of our superblock developments, shopping malls,
      offices, hotels, and residential apartments and houses. We are known as a pioneer of the superblock development. Our high
      quality landmark projects, to name a few are Podomoro City, Kuningan City, and Senayan City.</p>
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
      <img class="img4" src="img/LOC.png">
      <img class="img5" src="img/MAIL.png">
      <img class="img6" src="img/WEB.png">
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
    <img class="img3" src="images/PGJO.png">
    <div class="co-name">
      <h1><b>Pigijo</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="img/LOC.png">
      <img class="img5" src="img/MAIL.png">
      <img class="img6" src="img/WEB.png">
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
      <p>PT Agung Podomoro Land Tbk. (APLN) is a leading integrated diversified real estate owner, developer and manager
      in the retail, commercial, and residential real estate segments with diversified holdings. We have an integrated
      property development model, from land acquisition and/or sourcing, to design and development, to project management,
      sales, commercial leasing and marketing, to the operation and management of our superblock developments, shopping malls,
      offices, hotels, and residential apartments and houses. We are known as a pioneer of the superblock development. Our high
      quality landmark projects, to name a few are Podomoro City, Kuningan City, and Senayan City.</p>
    </div>
  </div>
  <div id="popup4">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/CSG.png">
    <div class="co-name">
      <h1><b>CSG Konsultan Indonesia</b></h1>
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
      <a href="booth8.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>PT Agung Podomoro Land Tbk. (APLN) is a leading integrated diversified real estate owner, developer and manager
      in the retail, commercial, and residential real estate segments with diversified holdings. We have an integrated
      property development model, from land acquisition and/or sourcing, to design and development, to project management,
      sales, commercial leasing and marketing, to the operation and management of our superblock developments, shopping malls,
      offices, hotels, and residential apartments and houses. We are known as a pioneer of the superblock development. Our high
      quality landmark projects, to name a few are Podomoro City, Kuningan City, and Senayan City.</p>
    </div>
  </div>
</body>
</html>