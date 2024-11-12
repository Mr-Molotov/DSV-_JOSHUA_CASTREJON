<?php
session_start();
require_once ('../controladores/BookController.php');
$bookController = new BookController();

if (isset($_POST['search'])) {
    $books = $bookController->searchBooks($_POST['query']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Libros</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="query" placeholder="Buscar libros...">
        <button type="submit" name="search">Buscar</button>
    </form>

    <?php if (isset($books)): ?>
        <h2>Resultados de la Búsqueda:</h2>
        <ul>
            <?php foreach ($books['items'] as $book): ?>
                <li>
                    <h3><?php echo $book['volumeInfo']['title']; ?></h3>
                    <p>Autor: <?php echo implode(", ", $book['volumeInfo']['authors']); ?></p>
                    <img src="<?php echo $book['volumeInfo']['imageLinks']['thumbnail']; ?>" alt="Portada">
                    <form method="POST" action="save_book.php">
                        <input type="hidden" name="book_data" value="<?php echo htmlspecialchars(json_encode($book)); ?>">
                        <button type="submit">Guardar en Biblioteca</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>