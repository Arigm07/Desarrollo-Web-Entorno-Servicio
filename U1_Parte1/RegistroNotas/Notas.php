<?php

class Nota
{
    private $asignatura, $tipo, $descripcion, $nota, $fecha;

    function __construct($asignatura, $tipo, $descripcion, $nota, $fecha)
    {
        $this->asignatura = $asignatura;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
        $this->nota = $nota;
        $this->fecha = $fecha;
    }


    /**
     * Get the value of asignatura
     */ 
    public function getAsignatura()
    {
        return $this->asignatura;
    }

    /**
     * Set the value of asignatura
     *
     * @return  self
     */ 
    public function setAsignatura($asignatura)
    {
        $this->asignatura = $asignatura;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of nota
     */ 
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set the value of nota
     *
     * @return  self
     */ 
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}

?>

