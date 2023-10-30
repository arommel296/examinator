<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
// class login con todas las funciones estáticas
class Login {
    function login(){
        iniciaSesion();
        $_SESSION['user']=$_POST['usuario'];
    }
    
    function logout(){
        cierraSesion();
    }
    
    function estaLogeado(){
        return existeValor('user');
    }
}