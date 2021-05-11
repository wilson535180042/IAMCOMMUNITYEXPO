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
  <?php
  if ($error != NULL) {
  ?>
    <div class="alert alert-danger" id="alert2">
      <strong><?= $error; ?></strong>
    </div>
  <?php } ?>
  <div class="blur" id="blur" style="background-image: url('images/B1.jpg')">
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
        <h1>I T &nbsp;D I V I S I O N</h1>
        <p>front end developer</p>
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


  <div id=<?= "popupdescri"; ?>>
    <?php $p = 1;
    $k = 1; ?>
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
          <p>PT Agung Podomoro Land Tbk. (APLN) is a leading integrated diversified real estate owner, developer and manager
            in the retail, commercial, and residential real estate segments with diversified holdings. We have an integrated
            property development model, from land acquisition and/or sourcing, to design and development, to project management,
            sales, commercial leasing and marketing, to the operation and management of our superblock developments, shopping malls,
            offices, hotels, and residential apartments and houses. We are known as a pioneer of the superblock development. Our high
            quality landmark projects, to name a few are Podomoro City, Kuningan City, and Senayan City.</p>
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