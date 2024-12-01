<?php

function esNulo(array $parametros)
{
    foreach ($parametros as $parametro) {
        if (strlen(trim($parametro)) < 1) {
            return true;
        }
    }
    return false;
}

function usuarioExiste($usuario, $con)
{
    $sql = $con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    if ($sql->fetchColumn() > 0) {
        return true;
    }
    return false;
}
function login($usuario, $contraseña, $con)
{
    $errors = [];
    $sql = $con->prepare("SELECT * FROM admin WHERE usuario = ? LIMIT 1");
    $sql->execute([$usuario]);
    $admin = $sql->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if ($admin['contraseña'] == $contraseña) { // Evita esto, usa hashing en producción
            session_start();
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nombre'] = $admin['nombre'];
            header("Location: ../index-admin.php");
            exit;
        } else {
            $errors[] = "Contraseña incorrecta.";
        }
    } else {
        $errors[] = "Usuario no encontrado.";
    }

    return $errors;
}

function mostrarMensajes($errors) {
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
    }
}


?>
