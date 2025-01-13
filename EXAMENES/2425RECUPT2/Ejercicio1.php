<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de entradas</title>
</head>

<body>
    <h1>CULTURA NAVALMORAL</h1>
    <form action="#" method="post">
        <fieldset>
            <legend>Venta de Entradas</legend>

                <!-- Campo rellenar nombre -->
            <div>
                <label for="nombre">Nombre completo</label><br />
                <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" />
            </div>


            <!-- Selección tipo -->
            <div>
                <label>Tipo Entrada</label><br/>

                    <label for="general">General</label>
                        <input type="radio" name="tipo" id="general" value="general" checked="checked"></input>

                    <label for="mayor">Mayor de 60</label>
                        <input type="radio" name="tipo" id="mayor" value="mayor"></input>

                    <label for="menor">Menor de 6 años</label>
                        <input type="radio" name="tipo" id="menor" value="menor"></input>
            </div>
        
            
            <!-- Campo fecha -->
            <div>
                <label for="fecha">Fecha del evento</label><br />
                <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d') ?>" />
            </div>


            <!-- Campo rellenar nº -->
           <div>
                <label for="num">Número de Entradas</label><br />
                <input type="number" id="num" name="num" value="3" />
            </div>


            <!-- Campo seleccionar descuentos con arrays -->
            <div>
                <label for="descuento">Descuentos</label><br />
                <select name="descuento" id="descuento">
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='SIn descuento'?:'')
                    ?>>Sin descuento</option>
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='Familia Numerosa'?:'')
                    ?>>Familia Numerosa</option>
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='Abonado'?'selected="selected"':'')
                    ?>>Abonado</option>
                    <option <?php 
                    echo (isset($_POST['descuento']) && $_POST['descuento']=='Dia del Espectador'?'selected="selected"':'')
                    ?>>Dia del Espectador</option>
                </select>
            </div>
           

            <div>
                <input type="submit" name="Comprar" value="comprar"></input>
        </div>
        </fieldset>
    </form>

    <?php

if(isset($_POST['comprar'])){

        if(empty($_POST['nombre']) || empty($_POST['num'] ) ||
         empty($_POST['descuento'])){
            echo "Rellena/marca TODOS los campos";
            $error=true;
         }else{
            $datos["nombre"] = $_POST['nombre'];
            $datos["num"] = $_POST['num'];
            $datos["descuento"] = $_POST['descuento'];


    echo "Nombre completo: " .$_POST['nombre'];
    //Chequear si se ha marcado alguno
        if(isset($_POST['nombre']))
        foreach($_POST['nombre'] as $n){
            echo $n.'';
        }

    echo "<br/> Numero de entradas: " .$_POST['num'];
        if(isset($_POST['num']))
        foreach($_POST['num'] as $nu){
            echo $nu.'';
        }

        echo "<br/> Descuento: " .$_POST['descuento'];
        if(isset($_POST['descuento']))
        foreach($_POST['descuento'] as $d){
            echo $d.'';
        }


    echo "<br/> Tipo: " .$_POST['tipo'];
        if(isset($_POST['tipo']))
        foreach($_POST['tipo'] as $t){
            echo $t.'';

   }
         }
        }
?>
    
</body>
</html>