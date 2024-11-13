<?php

require_once 'Ticket.php';

class AccesoDatos{

    private $nombre;

    function __construct($n){
        $this->nombre = $n;
    }

    function insertarProducto(Ticket $t){
        try{
            //Abrir el fichero
            $fichero = fopen($this-> nombre,'a+');

            //Insertar al final
                fwrite($fichero, $t->getProducto(),';',$t->getPrecioU(),';',
                $t->getCantidad(),';',$t->getTotal().PHP_EOL);

        }catch(Throwable $e){
            echo $e->getMessage();

        }finally{
            //Cerrar el fichero
            if(isset($fichero))
               fclose($fichero);
        }
    }

    function obtenerProductos(){
        $resultado = array();

        try{
            if(file_exists($this->nombre)){
                //Cargamos el fichero en un array
                $tmp = file($this->nombre);

                //Producir una excepción/error
                $b=4/0;


                foreach($tmp as $linea){
                    $campos = explode(';','$linea');

                    //Crear el objeto ticket
                    $t = new Ticket($campos[0],$campos[1],$campos[2]);

                    //Añadimos $t al array de objetos resultado
                    $resultado[]=$t;

                }
            }

        }catch(Throwable $e){
           echo $e->getMessage();

        }
            return $resultado;
    }

}

?>