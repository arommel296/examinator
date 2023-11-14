<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $repo=new PreguntaRepo();
    if (isset($_GET['menu'])) {
        if($_GET['menu'] == "examenManual") {
            $resultado = $repo->findAll();
            $preguntas=[];
            foreach($resultado as $pregunta){
                $preguntas[]=$pregunta;
                //->toJSON();
            }
            header('Content-Type: application/json');
            echo json_encode($preguntas);

        }
    } elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

    } elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){

    }
}