<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";
class Pregunta{
    private $id;
    private $enunciado;
    private $resp1;
    private $resp2;
    private $resp3;
    private $correcta;
    private $url;
    private $tipoUrl;
    private $id_dif;
    private $id_cat;

    public function __construct($id, $enunciado, $resp1, $resp2, $resp3, $correcta, $url, $tipoUrl, $id_dif, $id_cat) {
        $this->id = $id;
        $this->enunciado = $enunciado;
        $this->resp1 = $resp1;
        $this->resp2 = $resp2;
        $this->resp3 = $resp3;
        $this->correcta = $correcta;
        $this->url = $url;
        $this->tipoUrl = $tipoUrl;
        $this->id_dif = $id_dif;
        $this->id_cat = $id_cat;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getEnunciado() {
        return $this->enunciado;
    }

    public function getResp1() {
        return $this->resp1;
    }

    public function getResp2() {
        return $this->resp2;
    }

    public function getResp3() {
        return $this->resp3;
    }

    public function getCorrecta() {
        return $this->correcta;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getTipoUrl() {
        return $this->tipoUrl;
    }

    public function getId_dif() {
        return $this->id_dif;
    }

    public function getId_cat() {
        return $this->id_cat;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setEnunciado($enunciado) {
        $this->enunciado = $enunciado;
    }

    public function setResp1($resp1) {
        $this->resp1 = $resp1;
    }

    public function setResp2($resp2) {
        $this->resp2 = $resp2;
    }

    public function setResp3($resp3) {
        $this->resp3 = $resp3;
    }

    public function setCorrecta($correcta) {
        $this->correcta = $correcta;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setTipoUrl($tipoUrl) {
        $this->tipoUrl = $tipoUrl;
    }

    public function setId_dif($id_dif) {
        $this->id_dif = $id_dif;
    }

    public function setId_cat($id_cat) {
        $this->id_cat = $id_cat;
    }

    //No lo uso
    public function toJSON(){
        return json_encode(get_object_vars($this));
    }
}