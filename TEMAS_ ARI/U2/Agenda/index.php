<?php

require_once 'Modelo.php';
$modelo = new Modelo('agenda.dat');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>

</head>

<body>
    <form action="#" method="post" enctype="multipart/form-data">

        <div>
            <label for="tipo">Nombre</label>
            <input type="text" name="nombre" id="nombre" 
            value="<?php echo (isset($_POST['nombre'])?$_POST['nombre']:'') ?>"/>
        </div>


        <div>
            <label for="telf">Teléfono</label>
            <input type="text" name="telf" id="telf" pattern="[0-9]{9}" 
            value="<?php echo (isset($_POST['telf'])?$_POST['telf']:'') ?>"/>
        </div>


        <div>
            <label>Tipo</label><br/>
            <label for="amigo">Amigo</label>
            <input type="radio" name="tipo" id="amigo" value="amigo" checked="checked"/>

            <label for="familia">Familia</label>
            <input type="radio" name="tipo" id="familia" value="familia"
                <?php echo isset($_POST['tipo']) & $_POST['tipo']=='familia'?'checked="checked"':'' ?>/>

            <label for="otros">Otros</label>
            <input type="radio" name="tipo" id="otros" value="otros"
            <?php echo isset($_POST['tipo']) & $_POST['tipo']=='otros'?'checked="checked"':'' ?>/>
        </div>


        <div>
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto"/>
        </div>


            <input type="submit" value="Crear" name="crear">
            <input type="reset" value="Cancelar" name="cancelar">

    </form>
    
    <?php
    if(isset($_POST['crear'])){
        if(empty($_POST['nombre']) or empty($_POST['telf']) or !isset($_FILES['foto'])
        or empty($_POST['tipo'])){
                echo'<h3 style = "color:red;">Error, hay campos vacios</h3>';
        }
        else{

            //Chequear si ya hay un contacto para el teléfono
            $persona = $modelo->obtenerContactos($_POST['telef']);

            //Persona tiene null si no hay contacto y un objeto contacto
                //con todos los datos si hay contacto
            if($persona==null){

            $id = $modelo->obtenerID();
    
            // El nombre del fichero será el instante de tiempo en el que se sube
            // y el nombre original.
                    // Se guardaran en la carpeta img
    
            $nombre = 'img/'.time().$_FILES['foto']['name'];
            $c = new Contacto($id,$_POST['nombre'],$_POST['telf'],
            $_POST['tipo'],$nombre);
    
    
            //Guardar el contacto en el fichero
            $modelo-> crearContacto($c);
    
            //Guardar foto en el servidor
            $destino = $nombre;
            $origen = $_FILES['foto']['tmp_name'];
            move_uploaded_file($origen,$destino);
    
            }else{
                echo '<h3 style="color:red;"> Error:Ya existe un contacto con ese telf'
                .$persona->getNombre().'</h3>';
            }
        }
    }
    
    //Crear la tabla
    echo '<table border="1"';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Teléfono</th>';
        echo '<th>Tipo</th>';
        echo '<th> Foto</th>';
        echo '</tr>';


        //Mostrar contactos de la agenda
        $contactos = $modelo->obtenerContacto();
        foreach($contactos as $c){
            echo '<tr>';
            echo '<td>'.$c->getId().'</td>';
            echo '<td>'.$c->getNombre().'</td>';
            echo '<td>'.$c->getTelefono().'</td>';
            echo '<td>'.$c->getTipo().'</td>';
            echo '<td> <img src="'.$c->getFoto().'" width = "150px"/> </td>';
            echo '</tr>';
        }


    ?>
</body>

</html>