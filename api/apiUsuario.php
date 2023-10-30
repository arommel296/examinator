<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();

// Comprobación para ver si el usuario está logueado
if (!(Login::estaLogeado())) {
    // Si el usuario no está logueado, devuelve un error y termina la ejecución
    header('HTTP/1.0 403 Forbidden');
    echo 'No estás autorizado para acceder a esta API.';
    exit;
}