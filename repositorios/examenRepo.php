<?php
require_once 'autocargar.php';

//include_once '\interfaces\dbInterface.php';
class ExamenRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM examen WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro){
                $examen = new Examen($registro['id'], $registro['fechaInicio'], $registro['id_creador']);
                return $examen;
            }
        }
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM examen";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $examenes = [];
            while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $examen = new Examen($registro['id'], $registro['fechaInicio'], $registro['id_creador']);
                $examenes[] = $examen;
            }
            return $examenes;
        }
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM examen where id=:id";
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
        $fechaInicio = date('Y-m-d H:i:s', strtotime($object->fechaInicio));
        
        $sql = "UPDATE examen set fechaInicio = :fechaInicio, id_creador = :id_creador where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':fechaInicio', $fechaInicio);
        $statement->bindParam(':id_creador', $object->id_creador);
        $statement->bindParam(':id', $object->id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $fechaInicio = date('Y-m-d H:i:s', strtotime($object->fechaInicio));
        
        $sql = "INSERT into examen(fechaInicio, id_creador) values(:fechaInicio, :id_creador)";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':fechaInicio', $fechaInicio);
        $statement->bindParam(':id_creador', $object->id_creador);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    

}