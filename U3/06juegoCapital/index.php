<?php

//Añadimos un contador de aciertos  yfallos
//Guardamos estos datos en la sesion
//Consideramos que pasar se contabiliza como fallos
session_start();

require_once 'Modelo.php';

//Si se pulsa salir se destruye la sesion
if(isset($_GET['salir'])){

    //Eliminamos sesion en el servidor
    session_destroy();

    //Eliminar $_SESSION
    session_unset();
}

//Si no hay nombre, no se puede jugar
if(isset($_SESSION['nombre'])){
    header('location:inicio.php');
}


$modelo = new Modelo();
$preguntasFichero = $modelo->obtenerPreguntas();



if (!isset($_POST['validar']) or isset($_POST['pasar'])) {

    //Si se carga la página o se pulsa en pasar generamos una pregunta aleatoria
    $num = rand(0, sizeof($preguntasFichero)-1);
    $pregunta = $preguntasFichero[$num];


    if(isset($_POST['pasar'])) {
        //Incrementamos fallos
        if(isset($_SESSION['fallos'])){
            $_SESSION['fallos'] ++;
        }else{
            $_SESSION['fallos']=1;
        }
    }

} else {
    //Si se ha pulsado en validar hay que mostrar si se ha acertado o no
    //Comprobar que se ha rellenado la respuesta
    if (!empty($_POST['respuesta'])) {


        //Variable para recordar el input de la respuesta
        $respuestaUS=$_POST['respuesta'];

        //Recuperamos la pregunta que se ha contestado a partir del id de la
        //pregunta que está como value en el botón validar
        foreach ($preguntasFichero as $p) {
            if ($p->getId() == $_POST['validar']) {


                //Creamos dos variables con la pregunta y la respuesta dada por el usuario para
                //recordar los datos
                $pregunta=$p;
               


                //Comprobar si las repuestas son iguales. Comprobamos siempre en minúsculas
                if (strtolower($p->getCapital()) == strtolower($respuestaUS)) {
                    $mensaje='<h3 style="color:green;">Correcto</h3>';
                    //Incrementamos aciertos
                    if(isset($_SESSION['aciertos'])){
                        $_SESSION['aciertos'] ++;
                    }else{
                        $_SESSION['aciertos']=1;
                    }
                    //Recargar pag
                    header('location:index.php');
                }


                else{
                    $mensaje='<h3 style="color:red;">Incorrecto</h3>';
                    //Incrementamos fallos
                    if(isset($_SESSION['fallos'])){
                        $_SESSION['fallos'] ++;
                    }else{
                        $_SESSION['fallos']=1;
                    }
                }
                break; //No seguimos comprobando
            }
        }
    }
    else{
        $mensaje='<h3 style="color:red;">Rellena respuesta</h3>';
    }
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
    <h1>JUEGO CAPITAL</h1>
    <h2><?php echo $_SESSION['nombre']?></h2>
    <a href="index.php"
    <table>
        <tr>
            <td>
                <td>

               


    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <h2>¿Cuál es la capital de <?php echo $pregunta->getPais()?>?</h2>
            <input type="text" id="respuesta" name="respuesta" placeholder="Introduce capital" value="<?php echo (isset($respuestaUS)?$respuestaUS:'')?>"/>
        </div>
        <div>
            <?php echo (isset($mensaje)?$mensaje:'')?>
        </div>
        <button type="submit" value="<?php echo $pregunta->getId()?>" name="validar">Validar</button>
        <button type="submit" name="pasar">Pasar</button>
    </form>

    </td>
           
        <td>
            <?php
                if(isset($_SESSION['aciertos'])){
                    $aciertos = $_SESSION['aciertos'];
                }else{
                    $aciertos = 0;
                    } 

                if(isset($_SESSION['fallos'])){
                    $fallos = $_SESSION['fallos'];
                }else{
                    $fallos = 0;
                 }
            ?>

            <h2 style="color:green">Aciertos: <?php echo $aciertos ?></h2>
            <h2 style="color:red">Fallos: <?php echo $fallos ?></h2>
        </td>
    </tr>
 </table>

</body>

</html>