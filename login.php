<?php
//  Desarrollado por: Ilustre Municipalidad de Melipilla.
//  Departamento:Informática.
//  Directora de departamento: Limbi Odeth Ortiz Neira.
//  Jefe de proyecto: Cristian Esteban Suazo Olguin 

require_once("config/conexion.php");
if (isset($_POST["log-in"]) and $_POST["log-in"] == "si") {
  require_once("models/Usuario.php");
  $usuario = new Usuario();
  $usuario->login();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets\css\login.css">
</head>
<body>
    <div class="parent clearfix">
        <div class="bg-illustration">
          <img src="assets\img\logotipo_municipalidad_de_melipi.png" alt="logo">
    
          <div class="burger-btn">
            <span></span>
            <span></span>
            <span></span>
          </div>
    
        </div>
        
        <div class="login">
          <div class="container">
            <h1 style="font-family: Arial, sans-serif;">Iniciar Sesion</h1>
        
            <div class="login-form">
              <form action="" method="post">
                <input type="text" id="username_email" name="username_email" placeholder="Nombre de Usuario o Correo Electronico" required>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>

                <input type="hidden" name="log-in" class="form-control" value="si">
                <button type="submit">Iniciar Sesion</button>
    
              </form>
            </div>
        
          </div>
          </div>
      </div>
</body>
</html>
