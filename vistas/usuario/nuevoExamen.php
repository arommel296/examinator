<?php
$columnaIzq='<div><h1>Nuevo Examen</h1>
    <h2>Dificultad</h2>
    <select name="dificultad" id="dificultad">
        <option selected>Seleccione una dificultad</option>
    </select>
    <h2>Categoría</h2>
    <select name="categoria" id="categoria">
        <option selected>Seleccione una categoria</option>
    </select>
    <a href="?menu=examen">Comenzar</a></div>';
$columnaCentro='<div id="preguntas"></div>';
$columnaDcha='<div id="alumnos"></div>';
// Session::iniciaSesion();
$val = new Validacion;
if (isset($_SESSION['usuario'])) {
    if ($_GET['menu'] == "nuevoExamen") {
        echo $columnaIzq;
    } elseif ($_GET['menu'] == "examinar" || $_GET['menu'] == "examenAuto") {
        echo $columnaIzq.$columnaDcha;
    } elseif ($_GET['menu'] == "examenManual") {
        echo $columnaIzq.$columnaCentro.$columnaDcha;
    }
} else {
    header('Location: ?menu=login');
    echo "La sesión de usuario no está establecida.";
}
//|| $_GET['menu'] != "examinar" || $_GET['menu'] != "examenAuto" || $_GET['menu'] != "examenManual"
?>