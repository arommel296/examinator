<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
//include_once '\interfaces\dbInterface.php';
class ExamenRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM examen where id=".$id;
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $registro = $result->fetch(PDO::FETCH_ASSOC);
            $examen = new Examen($registro['id'], $registro['fechaInicio'], $registro['id_creador']);
            return $examen;
        } else {
            return null;
        }
    }
    function findAll(){
        $sql = "SELECT * FROM examen";
        $result = $this->conex->query($sql);
        if ($this->conex!=null) {
            $examenes = [];
            while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
                $examen = new Examen($registro['id'], $registro['fechaInicio'], $registro['id_creador']);
                $examenes[] = $examen;
            }
            return $examenes;
        } else {
            return null;
        }
    }
    function deleteById($id){
        $sql = "delete FROM examen where id=".$id;
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
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
        
        $sql = "UPDATE examen set fechaInicio = '$fechaInicio', id_creador = '$object->id_creador' where id=".$object->id;
        
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }
    function insert($object){
        $fechaInicio = date('Y-m-d H:i:s', strtotime($object->fechaInicio));
        
        $sql = "INSERT into examen(fechaInicio, id_creador) values('$fechaInicio', '$object->id_creador')";
        
        if ($this->conex!=null) {
            return $this->conex->exec($sql);
        } else {
            return false;
        }
    }

}