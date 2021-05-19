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
  <div class="blur" id="blur" style="background-image: url('images/MH4.jpg')">
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
    <img class="img3" src="images/AMBT.png">
    <div class="co-name">
      <h1><b>Anak Muda Berkarya</b></h1>
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
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth9.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>I AM Community atau Investor Anak Muda Community merupakan sebuah komunitas yang diperuntukkan khususnya bagi anak muda yang berfokus pada edukasi, motivasi, pengembangan diri, dan investasi khususnya di dunia properti.
        I AM Community memiliki tugas untuk memotivasi dan memberikan pemahaman bagi banyak orang di luar sana agar sadar dan paham mengenai pentingnya investasi melalui edukasi di sosial media, seminar, atau melalui workshop yang diadakan dengan para narasumber terpercaya di bidangnya dengan konsep "fun" atau menyenangkan.
      </p>
    </div>
  </div>
  <div id="popup2">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/APL.png">
    <div class="co-name">
      <h1><b>I AM Community</b></h1>
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
      <p>O U R &nbsp;P R O J E C T S</p>
    </div>
    <div class="inlineform-buttons">
      <a href="http://soiree.iamcommunity.co.id/"><button type="submit" class="botoni tonbo">S O I R E E &nbsp;A T &nbsp;H O M E</button></a>
      <a href="https://iamcommunity.co.id/i-am-talent-and-career/"><button type="submit" class="botoni2 tonbo">I &nbsp;A M &nbsp;T A L E N T &nbsp;A N D &nbsp;C A R E E R</button></a>
    </div>
  </div>
  <div id="popup3">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/ESTT.png">
    <div class="co-name">
      <h1><b>Estator Indonesia</b></h1>
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
      <p>O U R &nbsp;P O R T O F O L I O</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth3.php"><button type="submit" class="boton tonbo">L E A R N &nbsp;M O R E</button></a>
    </div>
    <div class="paragraf">
      <p>Estator merupakan platform investasi patungan properti dengan harga 
terjangkau bagi masyarakat Indonesia. Kami sudah berhasil melaksanakan 
investasi patungan properti perdana kami dengan dukungan dari puluhan 
investor dengan harga start from 3 juta-an per lot. Properti Pertama 
yang kami investasikan adalah Apartemen Aeropolis. Apartemen Aeropolis yang 
terletak di Jl. Kp. Sekarwangi, Tangerang ini, memiliki 2 kamar tidur dan 
1 kamar mandi. Apartemen yang memiliki luas 36 m2 ini juga dilengkapi dengan fasilitas yang lengkap. Apartement ini berada tepat di belakang bandara Soekarno-Hatta, sehingga memudahkan traveller untuk beristirahat. Apartemen Aeropolis juga dekat dengan rumah sakit, pusat perbelanjaan, sekolah, dan masih banyak lagi.
Anda dapat bertanya langsung melalui Admin kami di nomor WhatsApp kami 
+6281808556152 atau Anda dapat mempelajari lebih lanjut melalui website kami.</p>
    </div>
  </div>
  <div id="popup4">
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