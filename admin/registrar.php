<?php
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    $sql = $con->prepare("INSERT INTO productos (nombre, descripcion, precio, activo) VALUES (?, ?, ?, ?)");
    $sql->execute([$nombre, $descripcion, $precio, $activo]);

    header("Location: inventario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
</head>
<body>
    <h2>Registrar Producto</h2>
    <form action="registrar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea><br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" required><br>
        <label for="activo">Activo:</label>
        <input type="checkbox" name="activo" id="activo"><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
