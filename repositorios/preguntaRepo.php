<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class PreguntaRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM pregunta where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM pregunta";
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registros = array();
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                $registros[]=$registro;
            }
            return $registros;
        } else {
            return null;
        }
    }
    function deleteById($id){
        $sql = "delete FROM pregunta where id=".$id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function delete($object){
        return $this->deleteById($object->id);
    }
    function findByEnunciado($enunciado){
        $sql = "SELECT * FROM pregunta where enunciado=".$enunciado;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    function save($object){
        if(isset($object->id)){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }
    function update($object){
        $sql = "UPDATE pregunta set enunciado = '$object->enunciado', resp1 = '$object->resp1', resp2 = '$object->resp2', resp3 = '$object->resp3', correcta = '$object->correcta', url = '$object->url', tipoUrl = '$object->tipoUrl', id_dif = '$object->id_dif', id_cat = '$object->id_cat' where id=".$object->id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into pregunta(enunciado, resp1, resp2, resp3, correcta, url, tipoUrl, id_dif, id_cat) values('$object->enunciado', '$object->resp1', '$object->resp2', '$object->resp3', '$object->correcta', '$object->url', '$object->tipoUrl', '$object->id_dif', '$object->id_cat')";
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}