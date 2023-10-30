<?php
class Dificultad{
    private $id;
    private $nombre;

    public function __construct($id,$nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}