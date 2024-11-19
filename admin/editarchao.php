<?php
session_start();
include 'header.php';
require 'config/database.php';

try {
    $db = new Database();
    $con = $db->conectar();
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verifica si el ID está presente en la URL y es numérico
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    echo "ID de producto no especificado o no válido.";
    exit;
}

$id = $_GET['id'];

// Obtiene el producto de la base de datos
$sql = $con->prepare("SELECT * FROM productos WHERE id = ?");
$sql->execute([$id]);
$producto = $sql->fetch(PDO::FETCH_ASSOC);

// Verifica si el producto existe
if (!$producto) {
    echo "El producto no existe.";
    exit;
}

$errors = []; // Inicializa la variable $errors como un array vacío

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $activo = isset($_POST['activo']) ? 1 : 0;

    // Validaciones básicas
    if (empty($nombre) || empty($descripcion) || empty($precio)) {
        $errors[] = "Debe llenar todos los campos.";
    }

    // Valida que el precio sea numérico
    if (!is_numeric($precio)) {
        $errors[] = "El precio debe ser un número válido.";
    }

    if (count($errors) === 0) {
        try {
            $sql = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, activo = ? WHERE id = ?");
            $sql->execute([$nombre, $descripcion, $precio, $activo, $id]);
            header("Location: inventario.php");
            exit;
        } catch (Exception $e) {
            $errors[] = "Error al actualizar el producto: " . $e->getMessage();
        }
    }
}
?>

<html>
<body>
    <h2>Editar Producto</h2>
    
    <?php if (!empty($errors)) { ?>
        <div style="color: red;">
            <?php foreach ($errors as $error) { echo "<p>" . htmlspecialchars($error) . "</p>"; } ?>
        </div>
    <?php } ?>

    <form method="post" action="">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
        </div>
        <div>
            <label for="activo">Activo:</label>
            <input type="checkbox" name="activo" id="activo" <?php echo $producto['activo'] ? 'checked' : ''; ?>>
        </div>
        <div>
            <input type="submit" class="btn btn-primary" value="Guardar Cambios">
        </div>
    </form>
</body>
</html>
