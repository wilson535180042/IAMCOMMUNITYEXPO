<?php
require_once 'db.php';
if (isset($_GET['hc'])) {
    $hc = $_GET['hc'];
    $verify = $user->verify($hc);
    if ($verify == true) {
        $_SESSION['success'] = "Silahkan login kembali.";
    } else {
        $_SESSION['failed'] = "Verifikasi gagal.";
    }
} else {
    $_SESSION['failed'] = "Verifikasi gagal.";
}
header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO");
