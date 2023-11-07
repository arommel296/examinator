<?php
//require_once 'autocargar.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";
// class login con todas las funciones estáticas
class Login {
    static function login(){
        Session::iniciaSesion();
        $_SESSION['user']=$_POST['usuario'];
    }
    
    static function logout(){
        Session::cierraSesion();
    }
    
    static function estaLogeado(){
        return Session::existeValor('user');
    }
}