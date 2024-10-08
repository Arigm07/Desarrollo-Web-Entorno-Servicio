<?php

 //Recuperar valor de la cookie si está
 if(isset($_COOKIE['miPrimeraC'])){
    $valorC = $_COOKIE['miPrimeraC'];
}

    if(isset($_POST['guardar'])){
        //Creamos una cookie y le damos el valord el input
        if(!empty($_POST['valor'])){
            setcookie('miPrimeraC',$_POST['valor'],time()+(60*60*24*30));

            //Recargar la pág para actualizar $_COOKIE
            header('location:01PrimeraCookie.php');
        }
    }
            if(isset($_POST['borrar'])){

                //Borrar cookie. Poner como caducada
                setcookie('miPrimeraC','',time()-1);

                //Recargar la pág para actualizar $_COOKIE
                header('location:01PrimeraCookie.php');
            }
   


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primera Cookie</title>
</head>
<body>
    
    <form action="" method="post">
    
        <label>Valor de la cookie</label>

        <input type="text" name="valor" 
            value= "<?php echo (isset($valorC)?$valorC:'')?>"
                placeholder="Valor que se almacena en la cookie miPrimeraC"/>
            
        <input type="submit" name="guardar" value="Guardar"/>
        <input type="submit" name="borrar" value="Borrar"/>

    </form>

</body>
</html>