<?php

require '../config/database.php';
require '../clases/adminFunciones.php';

$db = new Database();
$con = $db->conectar();

// $password = 300505;
// $sql = "INSERT INTO admin(usuario, contraseña, nombre, email, activo, fecha_alta)
//         VALUES ('admin3', '$password', 'Yessenia', 'alu.22130839@gmail.com','1',NOW())";

// $con->query($sql);

$errors = [];

if(!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);

    if(esNulo([$usuario, $contraseña])){
        $errors[] = "Debe llenar todos los campos";
    }

    if(count($errors) == 0){
        $errors = login($usuario, $contraseña, $con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar sesion</h3></div>
                                    <div class="card-body">
                                        <form action="/admin/index-admin.php" method="post" autocomplete="off">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="usuario" value="admin3"autofocus/>
                                                <label for="inputEmail">Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="contraseña" name="contraseña" type="password" placeholder="Contraseña" value="300505"/>
                                                <label for="inputPassword">Contraseña</label>
                                            </div>

                                            <?php mostrarMensajes($errors); ?>

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>
</html>
