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
      <a href="booth13.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>PT Anak Muda Berkarya awalnya bermula dari sebuah komunitas yaitu I AM Community atau Investor Anak Muda Community yang merupakan salah satu program diluncurkan oleh perusahaan pengembang properti yaitu PT Intiland Development Tbk sebagai Corporate Social Responbility (CSR) pada November 2018. I AM Community sendiri diperuntukan bagi anak muda yang berfokus di bidang edukasi, motivasi, pengembangan diri, serta investasi khususnya di dunia properti. Seiring berjalannya waktu I AM Community berkembang pesat dan barulah dibentuk PT Anak Muda Berkarya pada tahun 2018 dan legal pada tanggal 30 Agustus 2019 dengan menjadikan I AM Community sebagai salah satu lini bisnis.
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
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="https://estator.co.id/"><button type="submit" class="boton tonbo">V I S I T &nbsp;U S</button></a>
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
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/POP.png">
    <img class="img2" src="images/UP.png">
    <img class="img3" src="images/ERAA.png">
    <div class="co-name">
      <h1><b>ERA Real Estate</b></h1>
      <h2>@Career Expo</h2>
      <img class="img4" src="images/LOC.png">
      <img class="img5" src="images/MAIL.png">
      <img class="img6" src="images/WEB.png">
      <h3>
      TCC Batavia Tower One<br>
      8th Floor, Suite 3-5, Jl. K.H. Mas Mansyur No.126,<br>
      Daerah Khusus Ibukota Jakarta 10220</h3>
      <h4>-</h4>
      <a href="https://www.eraindonesia.com/">
        <h5>www.eraindonesia.com</h5>
      </a>
    </div>
    <div class="biodata">
      <p>C O M P A N Y &nbsp;P R O F I L E</p>
    </div>
    <div class="inlineform-buttons">
      <a href="booth16.php"><button type="submit" class="boton tonbo">V I S I T &nbsp;B O O T H</button></a>
    </div>
    <div class="paragraf">
      <p>PT Anak Muda Berkarya awalnya bermula dari sebuah komunitas yaitu I AM Community atau Investor Anak Muda Community yang merupakan salah satu program diluncurkan oleh perusahaan pengembang properti yaitu PT Intiland Development Tbk sebagai Corporate Social Responbility (CSR) pada November 2018. I AM Community sendiri diperuntukan bagi anak muda yang berfokus di bidang edukasi, motivasi, pengembangan diri, serta investasi khususnya di dunia properti. Seiring berjalannya waktu I AM Community berkembang pesat dan barulah dibentuk PT Anak Muda Berkarya pada tahun 2018 dan legal pada tanggal 30 Agustus 2019 dengan menjadikan I AM Community sebagai salah satu lini bisnis.
      </p>
    </div>
  </div>
</body>

</html>