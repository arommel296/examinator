<?php



$conex=new PDO("mysql:host=localhost;dbname=alvaro", "root", "root");

$sql = "SELECT * FROM prueba";
$result = $conex->query($sql);

if ($conex!=null) {
    while($registro = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "id: " . $registro["id"]."<br>";
    }
} else {
    echo "conexion fallida";
}

