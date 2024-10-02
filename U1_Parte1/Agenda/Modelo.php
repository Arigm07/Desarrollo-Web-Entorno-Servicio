<?php

require_once 'Contacto.php';

class Modelo{
    private $nombre;

    function __construct($nombre){
        
        $this-> nombre=$nombre;
    }

    function crearContacto(Contacto $c){
        
        try{
            $f = fopen($this->nombre,'a+');
            fwrite($f,$c->getId().';'.$c->getNombre().';'.$c->getTelefono().';'.$c->getTipo().
            ';'.$c->getFoto().PHP_EOL);

        }catch(Throwable $t){
            echo $t->getMessage();

        }finally{
            fclose($f);

        }
    }

    function obtenerContacto(){
        $resultado = array();

            try{
                if(file_exists($this->nombre)){

                    $registros =file($this->nombre);

                    foreach($registros as $linea){
                        $campos = explode(';',$linea);
                        $resultado[]=new Contacto($campos[0],$campos[1],$campos[2],
                        $campos[3],$campos[4]);
                    }
                }

            }catch(\Throwable $th){
                echo $th->getMessage();
                
            }

        return$resultado;
    }

    function obtenerId(){

        $resultado = 1;
            try{
                if(file_exists($this->nombre)) {

                    $registros = file($this->nombre);

                    //Obtengo la posición del array del último registro
                        $pos = sizeof($registros)-1;
                        $campos = explode(';',$registros[$pos]);
                        $resultado = $campos[0]+1;
                }

        }catch(\Throwable $th) {
            echo $th->getMessage();

    }
        return $resultado;
    }
    

    function obtenerContactos($telf){

            //Devuelve null si no hay un contacto para el teléfono buscado
            //Devuelve un objeto contacto si hay un contacto para el teléfono buscado
        $resultado = null;

            try{
                if(file_exists($this->nombre)){
                    $registros = file($this->nombre);

                foreach($registros as $linea){
                    $campos = explode(';',$linea);
                    
                    if($campos[2]==$telf){
                        //He encontrado un contacto para el telf buscado
                        $resultado = new Contacto($campos[0],$campos[1],
                        $campos[2],$campos[3],$campos[4]);

                        return $resultado;
                    }
                }
                
                }

            }catch(\Throwable $th){
                    echo 'Error al obtener contacto: '.$th->getMessage();

            }

            return $resultado;

        }

}

?>