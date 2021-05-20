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
        <h1>SALES EXECUTIVE</h1>
        <p>Agung Podomoro Land</p>
      </button>
      <button type="button" class="boton2 tonbo" onclick="toggle(11)">
        <h1>QUANTITY SURVEYOR STRUCTURE AND ARCHITECT</h1>
        <p>Agung Podomoro Land</p>
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
        <h1>SEND<br>EMAIL</h1>
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
      <p>Requirements:
      <ul>
        <li>Possess at least a Diploma III’s Degree or Bachelor’s Degree, from any major Study Program, from accredited universities.</li>
        <li>Courage in selling high-end property products, from well-known property development companies.</li>
        <li>Having physically fit condition, age between 25 to 28 years.</li>
        <li>Prioritized on managing up-to-date prospective customer databases for high-end property products.</li>
        <li>Having mature interpersonal communication skills, good personal grooming and appearance, strong persuasion, and negotiation skills to support their success in approaching, attracting, and closing customers.</li>
        <li>Dynamic and high self-drives to achieve success, always oriented towards achieving predetermined sales targets, taking initiative, and having good work endurance.</li>
        <li>The company provides attractive incentives, on-time commissions, rewards for top sales, and year-end bonuses to reward work performance, as well as allowances in the form of health insurance, BPJS Ketenagakerjaan, and BPJS Kesehatan.</li>
        <li>Willing to be placed in all Agung Podomoro projects in the Jabodetabek area.</li>
      </ul>
    </p>
  </div>
  <div class="paragrafs2">
    <p>
        Responsibilities:<ul>
          <li>Selling property products by prospecting and presenting products to targeted customers or institutions, so that sales targets are achieved through marketing activities.</li>
          <li>Maintaining good relationships with customers, up to the after-sales stage.</li>
          <li>Manage all feedback from customers, related to product quality and its services.</li>
          <li>Conducting competitor surveys and other external party activities to obtain accurate data for product development.</li>
          <li>Provide periodic performance reports to the Head of Sales Section.</li>
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
      <p>Requirements:
        <ul>
          <li>Possess at least a Bachelor’s Degree, from Civil Engineering or Architecture Study Program, from accredited universities, with minimum GPA: 3.00.</li>
          <li>Having a minimum of 3 years of working experience in a QS Structure and Architect position, especially in a township or landed house projects at well-known property development companies or QS consultants.</li>
          <li>Having physically fit condition, age between 25 to 30 years.</li>
          <li>Having knowledge and experience related to building construction management and structural codes with national and international standards.</li>
          <li>Willing to be placed in Kota Podomoro, Bogor Regency, West Java.</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Responsibilities:
        <ul>
          <li>Coordinating with the planning & design department to ensure the working drawing of the building and area.</li>
          <li>Calculating the quantity of material required by the project, relates to the working drawings.</li>
          <li>Collecting up-date material price lists relate to predetermined specifications.</li>
          <li>Negotiating with suppliers and contractors regarding the unit price of material and the price package for the implementation of the work.</li>
          <li>Controlling the project budget related to added and less work, including monitoring invoice bills.</li>
          <li>Provide periodic performance reports to the Head of Quantity Surveyor Department.</li>
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
      <p>Requirements:
      <ul>
        <li>Possess at least a Diploma III’s Degree or Bachelor’s Degree, from any major Study Program, from accredited universities.</li>
        <li>Courage in selling high-end property products, from well-known property development companies.</li>
        <li>Having physically fit condition, age between 25 to 28 years.</li>
        <li>Prioritized on managing up-to-date prospective customer databases for high-end property products.</li>
        <li>Having mature interpersonal communication skills, good personal grooming and appearance, strong persuasion, and negotiation skills to support their success in approaching, attracting, and closing customers.</li>
        <li>Dynamic and high self-drives to achieve success, always oriented towards achieving predetermined sales targets, taking initiative, and having good work endurance.</li>
        <li>The company provides attractive incentives, on-time commissions, rewards for top sales, and year-end bonuses to reward work performance, as well as allowances in the form of health insurance, BPJS Ketenagakerjaan, and BPJS Kesehatan.</li>
        <li>Willing to be placed in all Agung Podomoro projects in the Jabodetabek area.</li>
      </ul>
    </p>
  </div>
  <div class="paragrafs2">
    <p>
        Responsibilities:<ul>
          <li>Selling property products by prospecting and presenting products to targeted customers or institutions, so that sales targets are achieved through marketing activities.</li>
          <li>Maintaining good relationships with customers, up to the after-sales stage.</li>
          <li>Manage all feedback from customers, related to product quality and its services.</li>
          <li>Conducting competitor surveys and other external party activities to obtain accurate data for product development.</li>
          <li>Provide periodic performance reports to the Head of Sales Section.</li>
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