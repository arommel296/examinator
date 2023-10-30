<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class Dificultad{
    private $id;
    private $nombre;

    public function __construct($id,$nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}