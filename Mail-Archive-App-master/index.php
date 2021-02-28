<?php
session_start();

$hak = $_SESSION['hak'];

if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}
switch ($hak) {
    case 'admin':
        header("location: $hak/index.php");
        break;

    case 'petugas':
        header("location: $hak/index.php");
        break;
}
