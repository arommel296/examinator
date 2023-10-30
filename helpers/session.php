<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
// class sesion con todas las funciones estáticas

class Session{
    static function iniciaSesion(){
        session_start();
    }
    
    static function cierraSesion(){
        session_destroy();
    }
    
    static function guardaSesion($clave,$valor){
        $_SESSION[$clave] = $valor;
    }
    
    static function leerSesion($clave){
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        } else {
            return null;
        }
    }
    
    static function existeValor($clave){
        $user=null;
        if (isset($_SESSION[$clave])){
            $user=$_SESSION[$clave];
        }
        return $user;
    }
}