<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
// class sesion con todas las funciones estáticas

class Session{
    function iniciaSesion(){
        session_start();
    }
    
    function cierraSesion(){
        session_destroy();
    }
    
    function guardaSesion($clave,$valor){
        $_SESSION[$clave] = $valor;
    }
    
    function leerSesion($clave){
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        } else {
            return null;
        }
    }
    
    function existeValor($clave){
        if (isset($_SESSION[$clave])){
            $user=$_SESSION[$clave];
        }
        return $user;
    }
}