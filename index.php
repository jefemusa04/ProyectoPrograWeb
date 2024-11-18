<?php
include 'html/header.html';
require 'php/database.php';
require 'php/config.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, descripcion, precio FROM productos WHERE activo = 1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <title>WoofLandia</title>
</head>

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php foreach ($resultado as $row) { ?>
            <div class="product">
                <?php
                $id = $row['id'];
                $tipos = ['jpg', 'png', 'webp', 'jpeg'];

                // Inicializa la variable $imagen con un valor por defecto
                $imagen = "https://via.placeholder.com/300";

                foreach ($tipos as $tipo) {
                    $ruta = "imagen/" . $id . "." . $tipo;
                    if (file_exists($ruta)) {
                        $imagen = $ruta;
                        break; // Detenemos el bucle si encontramos una imagen
                    }
                }
                ?>
                <a
                    href="php/detalles.php?id=<?php echo htmlspecialchars($row['id']); ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>">
                    <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de producto">
                    <p class="nombre"><?php echo $row['nombre']; ?></p>
                </a>
                <p class="precio"><strong><?php echo MONEDA . $row['precio']; ?></strong></p>

                <div class="d-grid gap-3 col-10 mx-auto">
                    <a href="php/paypal.php" class="btn btn-primary">Comprar ahora</a>
                    <button class="btn btn-outline-primary">Agregar al carrito</button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>