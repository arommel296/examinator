<header>
    <a href="?menu=inicio" tabindex="1">
        <img src="./imagenes/logoAutoescuelaPng.png" alt="INICIO" width="120px" height="120px">
    </a>
<?php
// 
if (isset($_GET['menu'])) {
    if ($_GET['menu'] != "login" || $_GET['menu'] != "registro" || $_GET['menu']!="") {
    Session::iniciaSesion();
    //echo $_SESSION['usuario'];
    if (isset($_SESSION['usuario'])) {
    $menu='';
    if ($_SESSION['rol']=='alumno') {
        $menu='<nav>
            <div><a href="?menu=" tabindex="2">Mis Exámenes</a></div>
            <div><a href="?menu=inicio" tabindex="3">Nuevo Examen</a></div>
        </nav>';
    } elseif ($_SESSION['rol']=='profesor') {
            $menu='<nav>
            <div><a href="?menu=misExamenes" tabindex="2">Mis Exámenes</a></div>
            <div><a href="?menu=nuevoExamen" tabindex="3">Nuevo Examen</a></div>
            <div class="examinar"><a href="?menu=examinar" tabindex="4">
                Examinar
                </a>
                <div class="hoverMenu">
                    <a href="?menu=examenAuto" class="opc">Examen Automático
                    </a>
                    <a href="?menu=examenManual" class="opc">Examen Manual
                    </a>
                </div>
            </div>
            <div><a href="?menu=nuevaPregunta" tabindex="5">Nueva Pregunta</a></div>
        </nav>';
    } elseif ($_SESSION['rol']=='administrador') {
        $menu='<nav>
        <div><a href="?menu=misExamenes" tabindex="2">Mis Exámenes</a></div>
        <div><a href="?menu=nuevoExamen" tabindex="3">Nuevo Examen</a></div>
        <div class="examinar"><a href="?menu=examinar" tabindex="4">
            Examinar
            </a>
            <div class="hoverMenu">
                <a href="?menu=examenAuto" class="opc">Examen Automático
                </a>
                <a href="?menu=examenManual" class="opc">Examen Manual
                </a>
            </div>
        </div>
        <div><a href="?menu=nuevaPregunta" tabindex="5">Nueva Pregunta</a></div>
        <div><a href="?menu=peticionesRegistro" tabindex="6">Registros</a></div>
        </nav>';
    }
    echo $menu;
    }
}
}

?>
</header>
