<?php

function esNulo(array $parametros){
    foreach($parametros as $parametro){
        if(strlen(trim($parametro)) < 1){
            return true;
        }
    }
    return false;
}

function usuarioExiste($usuario, $con){
    $sql = $con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
}

function login($usuario, $contraseña, $con){
    $sql = $con->prepare("SELECT id, usuario, contraseña, nombre FROM admin WHERE usuario LIKE ?  AND activo = 1 LIMIT 1");
    $sql->execute([$usuario]);
    if($row = $sql->fetch(PDO::FETCH_ASSOC)){
        if($contraseña == $row['contraseña']){
        // if(password_verify($contraseña, $row['contraseña'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['nombre'];
            $_SESSION['user_type'] = 'admin';
            header('Location: inicio.php');
            exit;
        }
    }
    return ['El usuario y/o contraseña son incorrectas'];
} 

function mostrarMensajes(array $errors){
    if(count($errors) > 0) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors as $error){
            echo '<li>' . $error . '</li>';
        }
        echo '<ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

?>