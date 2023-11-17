<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class Intento{
    private $id;
    private $fechaInicio;
    private $jsonP;
    private $id_exam;
    private $id_user;

    public function __construct($id, $fechaInicio, $jsonP, $id_exam, $id_user) {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->jsonP = $jsonP;
        $this->id_exam = $id_exam;
        $this->id_user = $id_user;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getJsonP() {
        return $this->jsonP;
    }

    public function getId_exam() {
        return $this->id_exam;
    }

    public function getId_user() {
        return $this->id_user;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function setJsonP($jsonP) {
        $this->jsonP = $jsonP;
    }

    public function setId_exam($id_exam) {
        $this->id_exam = $id_exam;
    }

    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    //No lo uso
    public function toJSON(){
        return json_encode(get_object_vars($this));
    }
}
