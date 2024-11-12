<?php
require_once '../modelos/Usuario.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function getUser ById($id) {
        return $this->userModel->getUser ById($id);
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}