<?php
class Autocargar{
    public static function autocargador($clase){
    $carpeta="";
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/entidades/".$clase.".php")) {
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/entidades/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/vistas/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/vistas/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/helpers/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/helpers/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/repositorios/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/repositorios/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/interfaces/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/interfaces/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/api/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/api/".$clase.".php";
    }
    require_once $carpeta;
    }
    static function autocargar(){
        spl_autoload_register([self::class, 'autocargador']);
    }
}

Autocargar::autocargar();


