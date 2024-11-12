<?php
session_start();
require_once '../controllers/BookController.php';
$bookController = new BookController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookId = $_POST['book_id'];
    $review = $_POST['review'];
    $bookController->addReview($bookId, $review);
    header("Location: library.php");
    exit();
}