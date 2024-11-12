<?php
require_once '../config/config.php';

class Book {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public function saveBook($userId, $googleBooksId, $titulo, $autor, $imagenPortada) {
        $stmt = $this->db->prepare("INSERT INTO libros_guardados (user_id, google_books_id, titulo, autor, imagen_portada) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $googleBooksId, $titulo, $autor, $imagenPortada]);
    }

    public function getSavedBooks($userId) {
        $stmt = $this->db->prepare("SELECT * FROM libros_guardados WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBook($bookId) {
        $stmt = $this->db->prepare("DELETE FROM libros_guardados WHERE id = ?");
        $stmt->execute([$bookId]);
    }

    public function addReview($bookId, $review) {
        $stmt = $this->db->prepare("UPDATE libros_guardados SET reseña_personal = ? WHERE id = ?");
        $stmt->execute([$review, $bookId]);
    }
}