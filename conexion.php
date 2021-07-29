<?php

function conectar(){

$conexion=null;
$host='localhost';
$deuda='spago';
$user='root';
$pwd= '';

try{

$conexion =new PDO('mysql:host='.$host.';dbname='.$deuda,$user,$pwd);

}

catch (PDOException $e) {

echo '<p> No se Puede conectar a la base de datos !! </p>';

exit;

}

return $conexion;
}
?>