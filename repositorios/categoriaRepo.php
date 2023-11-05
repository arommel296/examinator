<?php
require_once 'autocargar.php';

class CategoriaRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM categoria where id=".$id;
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $categoria = new Categoria($registro['id'], $registro['nombre']);
                return $categoria;
            }
        } 
        return null;
    }

    function findAll(){
        $sql = "SELECT * FROM categoria";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $categorias = [];
            while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $categoria = new Categoria($registro['id'], $registro['nombre']);
                $categorias[] = $categoria;
            }
            return $categorias;
        }
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM categoria where id=:id";
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
        $sql = "SELECT * FROM categoria where nombre=:nombre";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $name);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro){
                $categoria = new Categoria($registro['id'], $registro['nombre']);
                return $categoria;
            }   
        }
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
        $sql = "UPDATE categoria set nombre = :nombre where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $object->nombre);
        $statement->bindParam(':id', $object->id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into categoria(nombre) values(:nombre)";
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
