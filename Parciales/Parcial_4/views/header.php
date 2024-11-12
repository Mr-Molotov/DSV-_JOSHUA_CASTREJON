<?php
session_start();
require_once '../controllers/UserController.php';
$userController = new UserController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Personal</title>
    <link rel="stylesheet" href="styles.css"> <!-- Puedes agregar tu CSS aquí -->
</head>
<body>
    <header>
        <h1>Mi Biblioteca Personal</h1>
        <nav>
            <ul>
                <?php if ($userController->isLoggedIn()): ?>
                    <li><a href="library.php">Mi Biblioteca</a></li>
                    <li><a href="search.php">Buscar Libros</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href ="login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
``` ```php
    </main>
</body>
</html>