<?php

class Modelo {

    private $conexion;

    public function __construct() {
        
        try {
            $config = $this->obtenerDatos();
            if ($config != null) {
                
                $this->conexion = new PDO(
                    'mysql:host=' . $config['urlBD'] . ';port=' . $config['puerto'] . ';dbname=' . $config['nombreBD'],
                    $config['usBD'],
                    $config['psBD']
                );
            }
        } catch (\Throwable $th) {
            // Muestra un error en caso de fallo
            echo $th->getMessage();
        }
    }


    // Función para obtener los datos del archivo de configuración
    private function obtenerDatos() {
        $resultado = array();
        if (file_exists('.config')) {
            $datosF = file('.config', FILE_IGNORE_NEW_LINES);
            foreach ($datosF as $linea) {
                $campos = explode('=', $linea);
                $resultado[$campos[0]] = $campos[1];
            }
        } else {
            return null;
        }
        return $resultado;
    }


    /**
     * Get the value of conexion
     */
    public function getConexion() {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */
    public function setConexion($conexion) {
        $this->conexion = $conexion;
        return $this;
    }
}
?>
