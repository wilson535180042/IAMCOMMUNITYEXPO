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
header("location: http://localhost/contohexpo/");
