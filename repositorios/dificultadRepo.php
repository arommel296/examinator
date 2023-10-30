<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class DificultadRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM dificultad where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $dificultad = new Dificultad($registro['id'], $registro['nombre']);
            return $dificultad;
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM dificultad";
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $dificultades = [];
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                $dificultad = new Dificultad($registro['id'], $registro['nombre']);
                $dificultades[] = $dificultad;
            }
            return $dificultades;
        } else {
            return null;
        }
    }
    function deleteById($id){
        $sql = "delete FROM dificultad where id=".$id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function delete($object){
        return $this->deleteById($object->id);
    }
    function findByName($name){
        $sql = "SELECT * FROM dificultad where nombre=".$name;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $dificultad = new Dificultad($registro['id'], $registro['nombre']);
            return $dificultad;
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
        $sql = "UPDATE dificultad set nombre = '$object->nombre' where id=".$object->id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into dificultad(nombre) values('$object->nombre')";
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}