<?php
$columnaIzq='<h1>Nuevo Examen</h1>
    <h2>Dificultad</h2>
    <select name="dificultad" id="dificultad">
        <option value="Seleccione una dificultad" selected></option>
    </select>
    <h2>Categoría</h2>
    <select name="categoria" id="categoria">
        <option value="Seleccione una categoria" selected></option>
    </select>
    <a href="?menu=examen">Comenzar</a>';
$columnaCentro='<div id="preguntas"></div>';
$columnaDcha='<div id="alumnos"></div>';
if ($_GET['menu'] == "nuevoExamen") {
    echo $columnaIzq;
} elseif ($_GET['menu'] == "examinar" || $_GET['menu'] == "examenAuto") {
    echo $columnaIzq.$columnaDcha;
} elseif ($_GET['menu'] == "examenManual") {
    echo $columnaIzq.$columnaCentro.$columnaDcha;
}
//|| $_GET['menu'] != "examinar" || $_GET['menu'] != "examenAuto" || $_GET['menu'] != "examenManual"
?>