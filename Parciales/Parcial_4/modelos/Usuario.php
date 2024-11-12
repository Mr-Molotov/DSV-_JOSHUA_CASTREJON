<?php
require_once '../config/config.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public function getUser ById ($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser ($email, $nombre, $google_id) {
        $stmt = $this->db->prepare("INSERT INTO usuarios (email, nombre, google_id) VALUES (?, ?, ?)");
        $stmt->execute([$email, $nombre, $google_id]);
        return $this->db->lastInsertId();
    }

    public function updateUser ($id, $nombre) {
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ? WHERE id = ?");
        $stmt->execute([$nombre, $id]);
    }
}