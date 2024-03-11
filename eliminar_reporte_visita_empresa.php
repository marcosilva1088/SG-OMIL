<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

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

// Conecta a la base de datos
$conn = new mysqli($servername, $db_username, $db_password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se ha enviado el ID para eliminar
if (isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    // Utiliza una sentencia preparada para evitar la inyección de SQL
    $sqlDelete = "DELETE FROM sg_omil_reportes_visita_empresas WHERE ReporteID = ?";
    
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $deleteId);

    if ($stmt->execute()) {
        echo "Reporte Visita eliminado correctamente.";
        header("Location: visitaReporteEmpresa.php");
        exit();
    } else {
        echo "Error al eliminar Reporte Visita: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de Reporte Visita no proporcionado.";
}

// Cierra la conexión
$conn->close();
?>
