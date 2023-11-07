<?php
class Autocargar{
    public static function autocargador($clase){
    $carpeta="";
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/entidades/".$clase.".php")) {
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/entidades/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/vistas/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/repositorios/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/repositorios/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/interfaces/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/interfaces/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/api/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/api/".$clase.".php";
    }
    echo $carpeta;
    require_once $carpeta;
    }
    private static function autocargar(){
        spl_autoload_register([self::class, 'autocargador']);
    }
}

Autocargar::autocargar();


