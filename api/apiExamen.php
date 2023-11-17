<?php
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";

$exrepo=new ExamenRepo();
$usurepo=new UsuarioRepo();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['menu'])) {
        if($_GET['menu'] == "examenManual" || $_GET['menu'] == "examenAutomatico") {
            $resultado = $exrepo->findAll();
            $examenes=[];
            foreach($resultado as $examen){
                $examenes[]=$examen;
            }
            header('Content-Type: application/json');
            echo json_encode($examenes);

        }
    }
}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST)) {
        $usuario = $_POST['usuario'];
        $id_usuario=$usurepo->findByName($usuario);
        $examenes=$exrepo->findById($id_user);
        $id = $_POST['id'];
        $fechaInicio=$_POST['fechaInicio'];
        $id_creador=$_POST['id_creador'];;

        $examen = new Examen($id, $fechaInicio, $id_creador);

        $resultado = $exrepo->save($examen);
        header('Content-Type: application/json');
        echo json_encode($examen);
    }
} elseif($_SERVER["REQUEST_METHOD"] == "PUT"){

} elseif($_SERVER["REQUEST_METHOD"] == "DELETE"){
    if (isset($_GET)) {
        $id = $_GET["id"];
        $respuesta = $exrepo->deleteById($id);
        echo '{"respuesta":"200"}';
    } else{
        echo '{"respuesta":"ERROR"}';
    }
}