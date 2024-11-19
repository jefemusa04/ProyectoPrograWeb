<?php
session_start();
require 'config/database.php';
include 'header.php';

$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT * FROM productos");
$sql->execute();
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link href="../css/style-prod.css" rel="stylesheet" />
</head>

<body>
    <h2>Inventario de Productos</h2>

    <!-- Barra de búsqueda -->
    <input type="text" id="searchBar" placeholder="Buscar por ID o nombre...">

    <table id="productTable">
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
    <script>
        // Función de búsqueda
        document.getElementById('searchBar').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#productTable tr');

            rows.forEach((row, index) => {
                if (index === 0) return; // Saltar la fila de encabezado

                let idCell = row.cells[0].textContent.toLowerCase();
                let nameCell = row.cells[1].textContent.toLowerCase();

                if (idCell.includes(filter) || nameCell.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</html>
