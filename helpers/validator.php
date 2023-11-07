<?php
// require_once 'autocargar.php';
require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/autocargar.php";
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
        // var_dump(self::$errores);
        return self::$errores;
        if (count(self::$errores)>0){
            return self::$errores;
        }else{
            return null;
        }
    }

    public static function getError($clave){
        if (isset(self::$errores[$clave])) {
            return self::$errores[$clave];
        }else{
            return null;
        }
    }

}