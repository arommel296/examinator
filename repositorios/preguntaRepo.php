<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class PreguntaRepo implements methodDB{
    private $conex = Db::conecta();
    private $errores=[];

    function findById($id){
        $sql = "SELECT * FROM pregunta WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            if ($registro) {
                $pregunta = new Pregunta($registro['id'], $registro['enunciado'], $registro['resp1'], $registro['resp2'], $registro['resp3'], $registro['correcta'], $registro['url'], $registro['tipoUrl'], $registro['id_dif'], $registro['id_cat']);
            return $pregunta;
            }
        }
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM pregunta";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $preguntas = [];
            while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
                $pregunta = new Pregunta($registro['id'], $registro['enunciado'], $registro['resp1'], $registro['resp2'], $registro['resp3'], $registro['correcta'], $registro['url'], $registro['tipoUrl'], $registro['id_dif'], $registro['id_cat']);
                $preguntas[] = $pregunta;
            }
            return $preguntas;
        }
        return null;
    }
    
    function deleteById($id){
        $sql = "delete FROM pregunta where id=:id";
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
        $sql = "UPDATE pregunta set enunciado = :enunciado, resp1 = :resp1, resp2 = :resp2, resp3 = :resp3, correcta = :correcta, url = :url, tipoUrl = :tipoUrl, id_dif = :id_dif, id_cat = :id_cat where id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':enunciado', $object->enunciado);
        $statement->bindParam(':resp1', $object->resp1);
        $statement->bindParam(':resp2', $object->resp2);
        $statement->bindParam(':resp3', $object->resp3);
        $statement->bindParam(':correcta', $object->correcta);
        $statement->bindParam(':url', $object->url);
        $statement->bindParam(':tipoUrl', $object->tipoUrl);
        $statement->bindParam(':id_dif', $object->id_dif);
        $statement->bindParam(':id_cat', $object->id_cat);
        $statement->bindParam(':id', $object->id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    
    function insert($object){
        $sql = "INSERT into pregunta(enunciado, resp1, resp2, resp3, correcta, url, tipoUrl, id_dif, id_cat) values(:enunciado, :resp1, :resp2, :resp3, :correcta, :url, :tipoUrl, :id_dif, :id_cat)";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':enunciado', $object->enunciado);
        $statement->bindParam(':resp1', $object->resp1);
        $statement->bindParam(':resp2', $object->resp2);
        $statement->bindParam(':resp3', $object->resp3);
        $statement->bindParam(':correcta', $object->correcta);
        $statement->bindParam(':url', $object->url);
        $statement->bindParam(':tipoUrl', $object->tipoUrl);
        $statement->bindParam(':id_dif', $object->id_dif);
        $statement->bindParam(':id_cat', $object->id_cat);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    

}