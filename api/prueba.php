<?php
$body=file_get_contents("php://input");
// $_PUT=array();
echo "<img src=$body>";
// parse_str($body, $_PUT);
// echo $_PUT['id'];
// echo $_PUT['nombre'];
//id=1&nombre=alvaro