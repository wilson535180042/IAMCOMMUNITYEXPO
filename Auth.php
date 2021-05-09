<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Auth
{
    private $db;
    private $errormsg;

    function __construct($dbconn)
    {
        $this->db = $dbconn;
        session_start();
    }

    public function register($email, $password, $first, $last, $phone, $gender, $date)
    {
        try {
            $sql1 = "SELECT * FROM `user` WHERE `email`=?;";
            $prep = $this->db->prepare($sql1);
            $prep->execute([$email]);
            $res = $prep->fetch(PDO::FETCH_ASSOC);
            if ($res != false) {
                $this->errormsg = "Email sudah digunakan!";
                return false;
                die;
            }

            $hashpw = password_hash($password, PASSWORD_DEFAULT);
            $code = random_int(1000000, 9999999);
            $hashcode = password_hash($code, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `tempuser` (`no`, `email`, `password`, `first_name`,`last_name`,`phone`,`gender`,`birth_date`,`role`,`kode`) VALUES (NULL, ?, ?,?,?,?,?,?, '1', ?);";
            $this->db->prepare($sql)->execute([$email, $hashpw, $first, $last, $phone, $gender, $date, $hashcode]);
            $this->errormsg = "Akun berhasil dibuat! <br> Silahkan cek email untuk verifikasi.";
            $this->sendMail($email, $hashcode);
            $this->errormsg = "Silahkan cek email anda untuk verifikasi";
            return true;
        } catch (PDOException $error) {
            if ($error->errorInfo[0] == 23000) {
                $this->errormsg = "Email sudah digunakan!";
                return false;
            } else {
                $this->errormsg = $error->getMessage();
                return false;
            }
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM user WHERE email = ?";
            $prep = $this->db->prepare($sql);
            $prep->execute([$email]);
            $res = $prep->fetch(PDO::FETCH_ASSOC);
            if ($prep->rowCount() > 0) {
                if (password_verify($password, $res['password'])) {
                    $_SESSION['userid'] = $res['no'];
                    return true;
                } else {
                    $this->errormsg = "Email atau Password Salah!";
                    return false;
                }
            } else {
                try {
                    $sql2 = "SELECT * FROM `tempuser` WHERE email = ?";
                    $prep2 = $this->db->prepare($sql2);
                    $prep2->execute([$email]);
                    if ($prep2->rowCount() > 0) {
                        $this->errormsg = "Akun belum diverifikasi, cek email untuk verifikasi.";
                        return false;
                    }
                    $this->errormsg = "Email atau Password Salah!";
                    return false;
                } catch (PDOException $error) {
                    $this->errormsg = $error->getMessage();
                    return false;
                }
            }
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function isLogged()
    {
        if (isset($_SESSION['userid'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfile()
    {
        if (!$this->isLogged()) {
            return false;
        }
        try {
            $user = $_SESSION['userid'];
            $sql = "SELECT * FROM `user` WHERE no = ?";
            $exec = $this->db->prepare($sql);
            $exec->execute([$user]);
            $res = $exec->fetch(PDO::FETCH_ASSOC);
            if ($res['role'] == 2) {
                $res['role'] = "Premium";
            } else {
                $res['role'] = "Free";
            }
            return $res;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return true;
    }

    public function getError()
    {
        return $this->errormsg;
    }

    public function changeRole()
    {
        if (!$this->isLogged()) {
            return false;
        }
        try {
            $userid = $_SESSION['userid'];
            $profile = $this->getProfile();
            $role = $profile['role'];
            if ($role == "Premium") {
                $newrole = 1;
            } else {
                $newrole = 2;
            }
            $sql = "UPDATE `user` SET `role`= ? WHERE `no` = ?";
            $this->db->prepare($sql)->execute([$newrole, $userid]);
            return true;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    private function sendMail($rec_email, $code)
    {
        $mail = new PHPMailer(true);
        $urlcode = urlencode($code);
        $url = "http://" . $_SERVER['SERVER_NAME'] . "/contohexpo/verifyemail.php?hc=" . $urlcode;

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'mail.iamcommunity.co.id';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mail@iamcommunity.co.id';
            $mail->Password   = '1(NEB+Q^uowN';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->setFrom('mail@iamcommunity.co.id', 'I Am Community');
            $mail->addAddress($rec_email);

            ini_set('max_execution_time', 120);
            $mail->isHTML(true);
            $mail->Subject = "Verifikasi email kamu untuk melanjutkan pendaftaran.";
            $mail->Body = "<!DOCTYPE html>
            <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
            <head>
                <meta charset='utf-8'> 
                <meta name='viewport' content='width=device-width'> 
                <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
                <meta name='x-apple-disable-message-reformatting'>  
                <title></title> 
            
                <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>
            
                
                <style>
            
                    /* What it does: Remove spaces around the email design added by some email clients. */
                    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                    html,
            body {
                margin: 0 auto  ;
                padding: 0  ;
                height: 100%  ;
                width: 100%  ;
                background: #f1f1f1;
            }
            
            /* What it does: Stops email clients resizing small text. */
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }
            
            /* What it does: Centers email on Android 4.4 */
            div[style*='margin: 16px 0'] {
                margin: 0  ;
            }
            
            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt  ;
                mso-table-rspace: 0pt  ;
            }
            
            /* What it does: Fixes webkit padding issue. */
            table {
                border-spacing: 0  ;
                border-collapse: collapse  ;
                table-layout: fixed  ;
                margin: 0 auto  ;
            }
            
            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode:bicubic;
            }
            
            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
            a {
                text-decoration: none;
            }
            
            /* What it does: A work-around for email clients meddling in triggered links. */
            *[x-apple-data-detectors],  /* iOS */
            .unstyle-auto-detected-links *,
            .aBn {
                border-bottom: 0  ;
                cursor: default  ;
                color: inherit  ;
                text-decoration: none  ;
                font-size: inherit  ;
                font-family: inherit  ;
                font-weight: inherit  ;
                line-height: inherit  ;
            }
            
            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
            .a6S {
                display: none  ;
                opacity: 0.01  ;
            }
            
            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
            .im {
                color: inherit  ;
            }
            
            /* If the above doesn't work, add a .g-img class to any image in question. */
            img.g-img + div {
                display: none  ;
            }
            
            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you'd like to fix */
            
            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u ~ div .email-container {
                    min-width: 320px  ;
                }
            }
            /* iPhone 6, 6S, 7, 8, and X */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u ~ div .email-container {
                    min-width: 375px  ;
                }
            }
            /* iPhone 6+, 7+, and 8+ */
            @media only screen and (min-device-width: 414px) {
                u ~ div .email-container {
                    min-width: 414px  ;
                }
            }
            
                </style>
            
                
            
                
                <style>
            
                    .primary{
                background: #30e3ca;
            }
            .bg_white{
                background: #ffffff;
            }
            .bg_light{
                background: #fafafa;
            }
            .bg_black{
                background: #000000;
            }
            .bg_dark{
                background: rgba(0,0,0,.8);
            }
            .email-section{
                padding:2.5em;
            }
            
            /*BUTTON*/
            .btn{
                padding: 10px 15px;
                display: inline-block;
            }
            .btn.btn-primary{
                border-radius: 5px;
                background: #30e3ca;
                color: #ffffff;
            }
            .btn.btn-white{
                border-radius: 5px;
                background: #ffffff;
                color: #000000;
            }
            .btn.btn-white-outline{
                border-radius: 5px;
                background: transparent;
                border: 1px solid #fff;
                color: #fff;
            }
            .btn.btn-black-outline{
                border-radius: 0px;
                background: transparent;
                border: 2px solid #000;
                color: #000;
                font-weight: 700;
            }
            
            h1,h2,h3,h4,h5,h6{
                font-family: 'Lato', sans-serif;
                color: #000000;
                margin-top: 0;
                font-weight: 400;
            }
            
            body{
                font-family: 'Lato', sans-serif;
                font-weight: 400;
                font-size: 15px;
                line-height: 1.8;
                color: rgba(0,0,0,.4);
            }
            
            a{
                color: #30e3ca;
            }
            
            table{
            }
            /*LOGO*/
            
            .logo h1{
                margin: 0;
            }
            .logo h1 a{
                color: #30e3ca;
                font-size: 24px;
                font-weight: 700;
                font-family: 'Lato', sans-serif;
            }
            
            /*HERO*/
            .hero{
                position: relative;
                z-index: 0;
            }
            
            .hero .text{
                color: rgba(0,0,0,.3);
            }
            .hero .text h2{
                color: #000;
                font-size: 40px;
                margin-bottom: 0;
                font-weight: 400;
                line-height: 1.4;
            }
            .hero .text h3{
                font-size: 24px;
                font-weight: 300;
            }
            .hero .text h2 span{
                font-weight: 600;
                color: #30e3ca;
            }
            
            
            /*HEADING SECTION*/
            .heading-section{
            }
            .heading-section h2{
                color: #000000;
                font-size: 28px;
                margin-top: 0;
                line-height: 1.4;
                font-weight: 400;
            }
            .heading-section .subheading{
                margin-bottom: 20px  ;
                display: inline-block;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: rgba(0,0,0,.4);
                position: relative;
            }
            .heading-section .subheading::after{
                position: absolute;
                left: 0;
                right: 0;
                bottom: -10px;
                content: '';
                width: 100%;
                height: 2px;
                background: #30e3ca;
                margin: 0 auto;
            }
            
            .heading-section-white{
                color: rgba(255,255,255,.8);
            }
            .heading-section-white h2{
                font-family: 
                line-height: 1;
                padding-bottom: 0;
            }
            .heading-section-white h2{
                color: #ffffff;
            }
            .heading-section-white .subheading{
                margin-bottom: 0;
                display: inline-block;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: rgba(255,255,255,.4);
            }
            
            
            ul.social{
                padding: 0;
            }
            ul.social li{
                display: inline-block;
                margin-right: 10px;
            }
            
            /*FOOTER*/
            
            .footer{
                border-top: 1px solid rgba(0,0,0,.05);
                color: rgba(0,0,0,.5);
            }
            .footer .heading{
                color: #000;
                font-size: 20px;
            }
            .footer ul{
                margin: 0;
                padding: 0;
            }
            .footer ul li{
                list-style: none;
                margin-bottom: 10px;
            }
            .footer ul li a{
                color: rgba(0,0,0,1);
            }
            
            
            @media screen and (max-width: 500px) {
            
            
            }
            
            
                </style>
            
            
            </head>
            
            <body width='100%' style='margin: 0 auto  ;padding: 0  ;mso-line-height-rule: exactly;background-color: #f1f1f1;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #f1f1f1;font-family: 'Lato', sans-serif;font-weight: 400;font-size: 15px;line-height: 1.8;color: rgba(0,0,0,.4);height: 100%  ;width: 100%  ;'>
                            
                            <div style='display: none;font-size: 1px;max-height: 0px;max-width: 0px;opacity: 0;overflow: hidden;mso-hide: all;font-family: sans-serif;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                              ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ 
                            </div>
                            
            
                              <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='max-width: 600px;margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;'>
                                  <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td valign='top' class='email-section' class='bg_black style='max-width: 600px; padding: 1em 2.5em 0 2.5em;' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #000000;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                          <tr style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                              <td class='logo' style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                <img src='http://drive.google.com/uc?id=1e3I35a5vDDapP2it7iuPCULIZxC0ofPG' alt='img' title='logo' style='width: 150px;max-width: 300px;height: auto;margin: auto;display: block;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;'>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                                  </tr>
                                  <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td class='email-section' valign='middle' class='hero bg-gold1' style='max-width: 600px;padding: 3em 0 1em 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #EBD37B;position: relative;z-index: 0;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <td class='logo' style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <img src='http://drive.google.com/uc?id=1SNfKnLpJuNVGivLFnslsHGZ7ZFFGtyeQ' alt='' style='width: 200px;max-width: 400px;height: auto;margin: auto;display: block;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;text-align:center'>
                                    </td>
                                    </tr>
                                    </table>
                                  
                                  </td>
                                  </tr>
                                 
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td class='email-section' valign='middle' class='hero bg-gold1' style='max-width: 600px;padding: 2em 0 0 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #EBD37B;position: relative;z-index: 0;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <table style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <td style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                <div class='text' style='max-width: 600px;padding: 0 4em; text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: rgba(0,0,0,.3);'>
                                                    <h2 class='text2' style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Tahoma;font-weight: bold;color: #192331  ;margin-top: 0;font-size: 40px;margin-bottom: 0;line-height: 1.4;'>Verifikasi Email</h2>
                                                    <h4 class='text2' style='margin-top: 15px;font-weight: bold;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Tahoma  ;color: #192331  ;'>Hi youngvestor, selangkah lagi menuju career expo 2021. Cukup klik tombol dibawah ini untuk verifikasi email kamu</h4>
                                                    <p style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><a href='$url' class='btn btn-primary' style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #ffffff;padding: 10px 15px;display: inline-block;border-radius: 5px;background: #192331;font-family: Tahoma  ;'>Verifikasi</a></p>
                                                    <br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class='bg-gold2' style='max-width: 600px;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F6E9BC;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <td class='email-section' style='max-width:600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                <div class='text' style='max-width: 600px;padding: 2em 2.5em;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: rgba(0,0,0,.3);'>
                                                    <h4 class='text3' style='font-weight: bold;margin-bottom: 1em  ;font-family: Lato ;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #5e4b06  ;margin-top: 0;'>Tombol diatas tidak berfungsi?</h4>
                                                    <p class='text3' style='margin-top: 15px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #5e4b06 ;'>Klik atau salin link dibawah ini untuk verifikasi email kamu <br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'> $url</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                  </td>
                                  </tr>
                              
                              </table>
                              <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='max-width: 600px;margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;'>
                                  <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td valign='middle' class='bg_black footer email-section' style='max-width: 600px;padding-top: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #000000;padding: 2.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <table style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <td valign='top' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                          <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                              <td style='max-width: 600px;text-align: center;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                  <h3 class='heading' style='color: white;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Roboto, sans-serif ;font-weight: bold;margin-top: 0;font-size: 20px;'>Our Partner</h3>
                                                  <a style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #30e3ca;font-family: Tahoma  ;'><img style='margin: 0 1em 0 1em;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;' width='100' height='100' src='http://iamcommunity.co.id/wp-content/uploads/2021/01/IntilandLogo-White-PNG-1024x884-1.png?w=320&ssl=1'></a>
                                                  <a style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #30e3ca;font-family: Tahoma  ;'><img style='margin: 0 1em 0 1em;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;' width='100' height='100' src='http://iamcommunity.co.id/wp-content/uploads/2021/01/LOGO-ESTATOR-01-white-1024x682-1.png?resize=300%2C263&ssl=1'></a>
                                                  <a style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #30e3ca;font-family: Tahoma  ;'><img style='margin: 0 1em 0 1em;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;' width='100' height='100' src='http://iamcommunity.co.id/wp-content/uploads/2020/12/I-AM-Talent-Pool-Putih-Transparan.png?w=395&h=395&crop=1&ssl=1'></a>
                                              </td>
                                            </tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <td style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                    <h3 class='heading' style='color: white;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Roboto, sans-serif;font-weight: bold;margin-top: 0;font-size: 20px;'>Contact Us</h3>
                                                </td>
                                            </tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <td style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                    <p style='color: white;margin-top: -10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        Intiland Tower 2nd Floor <br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        Jl. Jenderal Sudirman 32 Jakarta 10220, Indonesia<br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        investoranakmuda@gmail.com
                                                    </p>
                                                </td>
                                                
                                            </tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><td style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'><hr style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'></td></tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <td style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                    <span style='color: white;font-weight: 400;font-size: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        Copyright © 2021 I AM Community | Powered by I AM Community
                                                    </span>
                                                </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                
                              </table>
                        
                            
                        </body>
            </html>";
            $mail->AltBody = 'Hi Youngvestor! Untuk verifikasi email kamu, silahkan klik link berikut: ' . $url;
            $mail->send();


            return true;
        } catch (Exception $e) {
            $this->errormsg = $mail->ErrorInfo;
            return false;
        }
    }

    public function verify($hashcode)
    {
        if ($hashcode == false) {
            $this->errormsg = "Maaf kode verifikasi salah.";
        } else {
            try {
                $hash = urldecode($hashcode);
                $sql = "SELECT * FROM `tempuser` WHERE `kode`= ?;";
                $prep = $this->db->prepare($sql);
                $prep->execute([$hash]);
                $res = $prep->fetch(PDO::FETCH_ASSOC);
                if ($res != false) {
                    try {
                        $sql2 = "DELETE FROM `tempuser` WHERE `kode` = ?";
                        $prep2 = $this->db->prepare($sql2);
                        $prep2->execute([$hash]);
                    } catch (PDOException $error) {
                        $this->errormsg = $error->getMessage();
                        return false;
                    }
                    try {
                        $sql3 = "INSERT INTO `user` (`no`, `email`, `password`,`first_name`,`last_name`,`phone`,`gender`,`birth_date`,`role`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, '1');";
                        $email = $res['email'];
                        $password = $res['password'];
                        $first = $res['first_name'];
                        $last = $res['last_name'];
                        $phone = $res['phone'];
                        $gender = $res['gender'];
                        $date = $res['birth_date'];
                        $this->db->prepare($sql3)->execute([$email, $password, $first, $last, $phone, $gender, $date]);
                    } catch (PDOException $error) {
                        $this->errormsg = $error->getMessage();
                        echo ($error->getMessage());
                        die;
                        return false;
                    }
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $error) {
                if ($error->errorInfo[0] == 23000) {
                    $this->errormsg = "Email sudah digunakan!";
                    return false;
                } else {
                    $this->errormsg = $error->getMessage();
                    return false;
                }
            }
        }
    }

    public function getloker($userid)
    {
        $nouser = intval($userid);
        try {
            $sql = "SELECT * FROM `perusahaan`;";
            $prep = $this->db->prepare($sql);
            $prep->execute();
            $res = $prep->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $row) {
                $no = intval($row['no']);
                $data[$no] = $row;
                $sql2 = "SELECT * FROM `loker` WHERE `no_perusahaan`= ?;";
                $prep2 = $this->db->prepare($sql2);
                $prep2->execute([$no]);
                $res2 = $prep2->fetchAll(PDO::FETCH_ASSOC);
                foreach ($res2 as $row2) {
                    $no2 = intval($row2['no']);

                    $res2 = $prep2->fetchAll(PDO::FETCH_ASSOC);
                    $data[$no]['loker'][$no2] = $row2;

                    $sql3 = "SELECT * FROM `bookmark` WHERE `no_user`= ? AND `no_loker`= ?;";
                    $prep3 = $this->db->prepare($sql3);
                    $prep3->execute([$nouser, $no2]);
                    $res3 = $prep3->fetch(PDO::FETCH_ASSOC);
                    if ($res3 != false) {
                        $data[$no]['loker'][$no2]['bookmarked'] = true;
                    } else {
                        $data[$no]['loker'][$no2]['bookmarked'] = false;
                    }
                }
            }

            return $data;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function bookmark($userid, $lokerid)
    {
        $nouser = intval($userid);
        $noloker = intval($lokerid);
        try {
            $sql = "INSERT INTO `bookmark` (`no`, `no_user`, `no_loker`) VALUES (NULL, ?, ?);";
            $this->db->prepare($sql)->execute([$nouser, $noloker]);
            $this->errormsg = "Bookmark Sukses";
            return true;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function getBookmark($userid)
    {
        $nouser = intval($userid);
        try {
            $sql = "SELECT * FROM `bookmark` WHERE `no_user`= ?";
            $prep = $this->db->prepare($sql);
            $prep->execute([$nouser]);
            $res = $prep->fetchAll(PDO::FETCH_ASSOC);

            foreach ($res as $row) {
                $noloker = $row['no_loker'];
                $sql2 = "SELECT `loker`.`no`,`loker`.`divisi`,`loker`.`keterangan`,`loker`.`no_perusahaan`,`perusahaan`.`nama_perusahaan` FROM `loker` INNER JOIN `perusahaan` ON `loker`.`no_perusahaan`=`perusahaan`.`no` WHERE `loker`.`no` = ?";
                $prep2 = $this->db->prepare($sql2);
                $prep2->execute([$noloker]);
                $res2 = $prep2->fetch(PDO::FETCH_ASSOC);
                $data[$noloker] = $res2;
            }
            if (isset($data)) {
                return $data;
            } else {
                return false;
            }
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    private function mailReset($email, $kode)
    {
        $mail = new PHPMailer(true);
        $urlcode = urlencode($kode);
        $url = "http://" . $_SERVER['SERVER_NAME'] . "/contohexpo/resetpassword.php?hc=" . $urlcode;

        try {
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'mail.iamcommunity.co.id';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mail@iamcommunity.co.id';
            $mail->Password   = '1(NEB+Q^uowN';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->setFrom('mail@iamcommunity.co.id', 'I Am Community');
            $mail->addAddress($email);

            ini_set('max_execution_time', 120);
            $mail->isHTML(true);
            $mail->Subject = "Permintaan Reset Password";
            $mail->Body = "<!DOCTYPE html>
            <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
            <head>
                <meta charset='utf-8'> 
                <meta name='viewport' content='width=device-width'> 
                <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
                <meta name='x-apple-disable-message-reformatting'>  
                <title></title> 
            
                <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>
            
                
                <style>
            
                    /* What it does: Remove spaces around the email design added by some email clients. */
                    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                    html,
            body {
                margin: 0 auto  ;
                padding: 0  ;
                height: 100%  ;
                width: 100%  ;
                background: #f1f1f1;
            }
            
            /* What it does: Stops email clients resizing small text. */
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }
            
            /* What it does: Centers email on Android 4.4 */
            div[style*='margin: 16px 0'] {
                margin: 0  ;
            }
            
            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt  ;
                mso-table-rspace: 0pt  ;
            }
            
            /* What it does: Fixes webkit padding issue. */
            table {
                border-spacing: 0  ;
                border-collapse: collapse  ;
                table-layout: fixed  ;
                margin: 0 auto  ;
            }
            
            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode:bicubic;
            }
            
            /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
            a {
                text-decoration: none;
            }
            
            /* What it does: A work-around for email clients meddling in triggered links. */
            *[x-apple-data-detectors],  /* iOS */
            .unstyle-auto-detected-links *,
            .aBn {
                border-bottom: 0  ;
                cursor: default  ;
                color: inherit  ;
                text-decoration: none  ;
                font-size: inherit  ;
                font-family: inherit  ;
                font-weight: inherit  ;
                line-height: inherit  ;
            }
            
            /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
            .a6S {
                display: none  ;
                opacity: 0.01  ;
            }
            
            /* What it does: Prevents Gmail from changing the text color in conversation threads. */
            .im {
                color: inherit  ;
            }
            
            /* If the above doesn't work, add a .g-img class to any image in question. */
            img.g-img + div {
                display: none  ;
            }
            
            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you'd like to fix */
            
            /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u ~ div .email-container {
                    min-width: 320px  ;
                }
            }
            /* iPhone 6, 6S, 7, 8, and X */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u ~ div .email-container {
                    min-width: 375px  ;
                }
            }
            /* iPhone 6+, 7+, and 8+ */
            @media only screen and (min-device-width: 414px) {
                u ~ div .email-container {
                    min-width: 414px  ;
                }
            }
            
                </style>
            
                
            
                
                <style>
            
                    .primary{
                background: #30e3ca;
            }
            .bg_white{
                background: #ffffff;
            }
            .bg_light{
                background: #fafafa;
            }
            .bg_black{
                background: #000000;
            }
            .bg_dark{
                background: rgba(0,0,0,.8);
            }
            .email-section{
                padding:2.5em;
            }
            
            /*BUTTON*/
            .btn{
                padding: 10px 15px;
                display: inline-block;
            }
            .btn.btn-primary{
                border-radius: 5px;
                background: #30e3ca;
                color: #ffffff;
            }
            .btn.btn-white{
                border-radius: 5px;
                background: #ffffff;
                color: #000000;
            }
            .btn.btn-white-outline{
                border-radius: 5px;
                background: transparent;
                border: 1px solid #fff;
                color: #fff;
            }
            .btn.btn-black-outline{
                border-radius: 0px;
                background: transparent;
                border: 2px solid #000;
                color: #000;
                font-weight: 700;
            }
            
            h1,h2,h3,h4,h5,h6{
                font-family: 'Lato', sans-serif;
                color: #000000;
                margin-top: 0;
                font-weight: 400;
            }
            
            body{
                font-family: 'Lato', sans-serif;
                font-weight: 400;
                font-size: 15px;
                line-height: 1.8;
                color: rgba(0,0,0,.4);
            }
            
            a{
                color: #30e3ca;
            }
            
            table{
            }
            /*LOGO*/
            
            .logo h1{
                margin: 0;
            }
            .logo h1 a{
                color: #30e3ca;
                font-size: 24px;
                font-weight: 700;
                font-family: 'Lato', sans-serif;
            }
            
            /*HERO*/
            .hero{
                position: relative;
                z-index: 0;
            }
            
            .hero .text{
                color: rgba(0,0,0,.3);
            }
            .hero .text h2{
                color: #000;
                font-size: 40px;
                margin-bottom: 0;
                font-weight: 400;
                line-height: 1.4;
            }
            .hero .text h3{
                font-size: 24px;
                font-weight: 300;
            }
            .hero .text h2 span{
                font-weight: 600;
                color: #30e3ca;
            }
            
            
            /*HEADING SECTION*/
            .heading-section{
            }
            .heading-section h2{
                color: #000000;
                font-size: 28px;
                margin-top: 0;
                line-height: 1.4;
                font-weight: 400;
            }
            .heading-section .subheading{
                margin-bottom: 20px  ;
                display: inline-block;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: rgba(0,0,0,.4);
                position: relative;
            }
            .heading-section .subheading::after{
                position: absolute;
                left: 0;
                right: 0;
                bottom: -10px;
                content: '';
                width: 100%;
                height: 2px;
                background: #30e3ca;
                margin: 0 auto;
            }
            
            .heading-section-white{
                color: rgba(255,255,255,.8);
            }
            .heading-section-white h2{
                font-family: 
                line-height: 1;
                padding-bottom: 0;
            }
            .heading-section-white h2{
                color: #ffffff;
            }
            .heading-section-white .subheading{
                margin-bottom: 0;
                display: inline-block;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: rgba(255,255,255,.4);
            }
            
            
            ul.social{
                padding: 0;
            }
            ul.social li{
                display: inline-block;
                margin-right: 10px;
            }
            
            /*FOOTER*/
            
            .footer{
                border-top: 1px solid rgba(0,0,0,.05);
                color: rgba(0,0,0,.5);
            }
            .footer .heading{
                color: #000;
                font-size: 20px;
            }
            .footer ul{
                margin: 0;
                padding: 0;
            }
            .footer ul li{
                list-style: none;
                margin-bottom: 10px;
            }
            .footer ul li a{
                color: rgba(0,0,0,1);
            }
            
            
            @media screen and (max-width: 500px) {
            
            
            }
            
            
                </style>
            
            
            </head>
            
            <body width='100%' style='margin: 0 auto  ;padding: 0  ;mso-line-height-rule: exactly;background-color: #f1f1f1;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #f1f1f1;font-family: 'Lato', sans-serif;font-weight: 400;font-size: 15px;line-height: 1.8;color: rgba(0,0,0,.4);height: 100%  ;width: 100%  ;'>
                            
                            <div style='display: none;font-size: 1px;max-height: 0px;max-width: 0px;opacity: 0;overflow: hidden;mso-hide: all;font-family: sans-serif;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                              ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ 
                            </div>
                            
            
                              <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='max-width: 600px;margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;'>
                                  <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td valign='top' class='email-section' class='bg_black style='max-width: 600px; padding: 1em 2.5em 0 2.5em;' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #000000;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                          <tr style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                              <td class='logo' style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                <img src='http://drive.google.com/uc?id=1e3I35a5vDDapP2it7iuPCULIZxC0ofPG' alt='img' title='logo' style='width: 150px;max-width: 300px;height: auto;margin: auto;display: block;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;'>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                                  </tr>
                                  <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td class='email-section' valign='middle' class='hero bg-gold1' style='max-width: 600px;padding: 3em 0 1em 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #EBD37B;position: relative;z-index: 0;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <td class='logo' style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <img src='http://drive.google.com/uc?id=1yi-aA69fdWHZmeb9odoEzUHwjKsZsqzx' alt='' style='width: 200px;max-width: 400px;height: auto;margin: auto;display: block;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;text-align:center'>
                                    </td>
                                    </tr>
                                    </table>
                                  
                                  </td>
                                  </tr>
                                 
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td class='email-section' valign='middle' class='hero bg-gold1' style='max-width: 600px;padding: 2em 0 0 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #EBD37B;position: relative;z-index: 0;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <table style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <td style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                <div class='text' style='max-width: 600px;padding: 0 4em; text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: rgba(0,0,0,.3);'>
                                                    <h2 class='text2' style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Tahoma;font-weight: bold;color: #192331  ;margin-top: 0;font-size: 40px;margin-bottom: 0;line-height: 1.4;'>Reset Password</h2>
                                                    <h4 class='text2' style='margin-top: 15px;font-weight: bold;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Tahoma  ;color: #192331  ;'>Hi youngvestor, silahkan klik tombol dibawah untuk reset password kamu</h4>
                                                    <p style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><a href='$url' class='btn btn-primary' style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #ffffff;padding: 10px 15px;display: inline-block;border-radius: 5px;background: #192331;font-family: Tahoma  ;'>Reset Password</a></p>
                                                    <br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class='bg-gold2' style='max-width: 600px;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F6E9BC;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                            <td class='email-section' style='max-width:600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                <div class='text' style='max-width: 600px;padding: 2em 2.5em;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: rgba(0,0,0,.3);'>
                                                    <h4 class='text3' style='font-weight: bold;margin-bottom: 1em  ;font-family: Lato ;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #5e4b06  ;margin-top: 0;'>Tombol diatas tidak berfungsi?</h4>
                                                    <p class='text3' style='margin-top: 15px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #5e4b06 ;'>Klik atau salin link dibawah ini untuk reset password kamu <br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'> $url</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                  </td>
                                  </tr>
                              
                              </table>
                              <table align='center' role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='max-width: 600px;margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;'>
                                  <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                  <td valign='middle' class='bg_black footer email-section' style='max-width: 600px;padding-top: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #000000;padding: 2.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                    <table style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                        <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                        <td valign='top' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                          <table role='presentation' cellspacing='0' cellpadding='0' border='0' width='100%' style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;border-spacing: 0  ;border-collapse: collapse  ;table-layout: fixed  ;margin: 0 auto  ;'>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                              <td style='max-width: 600px;text-align: center;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                  <h3 class='heading' style='color: white;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Roboto, sans-serif ;font-weight: bold;margin-top: 0;font-size: 20px;'>Our Partner</h3>
                                                  <a style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #30e3ca;font-family: Tahoma  ;'><img style='margin: 0 1em 0 1em;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;' width='100' height='100' src='http://iamcommunity.co.id/wp-content/uploads/2021/01/IntilandLogo-White-PNG-1024x884-1.png?w=320&ssl=1'></a>
                                                  <a style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #30e3ca;font-family: Tahoma  ;'><img style='margin: 0 1em 0 1em;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;' width='100' height='100' src='http://iamcommunity.co.id/wp-content/uploads/2021/01/LOGO-ESTATOR-01-white-1024x682-1.png?resize=300%2C263&ssl=1'></a>
                                                  <a style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;text-decoration: none;color: #30e3ca;font-family: Tahoma  ;'><img style='margin: 0 1em 0 1em;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;' width='100' height='100' src='http://iamcommunity.co.id/wp-content/uploads/2020/12/I-AM-Talent-Pool-Putih-Transparan.png?w=395&h=395&crop=1&ssl=1'></a>
                                              </td>
                                            </tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <td style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                    <h3 class='heading' style='color: white;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: Roboto, sans-serif;font-weight: bold;margin-top: 0;font-size: 20px;'>Contact Us</h3>
                                                </td>
                                            </tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <td style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                    <p style='color: white;margin-top: -10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        Intiland Tower 2nd Floor <br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        Jl. Jenderal Sudirman 32 Jakarta 10220, Indonesia<br style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        investoranakmuda@gmail.com
                                                    </p>
                                                </td>
                                                
                                            </tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'><td style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'><hr style='-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'></td></tr>
                                            <tr style='max-width: 600px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                <td style='max-width: 600px;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt  ;mso-table-rspace: 0pt  ;'>
                                                    <span style='color: white;font-weight: 400;font-size: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
                                                        Copyright © 2021 I AM Community | Powered by I AM Community
                                                    </span>
                                                </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                
                              </table>
                        
                            
                        </body>
            </html>";
            $mail->AltBody = 'Hi Youngvestor! Untuk reset password kamu, silahkan salin link berikut: ' . $url;
            $mail->send();


            return true;
        } catch (Exception $e) {
            $this->errormsg = $mail->ErrorInfo;
            return false;
        }
    }

    public function requestForgot($email)
    {
        try {
            $sql = "SELECT * FROM `user` WHERE `email`= ?";
            $prep = $this->db->prepare($sql);
            $prep->execute([$email]);
            $res = $prep->fetch(PDO::FETCH_ASSOC);

            if ($res != false) {
                $rand = rand(100000, 999999);
                $kode = password_hash($rand, PASSWORD_DEFAULT);
                try {
                    $sql2 = "INSERT INTO `requestforgot` (`no`, `email`, `kode`) VALUES (NULL, ?, ?);";
                    $this->db->prepare($sql2)->execute([$email, $kode]);
                    if ($this->mailReset($email, $kode)) {
                        $this->errormsg = "Berhasil, silahkan cek email anda untuk reset password";
                        return true;
                    } else {
                        $this->errormsg = "Gagal reset password";
                        return false;
                    }
                } catch (PDOException $error) {
                    if ($error->errorInfo[0] == 23000) {
                        $sql3 = "SELECT * FROM `requestforgot` WHERE `email` = ?";
                        $prep2 = $this->db->prepare($sql3);
                        $prep2->execute([$email]);
                        $res2 = $prep2->fetch(PDO::FETCH_ASSOC);
                        if ($res2 != false) {
                            if ($this->mailReset($email, $kode)) {
                                $this->errormsg = "Berhasil, silahkan cek email anda untuk reset password";
                                return true;
                            } else {
                                $this->errormsg = "Gagal reset password";
                                return false;
                            }
                        } else {
                            $this->errormsg = "Gagal reset password";
                            return false;
                        }
                    } else {
                        $this->errormsg = $error->getMessage();
                        return false;
                    }
                }
            } else {
                $this->errormsg = "Email belum terdaftar";
                return false;
            }
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function checkReset($kode)
    {
        try {
            $kode = urldecode($kode);
            $sql2 = "SELECT * FROM `requestforgot` WHERE kode = ?";
            $prep = $this->db->prepare($sql2);
            $prep->execute([$kode]);
            $res = $prep->fetch(PDO::FETCH_ASSOC);
            $email = $res['email'];
            return $email;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function resetPassword($newpassword, $email)
    {
        try {
            $newpass = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql2 = "UPDATE `user` SET `password`=? WHERE `email` = ?";
            $this->db->prepare($sql2)->execute([$newpass, $email]);

            $sql3 = "DELETE FROM `requestforgot` WHERE `email` = ?";
            $this->db->prepare($sql3)->execute([$email]);
            return true;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }

    public function removeBookmark($userid, $lokerid)
    {
        $nouser = intval($userid);
        $noloker = intval($lokerid);
        try {
            $sql = "DELETE FROM `bookmark` WHERE `no_user`=? AND `no_loker`=?";
            $this->db->prepare($sql)->execute([$nouser, $noloker]);
            $this->errormsg = "Berhasil hapus bookmark";
            return true;
        } catch (PDOException $error) {
            $this->errormsg = $error->getMessage();
            return false;
        }
    }
}
