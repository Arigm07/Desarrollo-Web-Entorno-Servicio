<?php

//Mostrar el array $_SESSION
echo '<h4>Valor de $_SESSION antes de hacer el session_start</h4>';
echo var_dump($_SESSION);

//Antes de trabajar con sesions hay que llamar a session_start()
session_start();

//Mostrar el array $_SESSION
echo '<h4>Valor de $_SESSION antes de hacer el session_start</h4>';
echo var_dump($_SESSION);

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
    echo 'Id sesión:'.session_id();
    echo '<br/>Nombre sesión:'.session_name();

    //Crear una variable de sesión
    $_SESSION['nombre']='Ariadna';
?>

</body>
</html>