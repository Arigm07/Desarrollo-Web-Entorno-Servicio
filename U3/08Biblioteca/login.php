<?php
require_once 'Modelo.php';
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {

    // Redirigir a prestamos.php si el usuario ya está autenticado
    header('location: prestamos.php');
    exit(); 
}

if (isset($_POST['entrar'])) {
    $bd = new Modelo();

    if ($bd->getConexion() == null) {
        $error = 'Error, no se puede conectar con la BD';

    } else {
        // Comprobar usuario y contraseña si los datos son correctos
        $us = $bd->loguear($_POST['usuario'], $_POST['ps']);
        
        if ($us != null) {
            // Almacenar el usuario en la sesión
            $_SESSION['usuario'] = $us;

            // Redirigir a la página prestamos.php
            header('location: prestamos.php');
            exit(); 
        } else {
            $error = 'Error, datos incorrectos';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <p class="display-2">Biblioteca - Login</p>

        <!-- Agregado method="post" para que el formulario envíe datos -->
        <form method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="email" class="form-control" id="usuario" name="usuario" required>
            </div>

            <div class="mb-3">
                <label for="ps" class="form-label">Password</label>
                <input type="password" class="form-control" id="ps" name="ps" required>
            </div>

            <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
        </form>


        <!-- Mostrar mensaje de error si existe -->
        <?php
        if (isset($error)) {
            echo '<div class="text-danger">' . $error . '</div>';
        }
        ?>
    </div>
</body>
</html>
