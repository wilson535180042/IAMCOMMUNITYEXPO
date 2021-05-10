<?php require_once "db.php";
if (!$user->isLogged()) {
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
}

$bookmark = $user->getBookmark($_SESSION['userid']);

$currentUser = $user->getProfile();

if (isset($_POST['sendforgot'])) {
  $a = $user->requestForgot($currentUser['email']);
  if ($a) {
    $_SESSION['tempmsg'] = "Silahkan cek email untuk reset password";
    $_SESSION['temptype'] = "true";
  } else {
    $_SESSION["tempmsg"] = "Gagal reset password";
    $_SESSION["temptype"] = "false";
  }
  header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO/landinglogin.php");
  die;
}

?>

<!DOCTYPE html>

<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/dashboard.css" rel="stylesheet" type="text/css">
  <script defer src="js/script.js"></script>
</head>

<body>
  <div class="wrapper1" id="blur">
    <div class="rectangle">
      <form method='POST'>
        <button type='submit' name='sendforgot' class="boton tonbo">C H A N G E &nbsp;P A S S W O R D</button>
      </form>
      <a href="landinglogin.php"><button type="submit" class="boton2 tonbo">C H A N G E &nbsp;P R O F I L E</button></a>
    </div>
    <div class="rectangle2">
      <div class="rectangle4">
        <h1><?= sizeof($bookmark); ?></h1>
        <p>Jobs you're interested in!</p>
      </div>
      <div class="inlineform-buttons">

        <?php foreach ($bookmark as $book) : ?>
          <a href="booth.php">
            <button type="button" class="botons1 tonboo">
              <h1><?= $book['divisi']; ?></h1>
              <p>front end developer</p>
              <img class="imgbut" src="images/APL.png">
            </button></a>

        <?php endforeach; ?>
      </div>
    </div>
    <div class="rectangle3">
      <div class="box">
        <img class="foto" src="images/BG.jpg">
      </div>
      <div class="foto-profile"></div>
      <div class="text">
        <h1><?= $currentUser['first_name'] . " " . $currentUser['last_name']; ?></h1>
        <h2><?= $currentUser['email']; ?></h2>
      </div>
      <div class="logo">
        <img class="ukuran" src="images/LOGOM.png">
      </div>
      <div class="home-but">
        <a href="landinglogin.php"><button type="submit" class="boton3"></button></a>
      </div>
    </div>
  </div>
</body>

</html>