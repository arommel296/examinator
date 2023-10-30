<?php
require_once 'autocargar.php';
$autocargador = new Autocargar();
$autocargador->autocargar();
class Validator{
    private $errores=[];

    public function __construct($errores) {
        $this->errores = $errores;
    }
    public static function match($valor,$patron){
        
    }

    public static function hayErrores(){
        return count(self::$errores->errores)>0?true:false;
    }

    public static function getErrores(){
        
    }

}