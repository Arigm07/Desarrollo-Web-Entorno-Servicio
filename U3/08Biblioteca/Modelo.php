<?php

require_once 'Usuario.php';

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



    public function loguear($us, $ps) {
        $resultado = null;
    
        try {
            // Consulta para buscar el usuario y la contraseña en la base de datos
            $consulta = $this->conexion->prepare('SELECT * FROM usuarios WHERE usuario = ? AND ps = sha2(?, 512)');
    
            // Rellenar los parámetros
            $param = array($us, $ps);
    
            // Ejecutar la consulta
            if ($consulta->execute($param)) {
                // Recuperar el resultado
                if ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    // Crear un objeto Usuario con los datos obtenidos
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['nombre'],
                        $fila['usuario'],
                        $fila['email']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    
        return $resultado;
    }
    
    function obtenerSocios() {
        // DEVUELVE UN ARRAY VACÍO SI NO HAY SOCIOS, SI HAY SOCIOS, DEVUELVE UN ARRAY CON OBJETOS SOCIO
        $resultado = array();
    
        try {
            $textoConsulta = 'SELECT * FROM socios';
            // Ejecutar consulta
            $c = $this->conexion->query($textoConsulta);
            if ($c) {
                // ACCEDER AL RESULTADO DE LA CONSULTA
                while ($fila = $c->fetch(PDO::FETCH_ASSOC)) {
                    // Crear un objeto Socio por cada fila y agregarlo al array resultado
                    $socio = new Socio(
                        $fila['id'], 
                        $fila['nombre'], 
                        $fila['fechaSancion'], 
                        $fila['email'], 
                        $fila['usuario']
                    );
                    $resultado[] = $socio;
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
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
