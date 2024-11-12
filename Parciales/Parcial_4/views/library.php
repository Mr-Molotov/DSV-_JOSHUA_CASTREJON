<?php
session_start();
require_once '../controllers/BookController.php';
$bookController = new BookController();
$savedBooks = $bookController->getSavedBooks($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Biblioteca</title>
</head>
<body>
    <h1>Libros Guardados</h1>
    <ul>
        <?php foreach ($savedBooks as $book): ?>
            <li>
                <h3><?php echo $book['titulo']; ?></h3>
                <p>Autor: <?php echo $book['autor']; ?></p>
                <img src="<?php echo $book['imagen_portada']; ?>" alt="Portada">
                <form method="POST" action="delete_book.php">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <button type="submit">Eliminar</button>
                </form>
                <form ```php
method="POST" action="add_review.php">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <textarea name="review" placeholder="Escribe tu reseña aquí..."></textarea>
                    <button type="submit">Agregar Reseña</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>