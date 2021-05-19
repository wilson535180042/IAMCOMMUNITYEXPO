<?php
require_once "db.php";

if (!$user->isLogged()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
}
if (isset($_POST['save'])) {
  $bm = $user->bookmark($_SESSION['userid'], intval($_POST['idloker']));
}

if (isset($_POST['remove'])) {
  $user->removeBookmark($_SESSION['userid'], intval($_POST['idloker']));
}

$loker = $user->getloker($_SESSION['userid']);
$profile = $user->getProfile();

$error = $user->getError();

?>


<!DOCTYPE html>

<head>
  <title>Booth</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/booth.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <script defer src="js/index.js"></script>
</head>

<body>
  <?php if ($error != NULL) :
    if ($error == "Maaf anda sudah mencapai limit bookmark (3)") :
  ?>
      <div class="alert alert-warning">
        <strong><?= $error; ?></strong>
      </div>
    <?php else : ?>
      <div class="alert alert-success">
        <strong><?= $error; ?></strong>
      </div>
  <?php endif;
  endif; ?>

  <?php if ($profile['role'] == "Premium") :
    $to = "toggle(3)" ?>

  <?php else :
    $to = "toggle(99)" ?>
    <div class="alert alert-warning" id="alert2">
      <strong>Maaf fitur ini hanya untuk user premium</strong>
    </div>
  <?php endif; ?>
  <div class="blur" id="blur" style="background-image: url('images/B2.jpg')">

    <button class="atas" onclick=toggle(3)></button>

    <button type='button' class="bawah" onclick="toggle(1)"></button>
    <a href="mainhall.php"><img class="home" src="images/Asset 1.png"></a>
  </div>
  <div id="popup">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;V A C A N C I E S</p>
    </div>
    <div class="inlineform-buttons">
      <button type="button" class="boton tonbo" onclick="toggle(10)">
        <h1>SALES EXECUTIVE</h1>
        <p>Intiland Jakarta</p>
      </button>
      <button type="button" class="boton2 tonbo" onclick="toggle(10)">
        <h1>FINANCE STAFF (CASHIER)</h1>
        <p>Intiland Jakarta</p>
      </button>
      <button type="button" class="boton3 tonbo" onclick="toggle(10)">
        <h1>PROJECT LEGAL SUPERVISOR</h1>
        <p>Intiland Jakarta</p>
      </button>
      <button type="button" class="boton4 tonbo" onclick="toggle(10)">
        <h1>MARKETING MANAGER</h1>
        <p>Intiland Jakarta</p>
      </button>
      <button type="button" class="boton5 tonbo" onclick="toggle(10)">
        <h1>DESIGN & SPECIFICATION STAFF</h1>
        <p>Intiland Surabaya</p>
      </button>
      <button type="button" class="boton6 tonbo" onclick="toggle(10)">
        <h1>SALES EXECUTIVE</h1>
        <p>Intiland Surabaya</p>
      </button>
      <button type="button" class="boton7 tonbo" onclick="toggle(10)">
        <h1>ACCOUNTING STAFF</h1>
        <p>Intiland Surabaya</p>
      </button>
    </div>
  </div>

  <div id="popupregis">
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img4" src="images/Asset 17.png">
    <img class="img5" src="images/Asset 16.png">
    <img class="img6" src="images/LOGO.png">
    <div class="co-namec">
      <h1><b>Welcome to Career Expo</b></h1>
      <h2>by I AM Community</h2>
    </div>
    <div class="biodatac">
      <p>C O N T A C T &nbsp;U S</p>
    </div>
    <div class="kalimat">
      <p>We facilitate Meetings with the company you desire, click button to start!</p>
    </div>
    <div class="inlineform-buttons">
      <button type="button" class="botonc tonboc">
        <h1>(JAKARTA)<br>SEND EMAIL</h1>
      </button>
      <button type="button" class="botonc2 tonboc">
        <h1>(SURABAYA)<br>SEND EMAIL</h1>
      </button>
    </div>
  </div>

  <div id=<?= "popupdescri"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Uraian Pekerjaan:
        <ul>
          <li>Mencari calon pembeli properti yang potensial.</li>
          <li>Memasarkan produk-produk properti kepada konsumen saat ini maupun calon pembeli baru.</li>
          <li>Menjalin dan membina hubungan baik dengan pembeli dan calon pembeli.</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Kriteria:
        <ul>
          <li>Berpendidikan Sarjana dari segala jurusan dengan pengalaman Sales di bidang properti akan menjadi nilai tambah.</li>
          <li>Individu yang aktif, enerjik, menyukai tantangan dan memiliki keterampilan interpersonal yang baik.</li>
          <li>Mampu bertutur kata dalam bahasa Indonesia dan bahasa Inggris dengan baik dan benar.</li>
          <li>Mampu bekerja secara mandiri maupun dalam tim.</li>
          <li>Bersedia ditempatkan di proyek sesuai kebutuhan perusahaan.</li>
        </ul>
      </p>
    </div>
    <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>

    <div id=<?= "popupdescri2"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Uraian Pekerjaan:
        <ul>
          <li>Menjalankan proses pembayaran tagihan (seperti: invoice, giro mundur, reimbursement, dll) ketentuan yang berlaku</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Kriteria:
        <ul>
          <li>Lulusan D3</li>
          <li>Berpengalaman sebagai Staff Keuangan minimal 2 tahun</li>
          <li>Menyukai pekerjaan administratif serta memiliki ketelitian dan minat terhadap hal-hal detil</li>
        </ul>
      </p>
    </div>
        <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>

    <div id=<?= "popupdescri3"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Uraian Pekerjaan:
        <ul>
          <li>Menyusun draft dan melakukan review perjanjian</li>
          <li>Membuat Surat Somasi dan pembatalan unit</li>
          <li>Melakukan legal action (non-litigation) untuk proyek dan estate management</li>
          <li>Melakukan pengarsipan dokumen PPJB, SP, BAST dan dokumen-dokumen legal lainnya.</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Kriteria:
        <ul>
          <li>Lulusan Sarjana Hukum</li>
          <li>Berpengalaman di bidang properti akan menjadi nilai tambah</li>
          <li>Bersedia ditempatkan di Tangerang</li>
        </ul>
      </p>
    </div>
        <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>

    <div id=<?= "popupdescri4"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Uraian Pekerjaan:
        <ul>
          <li>Memastikan pencapaian target penjualan yang telah ditentukan</li>
          <li>Memastikan implementasi rencana strategi marketing berjalan dengan baik guna mencapai target penjualan yang telah disepakati</li>
          <li>Memastikan komplain konsumen yang berhubungan dengan Marketing (sebelum serah terima) dapat terselesaikan dengan baik</li>
          <li>Memastikan seluruh anggota tim/agent mendapatkan kesempatan yang sama untuk pengembangan keterampilan dalam bekerja</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Kriteria:
        <ul>
          <li>Lulusan Sarjana dengan pengalaman minimal 5 tahun sebagai Marketing Manager atau Sales Manager di bidang apartemen kelas menengah ke atas</li>
        </ul>
      </p>
    </div>
        <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>

    <div id=<?= "popupdescri5"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Requirement:
        <ul>
          <li>Bachelor of Architecture</li>
          <li>Max age 25 years old</li>
          <li>Mnimun 1 - 2 years of experience, preferably in Property</li>
          <li>Strong understanding of housing, commercial, and highrise building</li>
          <li>Required skill : AutoCAD, Revit, Sketchup, Photoshop</li>
        </ul>
      </p>
    </div>
        <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>

    <div id=<?= "popupdescri6"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Requirement:
        <ul>
          <li>Max 35 years old</li>
          <li>Active, energetic, and good team player</li>
          <li>Hard working</li>
          <li>All major degrees are welcome to apply</li>
          <li>Excellent communication skills</li>
          <li>Target oriented</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Benefits:
        <ul>
          <li>Basic Salary and Commision</li>
          <li>Growing with profitable company</li>
          <li>Opportunities for career advancement</li>
          <li>Excellent experienced sales support staff</li>
          <li>Property industry and sales training</li>
        </ul>
      </p>
    </div>
        <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>

    <div id=<?= "popupdescri7"; ?>>
    <?php $p = 2;
    $k = 2; ?>
    <button class="btnspecial" id="special" onclick="puggle()"></button>
    <img class="img1" src="images/JV.png">
    <img class="img2" src="images/JV2.png">
    <img class="img3" src="images/LOGO.png">
    <div class="biodata">
      <p>J O B &nbsp;D E S C R I P T I O N</p>
    </div>
    <div class="inlineform-buttons">
      <form method='post' method='post'>
        <input type='hidden' name="idloker" value=<?= $k ?>>
        <button type="submit" class="botond tonbod" onclick="toggle(13)">
          <p>A P P L Y</p>
        </button>
        <div class="paragrafs">
      <p>Responsibilities:
        <ul>
          <li>Primary responsibility is to supervise and work closely with a team of accountants</li>
          <li>Prepare monthly account reconciliations</li>
          <li>Assist in documentation and monitoring of internal controls</li>
          <li>Prepare of financial statements including supporting reports to ensure completeness and accuracy</li>
          <li>Monthly tax calculations (Article 21, 23, 25, and VAT) and tex reporting</li>
          <li>Verify and analyze the amount of tax reported and the amount of tax inputted to the system to ensure the correctness and accuracy of the data</li>
      <p>Requirements:
        <ul>
          <li>Graduates from bachelor degree majoring Accounting from credible universities with minimum GPA of 3.00 (Fresh Graduates)</li>
          <li>Maximum age of 25 years old</li>
          <li>Comprehensive knowledge of accounting, cash flowplanning, balance sheet, and general ledger</li>
          <li>Has the ability to operate accounting and tax applications (Accurate, etc)</li>
          <li>Having a strong analytical power and high dedication, critical, and able to solve problems/ make decisions</li>
        </ul>
      </p>
    </div>
        <?php if ($loker[$p]["loker"][$k]['bookmarked'] == false) : ?>
          <button type="submit" class="botond2 tonbod" name="save">
            <p>S A V E</p>
          </button>
        <?php else :
        ?>
          <button type="submit" class="botond2 tonbod" name="remove">
            <p>R E M O V E </p>
          </button>
        <?php endif; ?>
      </form>
    </div>
</body>

</html>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>