<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $repo=new CategoriaRepo();
    if (isset($_GET['menu'])) {
        if($_GET['menu'] == "examenManual" || $_GET['menu'] == "examinar" || $_GET['menu'] == "examenAuto" || $_GET['menu'] == "nuevoExamen") {
            $resultado = $repo->findAll();
            $categorias=[];
            foreach($resultado as $categoria){
                $categorias[]=$categoria;
                //->toJSON();
            }
            header('Content-Type: application/json');
            echo json_encode($categorias);

        }
    } elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

    } elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){

    }
}

