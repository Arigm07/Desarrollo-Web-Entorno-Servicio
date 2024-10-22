<?php
require_once 'controlador.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
<?php
    require_once 'menu.php';
?>
<div>
<?php
if(isset($error)){
    echo $error;
}
?>
</div>

<div>

    <!-- Área de inserción (solo admin) -->
<?php
if ($_SESSION['usuario']->getTipo() == 'A') {

    // OBTENEMOS LOS SOCIOS
    $socios = $bd->obtenerSocios();

    //OBTENEMOS LIBROS
    $libros = $bd->obtenerLibros();
?>



    <form action="" method="post">
        <div class="mb-3">
            <label for="socio" class="form-label">Socio</label>
            <select name="socio" id="socio" class="form-select">
                <?php
                // Iteramos sobre los socios para llenar el select
                foreach ($socios as $s) {
                    // Cerramos correctamente el echo y añadimos el valor de la opción
                    echo '<option value="' . $s->getId() . '">' . $s->getNombre() . ' (' . $s->getUs() . ')</option>';
                }
                ?>
            </select>

            <label for="libro" class="form-label">Libro</label>
            <select name="libro" id="libro" class="form-select">
                <?php
                // Iteramos sobre los socios para llenar el select
                foreach ($libros as $l) {
                    // Cerramos correctamente el echo y añadimos el valor de la opción
                    echo '<option value="' . $l->getId() . '">' . $l->getTitulo(). ' (' . 
                    $l->getEjemplares() . ' (' . $l->getAutor().')</option>';
                }
                ?>
            </select>

        </div>

        <!-- Botón para enviar el formulario -->
        <button type="submit1" name="pCrear">Crear préstamo</button>
    </form>

<?php
}
?>

        </div>

    </body>

</html>
