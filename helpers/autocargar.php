<?php
class Autocargar{
    private static function autocargador($clase){
        $carpeta="";
        if (file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/entidades/".$clase.".php")) {
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/entidades/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/repositorios/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/repositorios/".$clase.".php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/interfaces/DbInterface.php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/interfaces/DbInterface.php";
        } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/api/".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/api/".$clase.".php";
        }else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/login".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/login".$clase.".php";
        }else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/principal".$clase.".php")){
            $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/principal".$clase.".php";
        }
        //echo $carpeta;
        if ($carpeta != "") {
            require_once $carpeta;
        } else {
            throw new Exception("No se pudo autocargar la clase: " . $clase);
        }
    }

    public static function autocargar(){
        spl_autoload_register([self::class, 'autocargador']);
    }
}

Autocargar::autocargar();


