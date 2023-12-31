<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class DificultadRepo implements methodDB{
    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findById($id){
        $sql = "SELECT * FROM dificultad WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $dificultad = new Dificultad($registro['id'], $registro['nombre']);
                echo json_encode($dificultad);
                return $dificultad;
            }   
        }
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM dificultad";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $dificultades = [];
            $registro = $statement->fetchAll(PDO::FETCH_ASSOC);//no me funcionaba con while
            return $registro;
        }
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM dificultad where id=:id";
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

    function findByName($name){
        $sql = "SELECT * FROM dificultad where nombre=:nombre";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $name);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $dificultad = new Dificultad($registro['id'], $registro['nombre']);
                echo json_encode($dificultad);
                return $dificultad;
            }
        }
        echo json_encode(null);
        return null;
    }

    function save($object){
        if(isset($object->id)){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }

    function update($object){
        $sql = "UPDATE dificultad set nombre = :nombre where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $object->nombre);
        $statement->bindParam(':id', $object->id);
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into dificultad(nombre) values(:nombre)";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $object->nombre);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }

}