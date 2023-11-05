<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class Examen{
    private $id;
    private $fechaInicio;
    private $id_creador;

    public function __construct($id, $fechaInicio, $id_creador) {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->id_creador = $id_creador;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getId_creador() {
        return $this->id_creador;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function setId_creador($id_creador) {
        $this->id_creador = $id_creador;
    }
}
