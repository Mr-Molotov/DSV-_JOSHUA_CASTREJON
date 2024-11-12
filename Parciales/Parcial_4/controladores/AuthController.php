<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

class AuthController {
    private $client;

    public function __construct() {
        $this->client = new Google_Client();
        $this->client->setClientId(GOOGLE_CLIENT_ID);
        $this->client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $this->client->setRedirectUri(GOOGLE_REDIRECT_URI);
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    public function login() {
        $authUrl = $this->client->createAuthUrl();
        header("Location: $authUrl");
        exit();
    }

    public function callback() {
        if (isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $oauth2 = new Google_Service_Oauth2($this->client);
            $userInfo = $oauth2->userinfo->get();

            // Guardar o actualizar el usuario en la base de datos
            $this->saveUser ($userInfo);
            header("Location: library.php");
            exit();
        }
    }

    private function saveUser ($userInfo) {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("INSERT INTO usuarios (email, nombre, google_id) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE nombre = ?");
        $stmt->execute([$userInfo->email, $userInfo->name, $userInfo->id, $userInfo->name]);
        $_SESSION['user_id'] = $db->lastInsertId(); // Guardar el ID del usuario en la sesión
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}