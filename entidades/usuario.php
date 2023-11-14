<?php
// require_once 'autocargar.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class Usuario{
    private $id;
    private $nombre;
    private $password;
    private $rol;
    private $foto;

    public function __construct($id = null, $nombre=null, $password=null, $rol = null, $foto = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->foto = $foto;
    }    

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getFoto() {
        return $this->foto;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function toJSON(){
        return json_encode(get_object_vars($this));
    }
}