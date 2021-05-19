<?php
require_once "db.php";
if (!$user->isLogged()) {
    header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
}

if (isset($_POST['sendforgot'])) {
    $email = $_POST['email'];
    $a = $user->requestForgot($email);
    if ($a) {
        $ertype = "true";
    } else {
        $ertype = "false";
    }
    $error = $user->getError();
}

?>
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
</head>

<body>

    <?php if (isset($ertype) && $ertype == "false") {

    ?>
        <div class="alert alert-danger">
            <strong><?= $error; ?> </strong>
        </div>
    <?php } ?>

    <?php if (isset($ertype) && $ertype == "true") {

    ?>
        <div class="alert alert-success">
            <strong><?= $error; ?></strong> <?= $error; ?>
        </div>
    <?php } ?>
    <!--LANDING-->
    <<<<<<< Updated upstream:forgot.php <div class="wrapper1" id="blur">
        <div class="btn-wrapper">
            <button class="btn-login" onclick="toggle()">LOGIN</button>
            <button class="btn-mainhall">MAIN HALL</button>
            <button class="btn-register">REGISTER</button>
            <button class="btn-i">INFO</button>
        </div>
        </div>
        =======
        <a href="landinglogin.php"><button class="btnspecial" id="special" style="border: 0; outline: 0;"></button></a>
        <div class="wrapper1" id="blur"></div>
        >>>>>>> Stashed changes:forgot.php
        <!--FORGOT PASSWORD-->
        <div class="popupforgot" id="popupforgot">
            <div class="logowrapper3">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper3">
                <h4 class="title3"><strong>F O R G O T &nbsp; P A S S W O R D</span></strong></h4>
                <form class="formforgot" method='post'>
                    <div class="inlineform6">
                        <div class="set1">
                            <label class="text-white mt-3 mb-3" for="email">Email</label>
                            <input class="form-control4" id="email" type="email" name='email'>
                        </div>
                        <div class="inlineform3-buttons">
                            <div class='set3'>
                                <label class="text-white mt-3 mb-3">Kami akan mengirimkan instruksi untuk mereset password, mohon cek email anda</label>
                            </div>
                            <form>
                                <<<<<<< Updated upstream:forgot.php <button type="submit" class="btn3 button reset">R E S E T &nbsp;P A S S W O R D</button>
                                    =======
                                    <button type="submit" class="btn3 button reset" name='sendforgot' style="border: 0; outline: 0;">R E S E T &nbsp;P A S S W O R D</button>
                                    >>>>>>> Stashed changes:forgot.php
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function toggle() {
                var blur = document.getElementById('blur');
                blur.classList.toggle('active');
                var popupforgot = document.getElementById('popupforgot');
                popupforgot.classList.toggle('active');
            }
        </script>
</body>

</html>