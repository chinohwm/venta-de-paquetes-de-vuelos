<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secion</title>
    <link rel="stylesheet" href="Style/sesion.css">
</head>
<body>
    <h1>Iniciar Secion</h1>
    <p>Llena los siguientes campos para poder iniciar secion </p>
    
    <form action="controlador.php" name="Sesion" method="get" required>
     <input type="email" name="Correo" placeholder="Correo electronico" required>
     <input type="password" name="Contraseña" placeholder="Contraseña" required>
    
     
     <input type="submit" name="Iniciar_Sesion" value="Iniciar Sesion">
     <input type="reset">
   

     </form> 
        <br>
        <p>¿No tienes una cuenta ? Inicia sesion aqui</p>
        <a href="registrarse.php">
            <button>Registrarse</button>
        </a>
</body>
<?php
include("conexion.php");

?>
</html>