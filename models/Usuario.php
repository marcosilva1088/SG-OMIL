<?php

class Usuario extends Conectar {
    Public function login() {
        $conectar = parent::conexion();
        parent::set_names();
        if(isset($_POST["log-in"])) {
            $username_email = $_POST["username_email"];
            $password = $_POST["password"];

            // Consulta preparada para verificar las credenciales con nombre de usuario o correo electrónico
            $stmt = $conectar->prepare("SELECT * FROM sg_omil_usuarios WHERE (username = ? OR email = ?) AND password = ?");
            // Infica el tipo de variable y las varaibles a utilizar
            $stmt->bindValue(1, $username_email);
            $stmt->bindValue(2, $username_email);
            $stmt->bindValue(3, $password);
            $stmt->execute();
            $result = $stmt->fetch();

            if (is_array($result) and count($result) > 0) {
                // Las credenciales son válidas
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $result["username"];
                $_SESSION["email"] = $result["email"];
                $_SESSION["password"] = $result["password"];
                $_SESSION["rol"] = $result["rol"];
                header("location: index.php");
                exit();
            } else {
                // Las credenciales son inválidas
                echo "Credenciales incorrectas.";
                header("location: login.php");
                exit();
            }
        }
    }

    public function update_user() {
        $conectar = parent::conexion();
        parent::set_names();
        if(isset($_POST["update-user"])) {
            // Datos del formulario
            $userId = $_POST["id"];
            $newUsername = $_POST["username"];
            $newMail = $_POST["email"];
            $newRol = $_POST["rol"];
            $newPassword = $_POST["password"];

            // Verificar si el nuevo nombre de usuario o correo ya existen en otros registros
            $checkQuery = "SELECT id FROM sg_omil_usuarios WHERE (username = ? OR email = ?) AND id <> ?";
            $checkStmt = $conectar->prepare($checkQuery);
            $checkStmt->bind_param("ssi", $newUsername, $newMail, $userId);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
                // Ya existe un usuario con el mismo nombre de usuario o correo
                echo "Ya existe un usuario con el mismo nombre de usuario o correo.";
            } else {
                // Consulta preparada para actualizar los datos del usuario excluyendo la contraseña
                if (!empty($newPassword)) {
                    $updateStmt = $conectar->prepare("UPDATE sg_omil_usuarios SET username=?, email=?, password=?, rol=? WHERE id=?");
                    $updateStmt->bind_param("ssssi", $newUsername, $newMail, $newPassword, $newRol, $userId);
                } else {
                    $updateStmt = $conectar->prepare("UPDATE sg_omil_usuarios SET username=?, email=?, rol=? WHERE id=?");
                    $updateStmt->bind_param("sssi", $newUsername, $newMail, $newRol, $userId);
                }

                if ($updateStmt->execute()) {
                    // Actualización exitosa
                    echo "Usuario actualizado con éxito.";
                } else {
                    // Error en la actualización
                    echo "Error al actualizar el usuario.";
                }

            }
            // Redirigir a la página de administrador
            header("Location: admin.php");

        }
    }

    public function delete_user() {
        $conectar = parent::conexion();
        parent::set_names();
        if(isset($_POST["delete-user"])) {
            // Datos del formulario
            $id = $_POST["id"];

            // Consulta para eliminar el usuario
            $stmt = $conectar->prepare("DELETE FROM sg_omil_usuarios WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Eliminación exitosa
                header("location: admin.php"); // Redirigir de nuevo a la página de administración
                exit();
            } else {
                echo "Error al eliminar el usuario.";
                exit();
            }
        }
    }
}

?>