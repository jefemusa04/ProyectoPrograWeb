<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preload" href="css/styles-contact.css" as="style">
    <link href="css/styles-contact.css" rel="stylesheet">

    <script src="https://sandbox.paypal.com/sdk/js?
    client-id=ASn3NZdlgFzkACfvTkx7k1TDb6VCFQTnDbiOrxnf9p62C-TaoVFIPQYSX9YnihfnCxc_VMKkmL7cQkiq&currency=MXN"></script>

</head>

<body>

    <header>
        <!-- Navegación -->
        <div class="nav-bg">
            <nav class="navegacion-principal">
                <a href="index.html" class="logo"><span>MJ</span>Records</a>
                <div>
                    <a href="contacto.html"><i class="bx bx-phone" id="contacto"></i></a>
                     <!--Iconos de cart-->
                    <i class="bx bx-shopping-bag" id="cart-icon"></i>
                </div>

                <!--Cart-->
                <div class="cart">
                <h2 class="cart-title">Carrito</h2>

                <!--Contenido del carrito (cart)-->
                <div class="cart-content">


                </div>

                <!--Total del carro-->
                <div class="total">
                    <button type="button" class="btn-buy">Comprar Ahora</button>
                    <div class="total-title"> Total</div>
                    <div class="total-price"> $0</div>
                    
                </div>
            
                <!--Cierre del carrito-->
                <i class="bx bx-x" id="cart-close"></i>

            </div>
            </nav>
        </div>
    </header>

    <main>
        <form>
            <h2 class="title-contacto">Domicilio</h2>
            <div class="input-group">
            
                <label for="name">Direccion</label>
                <input type="text" name="direccion" id="">
    
                <label for="phone">Codigo Postal</label>
                <input type="text" name="cPostla" id="">

                <label for="phone">Estado</label>
                <input type="phone" name="estado" id="">

                <label for="message">Municipio</label>
                <input type="text" name="municipio" id="">
                
                <h3 class=title-contacto>Datos Contacto</h3>

                <label for="name">Nombre y Apellido</label>
                <input type="text" name="nomApe" id="">
    
                <label for="phone">Telefono</label>
                <input type="text" name="telefono" id="">
            </div>
            
        </form>
    </main>
</body>
</html>