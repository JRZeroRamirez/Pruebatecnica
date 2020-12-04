<?php
$user = "root";
$password = "12345";  
$host = "localhost";
$db= "cursosprueba";


$conection = @mysqli_connect( $host, $user,$password,$db ) or die ("No se ha podido conectar al servidor de Base de datos");



if(!$conection){
    echo "Error en la conexion";
}
?>