<?php
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
}
