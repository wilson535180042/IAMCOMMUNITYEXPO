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
    <button class="next"></button>
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
    <img class="img3" src="images/YMY.png">
    <div class="co-name">
      <h1><b>Yummy Box</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Yummy Corp HQ.<br>
        Foresta Business Loft 2, Units 3-5.<br>
        Tangerang, Banten 15339</h3>
      <h4>cs@yummybox.id</h4>
      <a href="https://www.yummybox.id/">
        <h5>www.yummybox.id</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth9.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
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
      <a href="https://smileconsultingindonesia.com/">
        <h5>www.smileconsultingindonesia.com</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth10.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
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
  <div id="popup3">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/PGJO.png">
    <div class="co-name">
      <h1><b>Summarecon</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Plaza Summarecon<br>
        Jl.Perintis Kemerdekaan No. 42<br>
        Pulo Gadung, Jakarta Timur 13210</h3>
      <h4>imail@gmail.com</h4>
      <h5>www.agungpodmoro.com</h5>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth3.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
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
      <h1><b>Testing Koshong</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Plaza Summarecon<br>
        Jl.Perintis Kemerdekaan No. 42<br>
        Pulo Gadung, Jakarta Timur 13210</h3>
      <h4>imail@gmail.com</h4>
      <h5>www.agungpodmoro.com</h5>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth4.html"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
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