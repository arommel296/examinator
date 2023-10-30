<?php
class Autocargar{
    private function autocargador($clase){
    $carpeta="";
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/entidades/".$clase.".php")) {
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/entidades/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/formularios/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/formulaios/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/helpers/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/helpers/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/repositorios/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/repositorios/".$clase.".php";
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/interfaces/".$clase.".php")){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/interfaces/".$clase.".php";
    }
    require_once $carpeta;
    }
    function autocargar(){
        spl_autoload_register('autocargador');
    }
}


