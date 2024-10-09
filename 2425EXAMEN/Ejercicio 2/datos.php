<?php

class Datos{
    private $titulo,$fechaRegist,$gen,$tipo,$caps;


    function __construct($titulo,$fechaRegist,$gen,$tipo,$caps){
            
            $this->titulo=$titulo;
            $this->fechaRegist=$fechaRegist;
            $this->gen=$gen;
            $this->tipo=$tipo;
            $this->caps=$caps;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of fechaRegist
     */ 
    public function getFechaRegist()
    {
        return $this->fechaRegist;
    }

    /**
     * Set the value of fechaRegist
     *
     * @return  self
     */ 
    public function setFechaRegist($fechaRegist)
    {
        $this->fechaRegist = $fechaRegist;

        return $this;
    }

    /**
     * Get the value of gen
     */ 
    public function getGen()
    {
        return $this->gen;
    }

    /**
     * Set the value of gen
     *
     * @return  self
     */ 
    public function setGen($gen)
    {
        $this->gen = $gen;

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
     * Get the value of caps
     */ 
    public function getCaps()
    {
        return $this->caps;
    }

    /**
     * Set the value of caps
     *
     * @return  self
     */ 
    public function setCaps($caps)
    {
        $this->caps = $caps;

        return $this;
    }
}