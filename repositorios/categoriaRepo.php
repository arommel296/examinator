<?php

class CategoriaRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    // public function __construct() {
    //     $this->conex = Db::conecta();
    // }

    function findById($id){
        $sql = "SELECT * FROM categoria where id=".$id;
        $result = $this->conex->query($sql);

        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            echo "id: " . $registro["id"]."<br>";
        } else {
            echo "conexion fallida";
        }
        $categ = "";
    }
    function findAll(){
        $sql = "SELECT * FROM categoria";
        $result = $this->conex->query($sql);

        if ($this->conex!=null) {
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "id: " . $registro["id"]."<br> nombre: ".$registro["nombre"];
            }
        } else {
            echo "conexion fallida";
        }
    }
    function deleteById($id){
        $sql = "delete FROM categoria where id=".$id;
        $result = $this->conex->query($sql);

        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            echo "conexion fallida";
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
            return $registro;
        } else {
                echo "conexion fallida";
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
        $result = $this->conex->query($sql);

        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            echo "conexion fallida";
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into categoria(nombre) values('$object->nombre')";
        $result = $this->conex->query($sql);

        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            echo "conexion fallida";
            return false;
        }
    }

}