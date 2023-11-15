<?php
//require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class PreguntaRepo implements methodDB{
    private $conex;
    private $errores=[];

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findById($id){
        $sql = "SELECT * FROM pregunta WHERE id=:id";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetch(PDO::FETCH_ASSOC);
            // if ($registro) {
            //     $pregunta = new Pregunta($registro['id'], $registro['enunciado'], $registro['resp1'], $registro['resp2'], $registro['resp3'], $registro['correcta'], $registro['url'], $registro['tipoUrl'], $registro['id_dif'], $registro['id_cat']);
            // return $pregunta;
            // }
            return $registro;
        }
        return null;
    }
    
    function findAll(){
        $sql = "SELECT * FROM pregunta";
        $statement = $this->conex->prepare($sql);
        $statement->execute();
        if ($this->conex!=null) {
            $preguntas = [];
            $registro = $statement->fetchAll(PDO::FETCH_ASSOC);
            // while($registro = $statement->fetch(PDO::FETCH_ASSOC)) {
            //     $pregunta = new Pregunta($registro['id'], $registro['enunciado'], $registro['resp1'], $registro['resp2'], $registro['resp3'], $registro['correcta'], $registro['url'], $registro['tipoUrl'], $registro['id_dif'], $registro['id_cat']);
            //     $preguntas[] = $pregunta;
            // }
            //echo json_encode($preguntas);
            return $registro;
        }
        echo json_encode(null);
        return null;
    }

    function findByName($name) {
        //Si no lo pongo me da error.
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
        return $this->deleteById($object->getId());
    }
    
    function save($object){
        $id=$object->getId();
        if(isset($id)){
            return $this->update($object);
        }else{
            return $this->insert($object);
        }
    }

    // function saveById($id){
    //     if(isset($id)){
    //         return $this->update($object);
    //     }else{
    //         return $this->insert($object);
    //     }
    // }

    function update($object){
        $sql = "UPDATE pregunta set enunciado = :enunciado, resp1 = :resp1, resp2 = :resp2, resp3 = :resp3, correcta = :correcta, url = :url, tipoUrl = :tipoUrl, id_dif = :id_dif, id_cat = :id_cat where id=:id";
        $statement = $this->conex->prepare($sql);
        $id=$object->getId();
        $enunciado=$object->getEnunciado();
        $resp1=$object->getResp1();
        $resp2=$object->getResp2();
        $resp3=$object->getResp3();
        $correcta=$object->getCorrecta();
        $url=$object->getUrl();
        $tipoUrl=$object->getTipoUrl();
        $id_dif=$object->getId_dif();
        $id_cat=$object->getId_cat();
        $statement->bindParam(':enunciado', $enunciado);
        $statement->bindParam(':resp1', $resp1);
        $statement->bindParam(':resp2', $resp2);
        $statement->bindParam(':resp3', $resp3);
        $statement->bindParam(':correcta', $correcta);
        $statement->bindParam(':url', $url);
        $statement->bindParam(':tipoUrl', $tipoUrl);
        $statement->bindParam(':id_dif', $id_dif);
        $statement->bindParam(':id_cat', $id_cat);
        $statement->bindParam(':id', $id);
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
        $id=$object->getId();
        $enunciado=$object->getEnunciado();
        $resp1=$object->getResp1();
        $resp2=$object->getResp2();
        $resp3=$object->getResp3();
        $correcta=$object->getCorrecta();
        $url=$object->getUrl();
        $tipoUrl=$object->getTipoUrl();
        $id_dif=$object->getId_dif();
        $id_cat=$object->getId_cat();
        $statement->bindParam(':enunciado', $enunciado);
        $statement->bindParam(':resp1', $resp1);
        $statement->bindParam(':resp2', $resp2);
        $statement->bindParam(':resp3', $resp3);
        $statement->bindParam(':correcta', $correcta);
        $statement->bindParam(':url', $url);
        $statement->bindParam(':tipoUrl', $tipoUrl);
        $statement->bindParam(':id_dif', $id_dif);
        $statement->bindParam(':id_cat', $id_cat);
        $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }
    

}