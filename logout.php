<?php
//Si está logeado (if): llamada a la función logout()
//hacer header al login

require_once 'funcionesLog.php';

if (estaLog($logeados,$user)) {
    logout($logeados,$user);
    
}



?>