<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";
$repo=new PreguntaRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // $repo=new PreguntaRepo();
    if (isset($_GET['menu'])) {
        if($_GET['menu'] == "examenManual" || $_GET['menu'] == "nuevaPregunta") {
            $resultado = $repo->findAll();
            $preguntas=[];
            foreach($resultado as $pregunta){
                $preguntas[]=$pregunta;
                //->toJSON();
            }
            header('Content-Type: application/json');
            echo json_encode($preguntas);

        }
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $id = $_POST['id'];
        $enunciado = $_POST['enunciado'];
        $resp1 = $_POST['resp1'];
        $resp2 = $_POST['resp2'];
        $resp3 = $_POST['resp3'];
        $correcta = $_POST['correcta'];
        $url = $_POST['url'];
        $tipoUrl = $_POST['tipoUrl'];
        $id_cat = $_POST['id_cat'];
        $id_dif = $_POST['id_dif'];

        $pregunta = new Pregunta($id, $enunciado, $resp1, $resp2, $resp3, $correcta, $url, $tipoUrl, $id_cat, $id_dif);

        $resultado = $repo->save($pregunta);
        header('Content-Type: application/json');
        echo json_encode($pregunta);
    }
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

} elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if (isset($_GET)) {
        $id = $_GET["id"];
        $respuesta = $repo->deleteById($id);
        echo '{"respuesta":"OK"}';
    } else{
        echo '{"respuesta":"F"}';
    }
}