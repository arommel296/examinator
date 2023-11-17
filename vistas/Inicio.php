<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form method="post" action="Inicio.php">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="submit" value="Iniciar sesión">
    </form>
</body>

</html>
<?php
echo 'a';
$valida=new Validacion();
    if(isset($_POST['submit']))
    {   echo 'a';
        $valida->Requerido('usuario');
        $valida->Requerido('password');
        //Comprobamos validacion
        if($valida->ValidacionPasada())
        {

        }
    }
?>
