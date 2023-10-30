<?php

class UsuarioRepo implements methodDB{

    // private $sql;
    // private $result;
    private $conex;

    function findById($id){
        $sql = "SELECT * FROM usuario where id=".$id;
        $result = $this->conex->query($sql);

        if ($this->conex!=null) {
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "id: " . $registro["id"]."<br>";
            }
        } else {
            echo "conexion fallida";
        }

        return $result;
    }
    function findAll(){

    }
    function deleteById($id){

    }
    function delete($object){

    }
    function findByName($name){

    }
    function save($object){

    }
    function update($object){

    }
    function insert($object){
        
    }

}