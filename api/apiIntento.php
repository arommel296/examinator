<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

$usurepo=new UsuarioRepo();
$pregIntrepo=new PreguntasIntentoRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['menu'])) {
        if($_GET['menu'] == "examen") {
            $usuario = $_POST['usuario'];
            $resultado = $intrepo->findAll();
            $intentos=[];
            foreach($resultado as $intento){
                $intentos[]=$intento;
            }
            header('Content-Type: application/json');
            echo json_encode($intentos);

        }
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $datos=file_get_contents("php://input");
        $datosDecode=json_decode($datos, true); //Array asociativo con los datos del body de la request
        if (isset($datosDecode['idIntento'])) {
            $idIntento = $datosDecode['idIntento'];
            $registro = $pregIntrepo->findQuestionsByExam($idIntento);
            $preguntas=[];
            foreach($registro as $pregunta){
                $preguntas[]=$pregunta;
            }

            header('Content-Type: application/json');
            echo json_encode($preguntas);
        }
        
    }
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){
    $datos=file_get_contents("php://input");//recojo las respuestas del intento en texto plano
    $datosDecode=json_decode($datos, true);
    if (isset($datosDecode["intJson"])&&isset($datosDecode["idIntento"])) {
        $idIntento=$datosDecode["idIntento"];
        $jsonP=$datosDecode["intJson"];
        $registro = $pregIntrepo->update($idIntento, $jsonP);
        if ($registro) {
            echo '{"respuesta":"200"}';
        }else{
            echo '{"respuesta":"ERROR"}';
        }
    }else{
        echo '{"respuesta":"ERROR"}';
    }

} elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if (isset($_GET)) {
        $id = $_GET["id"];
        $respuesta = $intrepo->deleteById($id);
        echo '{"respuesta":"OK"}';
    } else{
        echo '{"respuesta":"F"}';
    }
}