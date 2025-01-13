<?php
require_once 'Entrada.php';

class modelo{
    private $entrada='entrada.txt';

    function __construct()
    {
        
    }

   
    function guardarDatos(datos $d){
        
        try{
            $f = fopen($this->nombre,'a+');
            fwrite($f,$d->getNombre().';'.$d->getFecha().';'.$d->getTipo().';'.$d->getNum().
            ';'.$d->getDescuento().PHP_EOL);

        }catch(Throwable $t){
            echo $t->getMessage();

        }finally{
            fclose($f);

        }
    }


    function obtenerDatos(){
        $resultado = array();

            try{
                if(file_exists($this->datos)){

                    $registros =file($this->datos);

                    foreach($registros as $linea){
                        $campos = explode(';',$linea);
                        $resultado[]=new Datos($campos[0],$campos[1],$campos[2],
                        $campos[3],$campos[4]);
                    }
                }

            }catch(\Throwable $th){
                echo $th->getMessage();
                
            }

        return$resultado;
    }


function LeerDatos() {
    $datos = [];
    if (file_exists($this->datos)) {
        $datos = file($this->datos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    return $datos;
}


//guardar en clase entrada
function obtenerEntrada(){
    $resultado=array();
    if(file_exists($this->entrada)){
        $entrada = file($this->entrada,FILE_IGNORE_NEW_LINES);
        foreach($entrada as $e){
            $fila = explode(';',$e);
            $resultado[]=new Entrada($fila[0],$fila[1],$fila[2],$fila[3],$fila[4],$fila[5]);
        }
    }
    return $resultado;
}
}


?>