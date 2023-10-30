<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class IntentoRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM intento where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM intento";
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
        $sql = "delete FROM intento where id=".$id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function delete($object){
        return $this->deleteById($object->id);
    }
    function findByFechaInicio($fechaInicio){
        $sql = "SELECT * FROM intento where fechaInicio=".$fechaInicio;
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
        $sql = "UPDATE intento set fechaInicio = '$object->fechaInicio', jsonP = '$object->jsonP', id_exam = '$object->id_exam', id_user = '$object->id_user' where id=".$object->id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into intento(fechaInicio, jsonP, id_exam, id_user) values('$object->fechaInicio', '$object->jsonP', '$object->id_exam', '$object->id_user')";
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}