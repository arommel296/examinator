<?php
// require_once '../entidades/usuario.php';
//require_once './interfaces/DbInterface.php';
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
                echo json_encode($usuario);
                return $usuario;
            }
        }
        echo json_encode(null);
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM usuario";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $usuarios = [];
            $registro = $statement->fetchAll(PDO::FETCH_ASSOC);
            // while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
            //     $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
            //     $usuarios[] = $usuario;
            //     //->toJSON();
            // }
            
            //echo json_encode($usuarios);
            return $registro;
        }
        echo json_encode(null);
        return null;
    }

    function findAllByRol($rol){
        $sql = "SELECT * FROM usuario where rol=:rol";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':rol', $rol);
        $statement->execute();
        if ($this->conex!=null) {
            $usuarios = [];
            while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                $usuarios[] = $usuario;
            }
            echo json_encode($usuarios);
            return $usuarios;
        }
        echo json_encode(null);
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
    function findByName($nombre){
        echo '<script>console.log('.$nombre.');</script>';
        $sql = "SELECT * FROM usuario WHERE nombre LIKE :nombre";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            //echo '<script>console.log('.$registro.');</script>';
            if ($registro){
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                echo json_encode($usuario);
                return $usuario;
            }
        } 
        echo json_encode(null);
        return null; //devuelve null solo si no hay conexión y si no se encuentra un registro con el nombre proporcionado en la base de datos
    }

    function findByNamePass($nombre, $pass){
        //echo '<script>console.log('.$nombre.');</script>';
        $sql = "SELECT * FROM usuario WHERE nombre=:nombre AND password=:contra";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':contra', $pass);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            //echo '<script>console.log('.$registro.');</script>';
            if ($registro){
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                echo json_encode($usuario);
                return $usuario;
            }
        } 
        echo json_encode(null);
        return null; //devuelve null solo si no hay conexión y si no se encuentra un registro con el nombre proporcionado en la base de datos
    }

    function findByRol($rol){
        //echo '<script>console.log('.$rol.');</script>';
        $sql = "SELECT * FROM usuario WHERE rol LIKE :rol";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':rol', $rol);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            //echo '<script>console.log('.$registro.');</script>';
            if ($registro){
                $usuario = new Usuario($registro['id'], $registro['nombre'], $registro['password'], $registro['rol'], $registro['foto']);
                echo json_encode($usuario);
                return $usuario;
            }
        } 
        echo json_encode(null);
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
        $sql = "INSERT into usuario(nombre, password) values(:nombre, :password)";
        //$usuario=new Usuario();
        $nombre=$object->getNombre();
        $contrasena=$object->getPassword();
        //echo $nombre;
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':password', $contrasena);
        //echo 'aaaa';
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }

}
$usu=new UsuarioRepo();
$usu->findAll();