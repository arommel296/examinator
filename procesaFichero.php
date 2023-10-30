<?php
$fichero = 'fichero.csv';
$errores=[];
$id=$_POST['id'];
$nombre=$_POST['nombre'];
$user=[$id,$nombre];
$logeados='login.csv';

require_once 'user.php';
//$nombreUser=$_GET['userName'];
if (estaLog($logeados,$user)) {

// Leer el archivo CSV
$personas = array_map('str_getcsv', file($fichero));
$cabecera=array_shift($personas);
// Añadir una nueva persona
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    addPers($fichero, $user);
}

// Mostrar el formulario para añadir una nueva persona
echo "<form method='post'>
        <input type='text' name='id' placeholder='ID'>
        <input type='text' name='nombre' placeholder='Nombre'>
        <input type='submit' name='add' value='Añadir'>
      </form>";

// Mostrar la lista de personas
foreach ($personas as $persona) {
    echo "<form method='post'>
            <input type='text' name='nombre' value='{$persona[1]}'>
            <input type='submit' name='edit[{$persona[0]}]' value='Modificar'>
            <input type='submit' name='delete[{$persona[0]}]' value='Borrar'>
          </form>";
}

// Modificar una persona existente
if (isset($_POST['edit'])) {
    $id = key($_POST['edit']);
    $nombre = $_POST['nombre'];

    editPers($fichero,$user);
}

// Borrar una persona existente
if (isset($_POST['delete'])) {
    $id = key($_POST['delete']);
    deletePers($fichero, $user);
}
} else{
    header("Location: login.php");
}
?>
