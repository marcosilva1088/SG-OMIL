<?php
// Host
// Establecer la conexión a la base de datos
// $servername = "localhost";
// $db_username = "SG-OMIL";
// $db_password = "Sg-omil-2024";
// $database = "sg_omil";

// LOCAL
// Establecer la conexión a la base de datos
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "sg_omil";

// Crear una conexión a la base de datos
$conexion = mysqli_connect($servername, $db_username, $db_password, $database);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
