<?php
$fin='<a href="?menu=examen">Comenzar
<img src="./imagenes/flechaIcon.png" alt="INICIO" width="15%" height="15%"></a>
</div>';
$vacio='<div></div>';
$columnaIzq='
<div class="crearExamen-main-container">
    <form class="container1">
        <div class="title-table">Dificultad</div>
        <select name="dificultad" id="dificultad">
        <option selected>Seleccione una dificultad</option>
    </select>
        <div class="title-table">Categoría</div>
        <select name="categoria" id="categoria">
        <option selected>Seleccione una categoria</option>
    </select>
      </form>';
$columnaCentro='<form class="container2">
<div class="title-table">Seleccionar Preguntas</div>
<div class="preguntas" id="preguntas">
    </div>
    </form>';
$columnaDcha='<form class="container2">
<div class="title-table">Seleccionar Alumnos</div>
<div class="alumnos" id="alumnos">
    </div>
    </form>';
// Session::iniciaSesion();
$val = new Validacion;
if (isset($_SESSION['usuario'])) {
    if ($_GET['menu'] == "nuevoExamen") {
        echo $columnaIzq.$fin;
    } elseif ($_GET['menu'] == "examinar" || $_GET['menu'] == "examenAuto") {
        echo $columnaIzq.$vacio.$columnaDcha.$fin;
    } elseif ($_GET['menu'] == "examenManual") {
        echo $columnaIzq.$columnaCentro.$columnaDcha.$fin;
    }
} else {
    header('Location: ?menu=login');
    echo "La sesión de usuario no está establecida.";
}
//|| $_GET['menu'] != "examinar" || $_GET['menu'] != "examenAuto" || $_GET['menu'] != "examenManual"
?>