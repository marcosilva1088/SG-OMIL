<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rol"] !== "administrador") {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"]; // Obtener el ID del usuario a eliminar

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

    $conn = new mysqli($servername, $db_username, $db_password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM sg_omil_usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Eliminación exitosa
        header("location: admin.php"); // Redirigir de nuevo a la página de administración
    } else {
        echo "Error al eliminar el usuario.";
    }

    $stmt->close();
    $conn->close();
}
?>
