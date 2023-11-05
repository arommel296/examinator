<?php
require_once 'autocargar.php';

class IntentoRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM intento WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro){
                $intento = new Intento($registro['id'], $registro['fechaInicio'], $registro['jsonP'], $registro['id_exam'], $registro['id_user']);
                return $intento;
            }
        }
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM intento";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $intentos = [];
            while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $intento = new Intento($registro['id'], $registro['fechaInicio'], $registro['jsonP'], $registro['id_exam'], $registro['id_user']);
                $intentos[] = $intento;
            }
            return $intentos;
        } 
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM intento where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function delete($object){
        return $this->deleteById($object->id);
    }
    
    function save($object){
        if(isset($object->id)){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }

    function update($object){
        $sql = "UPDATE intento set fechaInicio = :fechaInicio, jsonP = :jsonP, id_exam = :id_exam, id_user = :id_user where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':fechaInicio', $object->fechaInicio);
        $statement->bindParam(':jsonP', $object->jsonP);
        $statement->bindParam(':id_exam', $object->id_exam);
        $statement->bindParam(':id_user', $object->id_user);
        $statement->bindParam(':id', $object->id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into intento(fechaInicio, jsonP, id_exam, id_user) values(:fechaInicio, :jsonP, :id_exam, :id_user)";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':fechaInicio', $object->fechaInicio);
        $statement->bindParam(':jsonP', $object->jsonP);
        $statement->bindParam(':id_exam', $object->id_exam);
        $statement->bindParam(':id_user', $object->id_user);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    

}