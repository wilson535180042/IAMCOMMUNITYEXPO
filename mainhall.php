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
  <div class="blur" id="blur" style="background-image: url('images/MH.jpg')">
    <button class="home" onclick="document.location='landinglogin.php'"></button>
    <button class="next" onclick="document.location='mainhall2.php'"></button>
    <button class="btn-b1" onclick="toggle(1)"></button>
    <button class="btn-b2" onclick="toggle(2)"></button>
    <button class="btn-b3" onclick="toggle(3)"></button>
    <button class="btn-b4" onclick="toggle(4)"></button>
  </div>
  <div id="popup1">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/APLE.png">
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
      <a href="https://agungpodomoroland.com/">
        <h5>www.agungpodomoroland.com</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
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
    <img class="img3" src="images/SIN.png">
    <div class="co-name">
      <h1><b>Intiland</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Intiland Tower, <br>
        Penthouse Floor<br>
        Jl Jendral Sudirman 32, Jakarta 10220</h3>
      <h4>-</h4>
      <a href="https://www.intiland.com/">
        <h5>www.intiland.com</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth2.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>Intiland siap melayani kebutuhan hidup masyarakat Indonesia dengan menyediakan tempat tinggal,
        gedung perkantoran, ritel, kawasan industri, dan masih banyak lagi. Berbagai gedung ikonis telah
        Intiland kembangkan, seperti Intiland Tower yang dirancang oleh arsitek kenamaan Paul Rudolph,
        serta kondominium tepi pantai Regatta dan perkantoran terpadu South Quarter yang merupakan hasil
        karya Tom Wright, arsitek Burj Al Arab. Intiland juga telah membangun beberapa kawasan pemukiman
        prestisius dan ramah lingkungan di kota-kota besar seperti Jakarta dan Surabaya untuk Anda yang
        menyukai kenyamanan hidup berkelas. </p>
    </div>
  </div>
  <div id="popup3">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/CTRA.png">
    <div class="co-name">
      <h1><b>Humanoria</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Gedung Grha BNI<br>
        Jl. Jenderal Sudirman Kav. 1<br>
        Jakarta Pusat 10220, Indonesia</h3>
      <h4>-</h4>
      <a href="https://www.bni.co.id/">
        <h5>www.bni.co.id</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth3.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>Sejak berdiri pada tahun 1946, BNI
        senantiasa menjadi bagian dari dinamika
        pembangunan perekonomian Indonesia.
        Dalam kurun waktu lebih dari separuh abad
        itu juga, BNI telah berkembang menjadi bank
        nasional yang kokoh dengan pertumbuhan
        keuangan berkelanjutan.</p>
    </div>
  </div>
  <div id="popup4">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/PWON.png">
    <div class="co-name">
      <h1><b>Ghita Utoyo & Associates</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>Jakarta,<br>
        Indonesia</h3>
      <h4>ghita@ghitautoyo.com</h4>
      <a href="https://ghitautoyo.com/">
        <h5>www.ghitautoyo.com</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth4.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>An independent Consultant and Trainer Matrix, focus on custom Design People Development Program,
        based on spesific client needs for solution. Inspiration. Growth, Talent, these are our DNA. Inspiration
        comes from many angle. Growth is inevitable either good or bad; and an open communication with a good nurture
        can direct good Talent to produce desired result.
      </p>
    </div>
  </div>
</body>

</html>