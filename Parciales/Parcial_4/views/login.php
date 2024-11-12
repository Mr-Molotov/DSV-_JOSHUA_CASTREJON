<?php
session_start();
require_once '../controladores/AuthController.php';
$auth = new AuthController();
$auth->login();