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
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="Inicio.php">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html> -->
<?php
//require_once 'autocargar.php';
//require_once $_SERVER['DOCUMENT_ROOT']."/DEWESE/examinator/helpers/Autocargar.php";
// $carpeta=$_SERVER['DOCUMENT_ROOT'];
// echo $carpeta;
echo 'a';
$valida=new Validacion();
    if(isset($_POST['submit']))
    {   echo 'a';
        $valida->Requerido('usuario');
        $valida->Requerido('password');
        //Comprobamos validacion
        if($valida->ValidacionPasada())
        {
            //echo $_SESSION['usuario'];
            // if(ApiUsuario::loginUsuario())
            // {
                // $url=$_GET['returnurl'];
                // header("location:?menu=".$url);
                //echo $_SESSION['usuario'];
            // }
        }
    }
?>



<!-- if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        // verificar las credenciales del usuario.
        // Si las credenciales son correctas, iniciar la sesión.
        Login::login();
    }
} elseif (Login::estaLogeado()) {
    // Si el usuario ya ha iniciado sesión, se puede redirigir.
    header('Location: index.php');
    exit();
}
?> -->