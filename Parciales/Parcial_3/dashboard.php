<?php
session_start();
require 'data.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$usuario = $_SESSION['usuario'];
$role = $_SESSION['role'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo ucfirst($usuario); ?></h2>
    <a href="logout.php">Cerrar sesión</a><br><br>

    <?php if ($role === 'profesor'): ?>
        <h3>Calificaciones de los estudiantes:</h3>
        <table border="1">
            <tr>
                <th>Estudiante</th>
                <th>Calificación</th>
            </tr>
            <?php foreach ($usuarios as $nombre => $info): ?>
                <?php if ($info['role'] === 'estudiante'): ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $info['grade']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php elseif ($role === 'estudiante'): ?>
        <h3>Tu calificación:</h3>
        <p>Calificación: <?php echo $usuarios[$usuario]['grade']; ?></p>
    <?php endif; ?>
</body>
</html>
