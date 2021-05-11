<?php
require_once "db.php";
if (!$user->isLogged()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
}
if (isset($_POST['save'])) {
  $user->bookmark($_SESSION['userid'], intval($_POST['idloker']));
}

$loker = $user->getloker($_SESSION['userid']);
$profile = $user->getProfile();
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
  <?php if ($profile['role'] == "Premium") :
    $to = "toggle(3)" ?>

  <?php else :
    $to = "toggle(99)" ?>
    <div class="alert alert-warning" id="alert2">
      <strong>Maaf fitur ini hanya untuk user premium</strong>
    </div>
  <?php endif; ?>
  <div class="blur" id="blur" style="background-image: url('images/B5.jpg')">

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
    <div class="inlineform-buttons2">
      <?php
      $i = 15;
      foreach ($loker[2]['loker'] as $lo) :
      ?>

        <button type="button" class="boton tonbo" onclick="toggle(<?= $i; ?>)">
          <h1><?= $lo['divisi']; ?></h1>
          <p>front end developer</p>
        </button>
      <?php
        $i++;
      endforeach;
      ?>
    </div>


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
      <p>We facilitate ZOOM Meetings with the company you desire, click button to start!</p>
    </div>
    <div class="inlineform-buttons">
      <button type="button" class="botonc tonboc">
        <h1>MARKETTING<br>DIVISION</h1>
      </button>
      <button type="button" class="botonc2 tonboc">
        <h1>IT & WEBSITE<br>DIVISION</h1>
      </button>
      <button type="button" class="botonc3 tonboc">
        <h1>SOCIAL MEDIA<br>DIVISION</h1>
      </button>
    </div>
  </div>


  <?php $j = 15;
  foreach ($loker[2]['loker'] as $lok) :
  ?>
    <div id=<?= "popupdescri$j"; ?>>
      <button class="btnspecial" id="special" onclick="puggle()"></button>
      <img class="img1" src="images/JV.png">
      <img class="img2" src="images/JV2.png">
      <img class="img3" src="images/LOGO.png">
      <div class="co-name">
        <h1><b>Welcome to Career Expo</b></h1>
        <h2>by I AM Community</h2>
      </div>
      <div class="biodata">
        <p>J O B &nbsp;D E S C R I P T I O N</p>
      </div>
      <div class="inlineform-buttons">
        <form method='post' method='post'>
          <input type='hidden' name="idloker" value=<?= $lok['no'] ?>>
          <button type="submit" class="botond tonbod" onclick="toggle(13)">
            <p>A P P L Y</p>
          </button>
          <?php if ($lok['bookmarked'] == false) : ?>
            <button type="submit" class="botond2 tonbod" name="save">
              <p>S A V E</p>
            </button>
          <?php endif; ?>
        </form>
      </div>
      <div class="paragrafs">
        <p><?= $lok['keterangan']; ?></p>
      </div>
      <div class="newmember">
        <p>New Member? Click Here!</p>
      </div>
    </div>
  <?php
    $j++;
  endforeach; ?>

</body>

</html>