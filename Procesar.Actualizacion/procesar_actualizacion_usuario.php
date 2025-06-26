<?php
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos enviados por el formulario
    $id = $_POST['id_usuario'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $id_cargo = $_POST['id_cargo'] ?? null;

    if ($id && $nombre && $apellido && $correo && $contraseña && $id_cargo) {
     
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, contraseña = ?, id_cargo = ? WHERE id_usuario = ?";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

       
        $stmt->bind_param("ssssii", $nombre, $apellido, $correo, $contraseña, $id_cargo, $id);

       
        if ($stmt->execute()) {
            
            header("Location: ../admin.php");
            exit();
        } else {
            echo "Error al actualizar el usuario: " . $stmt->error;
        }
    } else {
        echo "Faltan datos obligatorios.";
    }
} else {
    echo "Acceso no válido.";
}
