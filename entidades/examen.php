<?php
class Examen{
    private $id;
    private $fechaInicio;
    private $id_creador;

    public function __construct($id, $fechaInicio, $id_creador) {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->id_creador = $id_creador;
    }
}