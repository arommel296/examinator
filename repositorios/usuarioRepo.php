<?php
// require_once '../entidades/usuario.php';
// require_once '../interfaces/dbInterface.php';
// require_once 'db.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class UsuarioRepo implements methodDB{

    // private $sql;
    // private $result;
    private $conex;

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findById($id){
        $sql = "SELECT * FROM usuario WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
            return $usuario;
            }
        }
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM usuario";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $usuarios = [];
            while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                $usuarios[] = $usuario;
            }
            return $usuarios;
        }
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM usuario where id=:id";
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
        $sql = "SELECT * FROM usuario WHERE nombre=:nombre";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $name);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro){
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                return $usuario;
            }
        } 
        return null; //devuelve null solo si no hay conexión y si no se encuentra un registro con el nombre proporcionado en la base de datos
    }

    function save($object){
        if(isset($object->id)){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }

    function update($object){
        $sql = "UPDATE usuario set nombre = :nombre, password = :password, rol = :rol, foto = :foto where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $object->nombre);
        $statement->bindParam(':password', $object->password);
        $statement->bindParam(':rol', $object->rol);
        $statement->bindParam(':foto', $object->foto);
        $statement->bindParam(':id', $object->id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into usuario(nombre, password, rol, foto) values(:nombre, :password, :rol, :foto)";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $object->getNombre);
        $statement->bindParam(':password', $object->getPassword);
        $statement->bindParam(':rol', $object->getRol);
        $statement->bindParam(':foto', $object->getFoto);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }

}