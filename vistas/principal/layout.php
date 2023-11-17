<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autoescuela</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="stylesheet" href="./css/loginRegistro.css">
    <script src="./js/preguntas.js"></script>
    <script src="./js/nuevaPregunta.js"></script>
    <script src="./js/cargaAlumnos.js"></script>
    <script src="./js/realizaExamen.js"></script>
</head>

<body>
    <?php
        require_once './vistas/principal/header.php';
    ?>
    <section>
        <div id="cuerpo" class="cuerpo2 cuerpo3">
        <?php
           require_once './vistas/principal/Enrutador.php';
           Enrutador::enruta();
        ?>
        </div>
    </section>

    <?php
        require_once './vistas/principal/footer.php';
    ?>

</body>

</html>