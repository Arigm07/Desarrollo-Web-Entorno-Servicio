<?php
require_once 'Conexion.php';

class Modelo {
    protected $ong; 
    protected $conexion;

    public function __construct($ong) {
        $this->ong = $ong;
        
        $conexionObj = new Conexion();  
        $this->conexion = $conexionObj->conectar();  
    }

    public function obtenerTodos() {
        $query = $this->conexion->prepare("SELECT * FROM $this->ong");
        $query->execute();
        return $query->fetchAll();
    }

    // Obtener registro 
    public function obtenerPorId($id) {
        $query = $this->conexion->prepare("SELECT * FROM $this->ong WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }

    // Nuevo registro
    public function insertar($datos) {
        $columnas = implode(", ", array_keys($datos));
        $placeholders = implode(", ", array_fill(0, count($datos), "?"));
        $query = $this->conexion->prepare("INSERT INTO $this->ong ($columnas) VALUES ($placeholders)");
        $query->execute(array_values($datos));
        return $this->conexion->lastInsertId();
    }

    // Actualizar
    public function actualizar($id, $datos) {
        $set = implode(", ", array_map(function ($columna) {
            return "$columna = ?";
        }, array_keys($datos)));

        $query = $this->conexion->prepare("UPDATE $this->ong SET $set WHERE id = ?");
        $query->execute(array_merge(array_values($datos), [$id]));
        return $query->rowCount();
    }

    // Eliminar
    public function eliminar($id) {
        $query = $this->conexion->prepare("DELETE FROM $this->ong WHERE id = ?");
        $query->execute([$id]);
        return $query->rowCount();
    }
}
?>



