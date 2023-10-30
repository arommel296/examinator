<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
//include_once '\interfaces\dbInterface.php';
class ExamenRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM examen where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM examen";
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
        $sql = "delete FROM examen where id=".$id;
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
        $sql = "SELECT * FROM examen where fechaInicio=".$fechaInicio;
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
        $sql = "UPDATE examen set fechaInicio = '$object->fechaInicio', id_creador = '$object->id_creador' where id=".$object->id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into examen(fechaInicio, id_creador) values('$object->fechaInicio', '$object->id_creador')";
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}