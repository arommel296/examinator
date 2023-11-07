<?php
//require_once 'autocargar.php';

$carpeta=$_SERVER['DOCUMENT_ROOT'];
echo $carpeta;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario"><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>

