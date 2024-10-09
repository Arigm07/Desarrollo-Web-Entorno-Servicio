<?php

class modelo{
    private $titulo;
    private $datos = 'datos.dat';

    function __construct($titulo){
        
        $this-> titulo=$titulo;
    }

    function guardarDatos(datos $d){
        
        try{
            $f = fopen($this->nombre,'a+');
            fwrite($f,$d->getTitulo().';'.$d->getFechaRegist().';'.$d->getGen().';'.$d->getTipo().
            ';'.$d->getCaps().PHP_EOL);

        }catch(Throwable $t){
            echo $t->getMessage();

        }finally{
            fclose($f);

        }
    }

    function obtenerDatos(){
        $resultado = array();

            try{
                if(file_exists($this->titulo)){

                    $registros =file($this->titulo);

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
}

?>