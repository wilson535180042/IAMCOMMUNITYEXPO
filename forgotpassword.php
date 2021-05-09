<?php
require_once "db.php";
if ($user->isLogged()) {
    header("location: http://localhost/contohexpo/index.php");
}
if (isset($_POST['send'])) {
    $email = $_POST['email'];
    $user->requestForgot($email);
}

$error = $user->getError();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">


                <form class="login100-form validate-form ml-5" method="post">
                    <span class="login100-form-title">
                        Reset Password
                    </span>
                    <?php if (isset($error)) : ?>
                        <div class="message bg-warning pl-2 pr-2">
                            <h6 class="messagetext"><?= $error; ?></h6>
                        </div>
                    <?php endif; ?>


                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="email" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>



                    <div class="container-login100-form-btn">
                        <button type="submit" name="send" class="login100-form-btn">
                            Reset
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script src="js/validate.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>