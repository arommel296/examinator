<?php
$columnaIzq='<h1>Nuevo Examen</h1>
<div class="crearExamen-main-container">
    <form class="container1">
        <div class="title-table">Dificultad</div>
        <div class="dificultad-container">
        <select name="dificultad" id="dificultad">
        <option selected>Seleccione una dificultad</option>
    </select>
        </div>
        <div class="title-table">Categoría</div>
        <select name="categoria" id="categoria">
        <option selected>Seleccione una categoria</option>
    </select>
        
      </form>
    <a href="?menu=examen">Comenzar</a>';
$columnaCentro='<form class="container2">
<div class="title-table">Seleccionar Preguntas</div>
<div class="preguntas">
    <div class="check-alumno" id="preguntas"></div>
    </div>
    </div>
    </form>';
$columnaDcha='<form class="container2">
<div class="title-table">Seleccionar Alumnos</div>
<div class="alumnos">
    <div class="check-alumno" id="alumnos"></div>
    </div>
    </div>
    </form>';
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