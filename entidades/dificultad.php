<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class Dificultad{
    private $id;
    private $nombre;

    public function __construct($id,$nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    //getters
    public function getId() { 
        return $this->id; 
    }
    public function getNombre(){
        return $this->nombre;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}