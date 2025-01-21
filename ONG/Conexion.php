<?php
class Conexion {
    private $host = 'localhost';
    private $db   = 'ong';  
    private $user = 'root';
    private $pass = 'root';
    private $charset = 'utf8mb4';
    private $conexion;

    public function conectar() {
        if ($this->conexion === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
                $this->conexion = new PDO($dsn, $this->user, $this->pass);
            } catch (PDOException $e) {
              $error="Error de conexión: " . $e->getMessage();
            }
        }
        return $this->conexion;
    }
}
?>
