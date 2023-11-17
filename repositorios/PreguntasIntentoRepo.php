<?php
// require_once '../entidades/usuario.php';
//require_once './interfaces/DbInterface.php';
// require_once 'db.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

class PreguntasIntentoRepo{
    private $conex;

    public function __construct() {
        $this->conex = Db::conecta(); 
    }

    function findQuestionsByExam($idIntento){
        $sql = "SELECT pregunta.* FROM pregunta JOIN examen_preguntas ON pregunta.id = examen_preguntas.id_pregunta JOIN intento ON examen_preguntas.id_examen = 
        intento.id_exam WHERE intento.id = :id;";
        $statement = $this->conex->prepare($sql);
        $statement->bindParam(':id', $idIntento);
        $statement->execute();
        if ($this->conex!=null) {
            $registro = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registro;
        }
        return null;
    }

    // function saveById($id){
    //     if(isset($id)){
    //         return $this->update($object);
    //     }else{
    //         return $this->insert($object);
    //     }
    // }

    function update($object){
        $sql = "UPDATE intento set enunciado = :enunciado, resp1 = :resp1, resp2 = :resp2, resp3 = :resp3, correcta = :correcta, url = :url, tipoUrl = :tipoUrl, id_dif = :id_dif, id_cat = :id_cat where id=:id";
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
        $sql = "INSERT into intento(resp1, resp2, resp3, correcta, url, tipoUrl, id_dif, id_cat) values(:enunciado, :resp1, :resp2, :resp3, :correcta, :url, :tipoUrl, :id_dif, :id_cat)";
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
        // $statement->bindParam(':id', $id);
        $statement->execute();
        if ($this->conex!=null) {
            return $statement->rowCount();
        } else {
            return false;
        }
    }

}