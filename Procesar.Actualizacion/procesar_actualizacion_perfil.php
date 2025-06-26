<?php
session_start();
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_usuario'];

    // Obtener datos actuales del usuario
    $sql_select = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt_select = $conexion->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();
    $usuario_actual = $resultado->fetch_assoc();

    if (!$usuario_actual) {
        echo "Usuario no encontrado.";
        exit();
    }

    // Tomar datos del form o mantener los actuales si están vacíos (excepto contraseña)
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : $usuario_actual['nombre'];
    $apellido = !empty($_POST['apellido']) ? $_POST['apellido'] : $usuario_actual['apellido'];
    $correo = !empty($_POST['correo']) ? $_POST['correo'] : $usuario_actual['correo'];

    // Si contraseña enviada no está vacía, actualizarla, sino mantener la actual
    if (!empty($_POST['contraseña'])) {
        $contraseña = $_POST['contraseña'];
        $sql_update = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, contraseña = ? WHERE id_usuario = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("ssssi", $nombre, $apellido, $correo, $contraseña, $id);
    } else {
        $sql_update = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ? WHERE id_usuario = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("sssi", $nombre, $apellido, $correo, $id);
    }

    if ($stmt_update->execute()) {
        // Si el usuario actualizado es el que está logueado, actualizamos las variables de sesión
        if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == $id) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['correo'] = $correo;
        }

        header("Location: ../index.php");
        exit();
    } else {
        echo "Error al actualizar: " . $stmt_update->error;
    }

} else {
    header("Location: ../index.php");
    exit();
}
?>

