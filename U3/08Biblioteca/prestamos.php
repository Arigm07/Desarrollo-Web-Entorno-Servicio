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
    <!-- Area de insert (solo admin) -->
    <?php
    if($_SESSION['usuario']->getTipo() == 'A'){
        //OBTENEMOS LOS SOCIOS
        $socios = $bd->obtenerSocios();
    }
    ?>
    
    <form action="" method="post">

    </form>
    
</div>

</body>

</html>