<?php
require_once "db.php";
if ($user->isLogged()) {
    header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO/landinglogin.php");
}
if (isset($_POST['regist'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first = $_POST['first'];
    $gender = $_POST['gender'];
    $last = $_POST['last'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];

    $regist = $user->register($email, $password, $first, $last, $phone, $gender, $date);
    if ($regist == true) {
        $ertype = "regist_true";
    } else {
        $ertype = "regist_failed";
    }
    $error = $user->getError();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($user->login($email, $password)) {
        header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO/afterlogin.php");
    } else {
        $error = $user->getError();
        $ertype = "login";
    }
}

if (isset($_SESSION['tempmsg'])) {
    $msg = $_SESSION['tempmsg'];
    unset($_SESSION['tempmsg']);
}

if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
    $f = $user->requestForgot($email);
    if ($f == false) {
        $ertype = "forgot";
        $error = $user->getError();
    } elseif ($f == true) {
        $ertype = "forgot_true";
        $error = $user->getError();
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
    <link rel="stylesheet" href="css/stylesheet.css">
    <!--bootsrap login-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-cut.css">
    <!--pop up javascript-->
    <script defer src="js/index.js"></script>
    <script defer src="js/checkpw.js"></script>
</head>

<body>
    <?php if (isset($ertype) && $ertype == "login") {

    ?>
        <div class="alert alert-danger">
            <strong>Login Gagal!</strong> <?= $error; ?>
        </div>
    <?php } ?>

    <?php if (isset($ertype) && $ertype == "regist_failed") {

    ?>
        <div class="alert alert-danger">
            <strong>Gagal Registrasi! </strong> <?= $error; ?>
        </div>
    <?php } ?>

    <?php if (isset($ertype) && $ertype == "regist_true") {

    ?>
        <div class="alert alert-warning">
            <strong>Registrasi Berhasil! </strong> <?= $error; ?>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['success'])) {

    ?>
        <div class="alert alert-success">
            <strong>Verifikasi berhasil! </strong> <?= $_SESSION['success']; ?>
        </div>
    <?php unset($_SESSION['success']);
    } ?>

    <?php if (isset($ertype) && $ertype == "forgot") {

    ?>
        <div class="alert alert-danger">
            <strong><?= $error; ?></strong>
        </div>
    <?php } ?>

    <?php if (isset($ertype) && $ertype == "forgot_true") {

    ?>
        <div class="alert alert-warning">
            <strong><?= $error; ?></strong>
        </div>
    <?php } ?>


    <?php if (isset($_SESSION['failed'])) {

    ?>
        <div class="alert alert-danger">
            <strong>Verifikasi gagal! </strong> <?= $_SESSION['failed']; ?>
        </div>
    <?php unset($_SESSION['failed']);
    } ?>
    <!--LANDING-->
    <div class="wrapper1" id="blur">
        <div class="btn-wrapper">
            <button class="btn-login" onclick="toggle(1)" style="border: 0; outline: 0;"></button>
            <button class="btn-mainhall" onclick="toggle(1)" style="border: 0; outline: 0;"></button>
            <button class="btn-register" onclick="toggle(3)" style="border: 0; outline: 0;"></button>
            <button class="btn-i" onclick="toggle(4)" style="border: 0; outline: 0;"></button>
            <button class="btn-toilet" onclick="document.location='toilet.html'" style="border: 0; outline: 0;"></button>
        </div>
    </div>
    <!--LOGIN-->
    <div class="exit" id="popup">
        <button class="btnspecial" id="special" onclick="puggle()" style="border: 0; outline: 0;"></button>
        <div class="popuplogin">
            <div class="logowrapper">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper">
                <h4 class="title"><strong>L O G I N</strong></h4>
                <form class="formlogin" method="POST">
                    <div class="inlineform">
                        <div class="set">
                            <label class="text-white mt-3 mb-3" for="email">Email</label>
                            <input class="form-control1" id="email" type="email" name="email" required>
                        </div>
                        <div class='pw-set'>
                            <label class="text-white mt-3 mb-3" for="password">Password</label>
                            <input class="form-control2" id="password" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="inlineform-buttons">
                        <button type="submit" class="btn1 button" style="border: 0; outline: 0;" name="login">L O G I N</button>
                        <button type="button" class="btn2 button register" onclick="toggle(7)" style="border: 0; outline: 0;">R E G I S T E R</button>
                    </div>
                    <div class="forgot">
                        <a onclick="toggle(8)">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--REGISTER-->
    <div class="exit" id="popupregis">
        <button class="btnspecial" id="special" onclick="puggle()" style="border: 0; outline: 0;"></button>
        <div class="popupregister">
            <div class="logowrapper2">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper2">
                <h4 class="title2"><strong>R E G I S T R A T I O N</strong></h4>
                <form class="formregister" method="POST" onsubmit="return check4()">
                    <div class="inlineform2">
                        <div class="set1 mailset">
                            <label class="text-white mt-3 mb-3" for="email">Email</label>
                            <input class="form-control3" id="email" type="email" name="email" required>
                        </div>
                        <div class='set2'>
                            <label class="text-white mt-3 mb-3" for="password">Password</label>
                            <input class="form-control3" id="password" type="password" name="password" required pattern=".{6,}" title="Input minimal 8 karakter">
                        </div>
                    </div>
                    <div class="inlineform3">
                        <div class="set1">
                            <label class="text-white mt-3 mb-3" for="firstname">First Name</label>
                            <input class="form-control3" id="firstname" type="text" name="first" required>
                        </div>
                        <div class="set2">
                            <label class="text-white mt-3 mb-3" for="lastname">Last Name</label>
                            <input class="form-control3" id="lastname" type="text" name="last" required>
                        </div>
                    </div>
                    <div class="inlineform4">
                        <div class="set1">
                            <label class="text-white mt-3 mb-3" for="phonenumber">Phone Number</label>
                            <input class="form-control3" id="phonenumber" type="number" name="phone" required pattern="[0-9]{3}" title="Mohon hanya masukkan angka">
                        </div>
                        <div class="set2">
                            <label class="text-white mt-3 mb-3">Gender</label>
                            <select class="formcontrol" id="Gender" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="inlineform5">
                        <div class="set1">
                            <label class="text-white mt-3 mb-3" for="dob">Date of Birth</label>
                            <input class="form-control3" id="dob" type="date" name="date">
                        </div>
                        <div class="inlineform2-buttons">
                            <form>
                                <button type="submit" class="btn2 button register" name="regist" style="border: 0; outline: 0;">R E G I S T E R</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!--FORGOT PASSWORD-->
    <div class="exit" id="popupforgot">
        <button class="btnspecial" id="special" onclick="puggle()" style="border: 0; outline: 0;"></button>
        <div class="popupforgot">
            <div class="logowrapper3">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper3">
                <h4 class="title3"><strong>F O R G O T &nbsp; P A S S W O R D</span></strong></h4>
                <form class="formforgot" method="POST">
                    <div class="inlineform6">
                        <div class="set1">
                            <label class="text-white mt-3 mb-3" for="email">Email</label>
                            <input class="form-control4" id="email" name="email" type="email">
                        </div>
                        <div class="inlineform3-buttons">
                            <div class='set3'>
                                <label class="text-white mt-3 mb-3">Kami akan mengirimkan instruksi untuk mereset password, mohon cek email anda</label>
                            </div>
                            <form>
                                <button type="submit" class="btn3 button reset" name="forgot" style="border: 0; outline: 0;">R E S E T &nbsp;P A S S W O R D</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
                    <div class="btn-list" onclick="toggle(9)"></div>
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

    <!--LIST OF COMPANIES-->
    <div class="exit" id="popupcom">
        <button class="btnspecial" id="special" onclick="puggle()" style="border: 0; outline: 0;"></button>
        <div class="popupcompany">
            <div class="logowrapper2">
                <img src='images/logo.png' class='logo'>
                <h1 class="text-white belowlogo">Welcome to Career Expo</h1>
                <p class="text-white belowlogo2">by I AM Community</p>
            </div>
            <div class="formwrapper2">
                <h3 class="title4">INFORMATION</h3>
                <h4 class="title5"><strong>L I S T &nbsp;O F &nbsp;C O M P A N I E S </span></strong></h4>
                <div class="inlineform9">
                    <img class="img-l1" src='images/APL.png'>
                    <img class="img-l2" src='images/SIN.png'>
                    <img class="img-l3" src='images/CTRA.png'>
                    <img class="img-l4" src='images/PWON.png'>
                    <img class="img-l5" src='images/DILD.png'>
                    <img class="img-l6" src='images/SMRA.png'>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>