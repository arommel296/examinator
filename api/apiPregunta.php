<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";
$repo=new PreguntaRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['menu'])) {
        if($_GET['menu'] == "examenManual" || $_GET['menu'] == "nuevaPregunta") {
            $resultado = $repo->findAll();
            $preguntas=[];
            foreach($resultado as $pregunta){
                $preguntas[]=$pregunta;
            }
            header('Content-Type: application/json');
            echo json_encode($preguntas);
        }
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $datosPreg=file_get_contents("php://input");
        $pregunta=json_decode($datosPreg, true);
        $id = $pregunta['id'];
        $enunciado = $pregunta['enunciado'];
        $resp1 = $pregunta['resp1'];
        $resp2 = $pregunta['resp2'];
        $resp3 = $pregunta['resp3'];
        $correcta = $pregunta['correcta'];
        $url = $pregunta['url'];
        $tipoUrl = $pregunta['tipoUrl'];
        $id_cat = $pregunta['id_cat'];
        $id_dif = $pregunta['id_dif'];

        $preguntaG = new Pregunta($id, $enunciado, $resp1, $resp2, $resp3, $correcta, $url, $tipoUrl, $id_dif, $id_cat);

        $resultado = $repo->save($preguntaG);
        header('Content-Type: application/json');
        echo '{"respuesta":"200"}';
    }
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

} elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if (isset($_GET)) {
        $id = $_GET["id"];
        $respuesta = $repo->deleteById($id);
        echo '{"respuesta":"200"}';
    } else{
        echo '{"respuesta":"ERROR"}';
    }
}