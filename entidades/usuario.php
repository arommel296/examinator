<?php
class Usuario{
    private $id;
    private $nombre;
    private $password;
    private $rol;
    private $foto;

    public function __construct($id,$nombre, $password, $rol, $foto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->foto = $foto;
    }
}