<?php
require_once 'db.php';
if (!isset($_GET['hc'])) {
    header("Location: https://" . $_SERVER['SERVER_NAME']);
} else {
    if ($user->checkReset($_GET['hc']) == false) {
        die;
        header("Location: https://" . $_SERVER['SERVER_NAME']);
        exit;
    } else {
        $email = $user->checkReset($_GET['hc']);
    }
}

if (isset($_POST['send'])) {
    $check = $user->resetPassword($_POST['password'], $email);
    if ($check == true) {
        $user->logout();
        session_start();
        $_SESSION['tempmsg'] = "Berhasil ubah password";
        header("Location: https://" . $_SERVER['SERVER_NAME']);
        exit;
    } else {
        $error = "Gagal ubah password";
    }
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
    <link rel="stylesheet" href="css/forgot.css">
    <!--bootsrap login-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-cut.css">
    <!--pop up javascript-->
    <script defer src="js/index.js"></script>
</head>

<body>
    <!--LANDING-->
    <a href="landinglogin.html"><button class="btnspecial" id="special" style="border: 0; outline: 0;"></button></a>
    <div class="wrapper1" id="blur"></div>
    <!--FORGOT PASSWORD-->
    <div class="popupforgot" id="popupforgot">
        <div class="logowrapper3">
            <img src='images/logo.png' class='logo'>
            <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
            <p class="text-white belowlogo2">by I AM Community</p>
        </div>
        <div class="formwrapper3">
            <h4 class="title3"><strong>R E S E T &nbsp; P A S S W O R D</span></strong></h4>
            <form class="formforgot">
                <div class="inlineform6">
                    <div class="set1">
                        <label class="text-white mt-3 mb-3" for="password">New Password</label>
                        <input class="form-control4" id="password" title="Input minimal 8 karakter" required pattern=".{8,}" type="password">
                    </div>
                    <div class="inlineform3-buttons">
                        <form>
                            <button type="submit" name='send' class="btn3 button reset" style="border: 0; outline: 0;">R E S E T &nbsp;P A S S W O R D</button>
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