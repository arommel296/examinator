<?php
class Enrutador{
    static function enruta(){
        if (isset($_GET['menu'])) {
            if ($_GET['menu'] == "inicio") {
                require_once './vistas/usuario/pagPrincipal.php';
            }
            if ($_GET['menu'] == "login") {
                require_once './vistas/login/autentifica.php';
            }
            if ($_GET['menu'] == "cerrarsesion") {
                require_once './vistas/login/cerrarSesion.php';
            }
            if ($_GET['menu'] == "registro") {
                require_once './vistas/login/registro.php';
            }
            if ($_GET['menu'] == "misExamenes") {
                require_once './vistas/usuario/pagPrincipal.php';
            }
            if ($_GET['menu'] == "nuevoExamen") {
                require_once './vistas/usuario/nuevoExamen.php';
            }
            if ($_GET['menu'] == "examinar") {
                require_once './vistas/usuario/nuevoExamen.php';
            }
            if ($_GET['menu'] == "examenAuto") {
                require_once './vistas/usuario/nuevoExamen.php';
            }
            if ($_GET['menu'] == "examenManual") {
                require_once './vistas/usuario/nuevoExamen.php';
            }
            if ($_GET['menu'] == "nuevaPregunta") {
                require_once './vistas/usuario/nuevaPregunta.php';
            }
            if ($_GET['menu'] == "peticionesRegistro") {
                require_once './vistas/usuario/peticionesRegistro.php';
            }
            if ($_GET['menu'] == "examen") {
                require_once './vistas/usuario/examen.php';
            }
        } else{
            header("location: ?menu=login");
        }
    }
}
