<?php
session_start();
require 'config/database.php';
include 'header.php'; // Incluir el header de la estructura

$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)) {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $activo = isset($_POST['activo']) ? 1 : 0;

    if (empty($nombre) || empty($descripcion) || empty($precio)) {
        $errors[] = "Debe llenar todos los campos";
    }

    if (count($errors) == 0) {
        $sql = $con->prepare("INSERT INTO productos (nombre, descripcion, precio, activo) VALUES (?, ?, ?, ?)");
        $sql->execute([$nombre, $descripcion, $precio, $activo]);

        // En lugar de header(), llama a la función de JavaScript para cargar la página
        echo "<script>console.log('Redireccionando a inventario.php'); loadPage('inventario.php');</script>";
        // echo "<script>window.location.href = 'inventario.php';</script>";
        exit; // Detener la ejecución del script después de la redirección
    }
}
?>

<div class="container-fluid px-4">
    <h2>Registrar Nuevo Producto</h2>
    <?php if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } ?>
    <form action="registrar.php#" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control"><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="form-control"></textarea><br>

        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" class="form-control"><br>

        <div class="activo">
            <label for="activo">Activo:</label>
            <input type="checkbox" id="activo" name="activo"><br>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Producto</button>
    </form>
</div>

<script>
    function loadPage(pageUrl) {
        fetch(pageUrl)
            .then(response => response.text())
            .then(data => {
                document.querySelector('.container-fluid.px-4').innerHTML = data;
            })
            .catch(error => {
                console.error('Error al cargar la página:', error);
                document.querySelector('.container-fluid.px-4').innerHTML = '<p>Error al cargar el contenido.</p>';
            });
    }
</script>
