<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

class UsuarioRepo implements methodDB{

    // private $sql;
    // private $result;
    private $conex;

    function findById($id){
        $sql = "SELECT * FROM usuario where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
            return $usuario;
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM usuario";
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $usuarios = [];
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                $usuarios[] = $usuario;
            }
            return $usuarios;
        } else {
            return null;
        }
    }
    function deleteById($id){
        $sql = "delete FROM usuario where id=".$id;
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
        $sql = "SELECT * FROM usuario where nombre='".$name."'";
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
            return $usuario;
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
        $sql = "UPDATE usuario set nombre = '$object->nombre', password = '$object->password', rol = '$object->rol', foto = '$object->foto' where id=".$object->id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $sql = "INSERT into usuario(nombre, password, rol, foto) values('$object->nombre', '$object->password', '$object->rol', '$object->foto')";
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}