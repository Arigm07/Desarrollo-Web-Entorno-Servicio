<?php

class Modelo {
    private $archivoAsignaturas = 'asig.dat';
    private $archivoNotas = 'notas.dat';

    function __construct() {
        // Asegurarse de que los archivos existen
        if (!file_exists($this->archivoAsignaturas)) {
            file_put_contents($this->archivoAsignaturas, "diw\ndwes\ndaw\ndwc\n");
        }
        if (!file_exists($this->archivoNotas)) {
            file_put_contents($this->archivoNotas, "");
        }
    }

    function crearNota(Nota $n) {
        $linea = implode('|', [
            $n->getFecha(),
            $n->getAsignatura(),
            $n->getDescripcion(),
            $n->getNota(),
            $n->getTipo()
        ]) . PHP_EOL;

        file_put_contents($this->archivoNotas, $linea, FILE_APPEND);
    }

    function obtenerNotas() {
        $notas = [];
        if (file_exists($this->archivoNotas)) {
            $notas = file($this->archivoNotas, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        return $notas;
    }

    function obtenerAsignaturas() {
        $asignaturas = [];
        if (file_exists($this->archivoAsignaturas)) {
            $asignaturas = file($this->archivoAsignaturas, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        return $asignaturas;
    }
}

?>
