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
    $resultado = array();  // Inicializa un array vacío donde se almacenarán los datos del archivo .config

    // Verifica si el archivo .config existe en el directorio actual
    if (file_exists('.config')) {
        
        // Lee el archivo .config línea por línea y devuelve un array
        // FILE_IGNORE_NEW_LINES evita que se incluyan saltos de línea (\n) en los elementos del array
        $datosF = file('.config', FILE_IGNORE_NEW_LINES);

        // Recorre cada línea del archivo
        foreach ($datosF as $linea) {
            $campos = explode('=', $linea);
            $resultado[$campos[0]] = $campos[1];
        }

    } else {
        // Si el archivo .config no existe, retorna null, indicando que no se pueden obtener los datos
        return null;
    }

    return $resultado;
}




    public function loguear($us, $ps) {
        $resultado = null;
    
        try {
            // Consulta para buscar el usuario y la contraseña en la base de datos
            $consulta = $this->conexion->prepare('SELECT * FROM usuarios WHERE id = ? AND ps = sha2(?, 512)');
    
            // Rellenar los parámetros
            $param = array($us, $ps);
    
            // Ejecutar la consulta
            if ($consulta->execute($param)) {
                // Recuperar el resultado
                if ($fila = $consulta->fetch()) {
                    // Crear un objeto Usuario con los datos obtenidos
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['tipo']
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
                while ($fila = $c->fetch()) {
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


    function obtenerLibros(){
        $resultado = array();
    
        try {
            $textoConsulta = 'SELECT * FROM libros order by titulo';
            // Ejecutar consulta
            $l = $this->conexion->query($textoConsulta);
            if ($l) {
                // ACCEDER AL RESULTADO DE LA CONSULTA
                while ($fila = $l->fetch()) {
                    // Crear un objeto Libro por cada fila y agregarlo al array resultado
                    $libros = new LIbro(
                        $fila['id'], 
                        $fila['titulo'], 
                        $fila['ejemplares'], 
                        $fila['autor']
                    );
                    $resultado[] = $libros;
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    
        return $resultado;
    }

    function comprobar($socio,$libros){
        $resultado = 'ok';

        try {
            //llamar funcion de la bd comprobar
            $consulta = $this->conexion->prepare('SELECT comprobarSiPrestar(?,?)');
            $params = array($socio,$libros);

            if($consulta->execute($params)){
                if($fila=$consulta->fetch()){
                    $codigo = $fila[0];
                    
                    switch($codigo){
                        case -1:
                            $resultado = 'No hay ejemplares o el libro no existe';
                            break;

                            case -2:
                                $resultado = 'El socio está sancionado o no existe';
                                break;

                                case -3:
                                    $resultado = 'EL socio tiene préstamos caducados';
                                    break;

                                    case -4:
                                        $resultado = 'El socio tiene más de 2 libros prestados';
                                        break;
                    }
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
