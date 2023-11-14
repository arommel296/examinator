<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";
// require_once 'UsuarioRepo.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $repo=new UsuarioRepo();
    if (isset($_GET['menu'])) {
        if ($_GET['menu'] == "peticionesRegistro") {
            $resultado = $repo->findAllByRol('is null');
            $usuarios=[];
            foreach($resultado as $usuario){
                $usuarios[]=$usuario;
                //->toJSON();
            }

            header('Content-Type: application/json');
            echo json_encode($usus);

        } elseif($_GET['menu'] == "examinar" || $_GET['menu'] == "examenAuto" || $_GET['menu'] == "examenManual") {
            $resultado = $repo->findAll();
            $usuarios=[];
            foreach($resultado as $usuario){
                $usuarios[]=$usuario;
                //->toJSON();
            }
            header('Content-Type: application/json');
            echo json_encode($usuarios);

        }
    } elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

    } elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){

    }
}