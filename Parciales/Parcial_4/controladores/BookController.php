<?php
class BookController {
    private $apiUrl = "https://www.googleapis.com/books/v1/volumes?q=";

    public function searchBooks($query) {
        $response = file_get_contents($this->apiUrl . urlencode($query));
        return json_decode($response, true);
    }

    public function saveBook($userId, $bookData) {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("INSERT INTO libros_guardados (user_id, google_books_id, titulo, autor, imagen_portada) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $bookData['id'], $bookData['volumeInfo']['title'], implode(", ", $bookData['volumeInfo']['authors']), $bookData['volumeInfo']['imageLinks']['thumbnail']]);
    }

    public function getSavedBooks($userId) {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("SELECT * FROM libros_guardados WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBook($bookId) {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("DELETE FROM libros_guardados WHERE id = ?");
        $stmt->execute([$bookId]);
    }

    public function addReview($bookId, $review) {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("UPDATE libros_guardados SET reseña_personal = ? WHERE id = ?");
        $stmt->execute([$review, $bookId]);
    }
}