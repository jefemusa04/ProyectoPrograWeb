<?php
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id == '') {
    echo "Error: ID no proporcionado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    $sql = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, activo = ? WHERE id = ?");
    $sql->execute([$nombre, $descripcion, $precio, $activo, $id]);

    header("Location: inventario.php");
    exit;
} else {
    $sql = $con->prepare("SELECT * FROM productos WHERE id = ?");
    $sql->execute([$id]);
    $producto = $sql->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form action="editar.php?id=<?php echo $id; ?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required><br>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required><br>
        <label for="activo">Activo:</label>
        <input type="checkbox" name="activo" id="activo" <?php echo $producto['activo'] ? 'checked' : ''; ?>><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
