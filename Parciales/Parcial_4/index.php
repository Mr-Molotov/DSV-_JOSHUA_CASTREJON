<?php
session_start();
require_once('../Parcial_4/controladores/AuthController.php');
$auth = new AuthController();

if (isset($_SESSION['access_token'])) {
    header("Location: library.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}