<?php
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT * FROM productos");
$sql->execute();
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
</head>
<body>
    <h2>Inventario de Productos</h2>
    <a href="registrar.php">Registrar nuevo producto</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto) { ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['activo'] ? 'Sí' : 'No'; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $producto['id']; ?>">Editar</a>
                    <a href="eliminar.php?id=<?php echo $producto['id']; ?>" onclick="return confirm('¿Está seguro de eliminar este producto?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
