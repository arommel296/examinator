<?php
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
}