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
  <div class="blur" id="blur" style="background-image: url('images/B13.jpg')">

    <button class="atas" onclick=<?= $to; ?>></button>

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
        <h1>Business Development & Marketing</h1>
        <p>Anak Muda Berkarya</p>
      </button>
      <button type="button" class="boton2 tonbo" onclick="toggle(11)">
        <h1>Event & Media</h1>
        <p>Anak Muda Berkarya</p>
      </button>
      <button type="button" class="boton3 tonbo" onclick="toggle(12)">
        <h1>IT Specialist & Website</h1>
        <p>Anak Muda Berkarya</p>
      </button>
      <button type="button" class="boton4 tonbo" onclick="toggle(15)">
        <h1>Podcast & Youtube</h1>
        <p>Anak Muda Berkarya</p>
      </button>
      <button type="button" class="boton5 tonbo" onclick="toggle(16)">
        <h1>Social Media & Creative</h1>
        <p>Anak Muda Berkarya</p>
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
      <a href="https://us02web.zoom.us/j/81566585377?pwd=R2JScnluN0NLKzhBYURJSUU1YW4wUT09">
      <button type="button" class="botonc tonboc">
        <h1>CALL<br>US</h1>
      </button>
      </a>
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
      <p>General Requirements:
        <ul>
          <li>Students in the first semester or 18-21 years old(Male or Female)</li>
          <li>Domicile could be anywhere (open for all cities)</li>
          <li>Interested into topics like Self-Development, Business, and Property Investment</li>
          <li>Honest, responsible and committed</li>
          <li>Active, creative, and initiative</li>
          <li>Responsive, especially on WhatsApp groups</li>
          <li>Time discipline (if there are meetings) and have good time management</li>
          <li>Able to work well and diligently</li>
          <li>Able to work individually and in teams</li>
          <li>Have a good attitude and communication</li>
          <li>Master a foreign language is a plus</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Division Requirements:
        <ul>
          <li>Interested and aware about news development, especially in the business & property sector</li>
          <li>Have interest & experience in organizations, in financial, marketing and business development field is a plus</li>
          <li>Enjoy research activities and has good analytical skills</li>
          <li>Enjoy to learn something new </li>
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
      <p>General Requirements:
        <ul>
          <li>Students in the first semester or 18-21 years old(Male or Female)</li>
          <li>Domicile could be anywhere (open for all cities)</li>
          <li>Interested into topics like Self-Development, Business, and Property Investment</li>
          <li>Honest, responsible and committed</li>
          <li>Active, creative, and initiative</li>
          <li>Responsive, especially on WhatsApp groups</li>
          <li>Time discipline (if there are meetings) and have good time management</li>
          <li>Able to work well and diligently</li>
          <li>Able to work individually and in teams</li>
          <li>Have a good attitude and communication</li>
          <li>Master a foreign language is a plus</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Division Requirements:
        <ul>
          <li>Have the ability to establish and build good relationships with media, journalists, and community members</li>
          <li>Understand writing articles according to EYD (Enhanced Spelling System)</li>
          <li>Capable to help and understand writing  Press Release according to EYD </li>
          <li>Interested and able to manage and plan events</li>
          <li>Proficient in events’ organization and administration</li>
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
      <p>General Requirements:
        <ul>
          <li>Students in the first semester or 18-21 years old(Male or Female)</li>
          <li>Domicile could be anywhere (open for all cities)</li>
          <li>Interested into topics like Self-Development, Business, and Property Investment</li>
          <li>Honest, responsible and committed</li>
          <li>Active, creative, and initiative</li>
          <li>Responsive, especially on WhatsApp groups</li>
          <li>Time discipline (if there are meetings) and have good time management</li>
          <li>Able to work well and diligently</li>
          <li>Able to work individually and in teams</li>
          <li>Have a good attitude and communication</li>
          <li>Master a foreign language is a plus</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Division Requirements:
        <ul>
          <li><b>Back End:</b></li>
          <li>Have experience in using PHP and MySQL</li>
          <li>Experience with Wordpress</li>
          <li>Teamwork skills with a problem-solving attitude</li>
          <li><b>Front End:</b></li>
          <li>Have experience in using HTML and CSS</li>
          <li>Have experience in using Bootstrap</li>
          <li>Able to use balsamiq, figma, and other applications</li>
          <li>Teamwork skills with a problem-solving attitude</li>
          <li><b>Design Graphic:</b></li>
          <li>Able to use Photoshop or Illustrator</li>
          <li>Creative</li>
          <li>Abilities with proven design skills</li>
          <li>Teamwork skills with a problem-solving attitude</li>
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
      <p>General Requirements:
        <ul>
          <li>Students in the first semester or 18-21 years old(Male or Female)</li>
          <li>Domicile could be anywhere (open for all cities)</li>
          <li>Interested into topics like Self-Development, Business, and Property Investment</li>
          <li>Honest, responsible and committed</li>
          <li>Active, creative, and initiative</li>
          <li>Responsive, especially on WhatsApp groups</li>
          <li>Time discipline (if there are meetings) and have good time management</li>
          <li>Able to work well and diligently</li>
          <li>Able to work individually and in teams</li>
          <li>Have a good attitude and communication</li>
          <li>Master a foreign language is a plus</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Division Requirements:
        <ul>
          <li><b>Host and Script Writer:</b></li>
          <li>Woman, Used to script-writing for interview purpose</li>
          <li>Have good letter pronunciation or experienced VO </li>
          <li>Able to work according to deadlines</li>
          <li><b>Video Editor:</b></li>
          <li>Man / Woman, Understand about Video Resolution (IGTV and Youtube)</li>
          <li>Proficient in Basic Video Editing </li>
          <li>Able to master at least After Effect or Adobe Premiere </li>
          <li>Able to work according to deadlines</li>
          <li><b>Design Graphic:</b></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
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
      <p>General Requirements:
        <ul>
          <li>Students in the first semester or 18-21 years old(Male or Female)</li>
          <li>Domicile could be anywhere (open for all cities)</li>
          <li>Interested into topics like Self-Development, Business, and Property Investment</li>
          <li>Honest, responsible and committed</li>
          <li>Active, creative, and initiative</li>
          <li>Responsive, especially on WhatsApp groups</li>
          <li>Time discipline (if there are meetings) and have good time management</li>
          <li>Able to work well and diligently</li>
          <li>Able to work individually and in teams</li>
          <li>Have a good attitude and communication</li>
          <li>Master a foreign language is a plus</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Division Requirements:
        <ul>
          <li>Skilled in making visual designs using Canva (If you have no experience, you will be taught)</li>
          <li>Have experience in copywriting</li>
          <li>Interested into topics like Self-Development, Business, and Property Investment</li>
          <li>Have experience in managing several social media platforms, including Instagram, Twitter, and Tiktok (at least mastering one of them)</li>
          <li>Creative and discipline</li>
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