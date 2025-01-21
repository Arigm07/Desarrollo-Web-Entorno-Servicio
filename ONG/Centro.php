<?php
require_once 'Modelo.php';

class Centro extends Modelo {
    private $id;
    private $nombre;
    private $localidad;
    private $activo;

    public function __construct($id = null, $nombre = null, $localidad = null, $activo = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->localidad = $localidad;
        $this->activo = $activo;
    }
    

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
        return $this;
    }

   

    public function obtenerCentros() {
        $query = $this->conexion->prepare("SELECT * FROM centros");
        $query->execute();
        return $query->fetchAll();
    }

    public function obtenerCentroPorId($id) {
        $query = $this->conexion->prepare("SELECT * FROM centros WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }
}
?>
