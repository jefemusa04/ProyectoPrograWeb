<?php
include 'header.html';
require 'php/database.php';
require 'php/config.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if($productos != null){
    foreach ($productos as $clave => $cantidad){
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo = 1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Contenido -->
    <main>
        <div class="container">

            <div class="row">
                <div class="col-6">
                    <h4>Detalles de pago</h4>
                    <div id=paypal-button-container></div>
                </div>

                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                        </table>
                        <tbody>
                            <?php if($lista_carrito == null) {
                            echo '<tr><td colspan="5" class="test-center"><b>Lista vacia</b></td></tr>';
                            }else{
                                $total = 0;
                                foreach($lista_carrito as $productos){
                                    $_id = $producto['id'];
                                    $nombre = $producto['nombre'];
                                    $precio = $producto['precio'];
                                    $descuento = $producto['descuento'];
                                    $cantidad = $producto['cantidad'];
                                    $precio_desc = $precio - (($precio * $descuento) / 100);
                                    $subtotal = $cantidad * $precio_desc;
                                    $total += $subtotal;

                                ?>
                            <tr>
                                <td><?php echo $nombre; ?></td>
                                <td>
                                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . 
                                                number_format($subtotal, 2, '.', ',',); ?></div>
                                </td>
                            </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="2">
                                    <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>
    
    <script
        src="https://sandbox.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&amp;currency=<?php echo CURRENCY; ?>&amp;locale=es_MX&amp;components=buttons"
        data-uid-auto="uid_fhbvmixthzieuaiissdjhttpumbzdh"></script>

        <script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $total; ?> //base de datos obteniendo el precio
                    }
                }]
            });
        },

        onApprove: function(data, actions) {
            let URL = 'clases/captura.php' 
            actions.order.capture().then(function(detalles) {
                console.log(detalles);

                let url = 'clases/captura.php'

                return fetch(url, {
                    method: 'post',
                    headers: {
                        'content-type': 'aplication/json'
                    },
                    body: JSON.stringify({
                        detalles : detalles
                    })
                })
            });
        },

        onCancel: function(data) {
            alert("Pago cancelado");
            console.log(data);
        }
    }).render('#paypal-button-container');
    </script>

</body>

</html>