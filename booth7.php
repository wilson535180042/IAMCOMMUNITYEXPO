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
  <div class="blur" id="blur" style="background-image: url('images/B7.jpg')">

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
          <h1>MARKETING</h1>
          <p>Pigijo Intern</p>
        </button>
        <button type="button" class="boton2 tonbo" onclick="toggle(11)">
          <h1>CONTENT CREATOR & SOCIAL MEDIA</h1>
          <p>Pigijo Intern</p>
        </button>
        <button type="button" class="boton3 tonbo" onclick="toggle(12)">
          <h1>BUSINESS DEVELOPMENT</h1>
          <p>Pigijo Intern</p>
        </button>
        <button type="button" class="boton4 tonbo" onclick="toggle(15)">
          <h1>GRAPHIC DESIGN</h1>
          <p>Pigijo Intern</p>
        </button>
        <button type="button" class="boton5 tonbo" onclick="toggle(16)">
          <h1>FRONT END DEVELOPER</h1>
          <p>Pigijo Intern</p>
        </button>
        <button type="button" class="boton6 tonbo" onclick="toggle(17)">
          <h1>BACK END DEVELOPER</h1>
          <p>Pigijo Intern</p>
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
          <li>Excellent communication capability in both Bahasa Indonesia and
            English</li>
          <li>Good team player, positive attitude and eagerness to learn</li>
          <li>Good knowledge with a web markup language and search engine
            optimization, digital marketing, push add, gdn, etc.</li>
          <li>Have good copywriting skills</li>
          <li>Have outstanding analytical skills and an independent problem
            solver</li>
          <li>Have experience in handling social media accounts/contents</li>
          <li>Have general knowledge about e-commerce</li>
          <li>Understand the importance of copyright</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Job Description:
        <ul>
          <li>In charge of promotional copies for campaign purposes (e.g. push
            notification, email blast, & campaign assets, Broadcast Message)</li>
          <li>Initiate new ideas and improvements to grow the feature</li>
          <li>Writing clear, concise, and grammatically correct copies for the
            website anf sosial media campaigns.</li>
          <li>Create marketing/advertising contents along with the marketing
            team</li>
          <li>Driving the creation of original concepts that result in effective
            and compelling communication.</li>
          <li>Support campaign material ( photo and or video)</li>
          <li>Support marketing performance analysis and how to solve any
            bottlenecks/issues</li>
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
          <li>Capable of writing about any subjects or themes for blog and
            website</li>
          <li>Expert in content strategy & management</li>
          <li>Up to date with the trending in Youtube, Twitter, Instagram, Tik-
            Tok and other social media platforms</li>
          <li>Creative and initiative to create content</li>
          <li>Strong analytical skills, and data-driven thinking to create
            content</li>
          <li>Can take good photos & video / are a pretty-good photographer</li>
          <li>Capable for edit photos & video Job Description</li>
          <li>Research industry-related topics</li>
          <li>Conduct keyword research and use SEO guidelines to optimize
            content</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Job Description:
        <ul>
          <li>Creating content, including text posts, video and images for use
            on social media</li>
          <li>Promoting products, services and content over social media, in a
            way that is consistent with an organisation’s brand and social
            media strategy</li>
          <li>Scheduling social media posts</li>
          <li>Developing new social media strategies and campaigns</li>
          <li>Write Blog with highlights & related topics</li>
          <li>Coordinate with marketing and design teams to illustrate articles</li>
          <li>Edit and proofread written pieces before publication</li>
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
      <p>Requirements:
        <ul>
          <li>Have a good interpersonal and communication with any division</li>
          <li>Excellent writing and proofreading skills</li>
          <li>Good knowledge and good passion for the E-commerce industry
            (system and visual)</li>
          <li>Preferably highly skilled in Excel eg. Vlook up & Hlookup</li>
          <li>Have hands-on experience with Content Management Systems, eg.
            WordPress</li>
          <li>Details about all content of product</li>
          <li>Already familiar with online marketing campaigns</li>
          <li>Have basic knowledge in keyword search</li>
          <li>Good at time management</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Job Description:
        <ul>
          <li>Perform research, analysis, and surveys product from any
            capability source.</li>
          <li>Operate all product to appear and be accessible on the website</li>
          <li>Product Curation before appear</li>
          <li>Record all products on digital documents(Ms. Excel)</li>
          <li>Work with team to enhance the user experience with your
            copywriting or creative writing skills</li>
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
      <p>Requirements:
        <ul>
          <li>Candidate must be a student in Art/Design/Creative Multimedia or
            equivalent</li>
          <li>Familiarity with design software (Photoshop, AI, Premiere, Adobe
            After Effect, etc)</li>
          <li>Creative and detail-oriented</li>
          <li>Have a good taste for design</li>
          <li>Think creatively and develop new design concepts, graphics and
            layouts</li>
          <li>Attention to detail</li>
          <li>Good time-management skills</li>
          <li>Photography and Videography Skills will be a plus</li>
          <li>Enjoy working in a fast paced environment</li>
        </ul>
      </p>
    </div>
    <div class="paragrafs2">
      <p>Job Description:
        <ul>
          <li>Learn to make concepts and creatively design artworks (e.g.
            branding, company profile, product catalogue, etc.)</li>
          <li>Preparing design for social media creative such as Instagram and
            Facebook ( video and images)</li>
          <li>Brainstorm and develop ideas for creative marketing campaigns
            Coordinate with marketing and design teams to illustrate
            content/campaigns</li>
          <li>Create visual concepts that identify a product or convey a
            message</li>
          <li>Illustrating concepts by designing examples of art arrangement,
            size, type size and style and submitting them for approval</li>
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
      <p>Requirements:
        <ul>
          <li>Familiar with Gitflow</li>
          <li>Passionate in learning new technologies</li>
          <li>Good Knowledge of Javascript (pref. NodeJs)</li>
          <li>Hands-on experience with frontend framework (pref. SvelteJs)</li>
          <li>Knowledge of prototyping tool (Figma)</li>
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
          <li>Understand programming languages (Node, js)</li>
          <li>Getting used to utilize NO SQL (MongoDB, Firebase etc)</li>
          <li>Understand about github</li>
          <li>Knowing git source control</li>
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