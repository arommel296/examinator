<?php
class autocargar{
    private function autocargador($clase){
    $carpeta="";
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/entidades/".$clase)) {
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/entidades/".$clase;
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/formularios/".$clase)){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/formulaios/".$clase;
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/helpers/".$clase)){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/helpers/".$clase;
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/repositorios/".$clase)){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/repositorios/".$clase;
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/interfaces/".$clase)){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/interfaces/".$clase;
    } else if(file_exists($_SERVER['DOCUMENT_ROOT']."/vista/".$clase)){
        $carpeta=$_SERVER['DOCUMENT_ROOT']."/vista/".$clase;
    }
    require_once $carpeta.$clase.'class.php';
    }
    function autocargar(){
        spl_autoload_register('autocargador');
    }
}


