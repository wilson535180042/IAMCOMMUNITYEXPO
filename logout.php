<?php
require_once "db.php";
$user->logout();
header("Location: https://" . $_SERVER['SERVER_NAME'] . "/IAMCOMMUNITYEXPO/index.php");
