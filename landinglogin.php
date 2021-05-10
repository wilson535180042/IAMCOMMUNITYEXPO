<?php require_once "db.php";
if (!$user->isLogged()) {
    header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
}

if (isset($_SESSION['tempmsg']) && isset($_SESSION['temptype'])) {
    $msg = $_SESSION['tempmsg'];
    $ertype = $_SESSION['temptype'];
    unset($_SESSION['tempmsg']);
    unset($_SESSION['temptype']);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Expo by I AM Community</title>
    <!--bootsrap css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--css index-->
    <link rel="stylesheet" href="css/stylesheet.css">
    <!--bootsrap login-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-cut.css">
    <!--pop up javascript-->
    <script defer src="js/index.js"></script>
</head>

<body>
    <?php if (isset($ertype) && $ertype == "true") {

    ?>
        <div class="alert alert-warning">
            <strong>Berhasil! </strong><?= $msg; ?>
        </div>
    <?php } ?>

    <?php if (isset($ertype) && $ertype == "false") {

    ?>
        <div class="alert alert-danger">
            <strong>Gagal! </strong> <?= $msg; ?>
        </div>
    <?php } ?>
    <!--LANDING-->
    <div class="wrapper2" id="blur">
        <div class="btn-wrapper">
            <button class="btn-login" style="border: 0; outline: 0;" onclick="document.location='dashboard.php'"></button>
            <button class="btn-mainhall" style="border: 0; outline: 0;" onclick="document.location='mainhall.php'"></button>
            <button class="btn-register" style="border: 0; outline: 0;" onclick="document.location='logout.php'"></button>
            <button class="btn-i" onclick="toggle(4)" style="border: 0; outline: 0;"></button>
            <button class="btn-toilet" onclick="document.location='toilet.html'" style="border: 0; outline: 0;"></button>
        </div>
    </div>

    <!--INFO-->
    <div class="exit" id="popupinfo">
        <button class="btnspecial" id="special" onclick="puggle()" style="border: 0; outline: 0;"></button>
        <div class="popupinfo">
            <div class="logowrapper3">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper3">
                <h4 class="title3"><strong>I N F O R M A T I O N</span></strong></h4>
                <div class="inlineform7">
                    <div class="btn-faq" onclick="toggle(6)"></div>
                    <div class="btn-list"></div>
                </div>
            </div>
        </div>
    </div>

    <!--INFO FAQ-->
    <div class="exit" id="popupfaq">
        <button class="btnspecial" id="special" onclick="puggle()" style="border: 0; outline: 0;"></button>
        <div class="popupfaq">
            <div class="logowrapper3">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper4">
                <h3 class="title4">INFORMATION</h3>
                <h4 class="title5"><strong>F R E Q U E N T L Y &nbsp; A S K E D &nbsp; Q U E S T I O N</span></strong></h4>
                <div class="inlineform8">
                    <P>1. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>2. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>3. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>4. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>5. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>6. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>7. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                    <P>8. Lorem ipsum dolor sit amet consectetur adipisicing elit facilis illo incidunt?</P>
                </div>
            </div>
        </div>
    </div>
</body>

</html>