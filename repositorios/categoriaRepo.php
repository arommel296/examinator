<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class CategoriaRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM categoria where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $categoria = new Categoria($registro['id'], $registro['nombre']);
            return $categoria;
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM categoria";
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $categorias = [];
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                $categoria = new Categoria($registro['id'], $registro['nombre']);
                $categorias[] = $categoria;
            }
            return $categorias;
        } else {
            return null;
        }
    }
    
    function deleteById($id){
        $sql = "delete FROM categoria where id=".$id;
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
        $sql = "SELECT * FROM categoria where nombre=".$name;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $categoria = new Categoria($registro['id'], $registro['nombre']);
            return $categoria;
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
        $sql = "UPDATE categoria set nombre = '$object->nombre' where id=".$object->id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into categoria(nombre) values('$object->nombre')";
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}
