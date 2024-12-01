<?php
require 'php/config.php';
require 'php/database.php';
include 'html/header.html';

$db = new Database();
$con = $db->conectar();

// Obtener productos y su información, incluyendo la imagen
$sql = $con->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE activo = 1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <title>WoofLandia</title>
</head>

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Ajustado a 4 columnas -->
        <?php foreach ($resultado as $row) { ?>
        <div class="col">
            <div class="product">
                <?php
                // Usar la imagen de la base de datos o una imagen predeterminada
                $imagen = !empty($row['imagen']) ? htmlspecialchars($row['imagen']) : "imagen/noimage.png";
                ?>
                <a
                    href="php/detalles.php?id=<?php echo htmlspecialchars($row['id']); ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>"
                >
                    <img
                        src="<?php echo $imagen; ?>"
                        alt="Imagen de producto"
                        class="img-fluid"
                    />
                    <p class="nombre"><?php echo htmlspecialchars($row['nombre']); ?></p>
                </a>
                <p class="precio">
                    <strong><?php echo MONEDA . number_format($row['precio'], 2); ?></strong>
                </p>

                <div class="d-grid gap-3 col-10 mx-auto">
                    <a href="php/paypal.php" class="btn btn-primary">Comprar ahora</a>
                    <button
                        class="btn btn-outline-primary"
                        type="button"
                        onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')"
                    >
                        Agregar al carrito
                    </button>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    function addProducto(id, token) {
        let url = "php/carrito.php";
        let formData = new FormData();
        formData.append("id", id);
        formData.append("token", token);

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.ok) {
                    let elemento = document.getElementById("num_cart");
                    elemento.innerHTML = data.numero;
                }
            })
            .catch((error) => {
                console.error("Error al agregar al carrito:", error);
            });
    }
</script>