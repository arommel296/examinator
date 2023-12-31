<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class ExamenRepo implements methodDB{
    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findById($id){
        $sql = "SELECT * FROM examen WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro){
                $examen = new Examen($registro['id'], $registro['fechaInicio'], $registro['id_creador']);
                echo json_encode($examen);
                return $examen;
            }
        }
        echo json_encode(null);
        return null;
    }
    
    function findByName($name) {
        //Si no creo esta función da error por la interface methodDB, aunque esta interface ya no tiene este método abstracto
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
            echo json_encode($examenes);
            return $examenes;
        }
        echo json_encode(null);
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