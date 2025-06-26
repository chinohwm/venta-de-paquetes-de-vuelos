<?php
session_start();
include("conexion.php");

// Verificar sesión y obtener id_usuario
if (!isset($_SESSION['id_usuario']) || !isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Obtener datos del usuario
$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
<body>

<h1>Editar Perfil</h1>

<form method="POST" action="Procesar.Actualizacion/procesar_actualizacion_perfil.php">
    <!-- Campo oculto para ID -->
    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br><br>

    <label>Apellido:</label><br>
    <input type="text" name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required><br><br>

    <label>Contraseña (dejar vacío para no cambiar):</label><br>
    <input type="password" name="contraseña" autocomplete="new-password"><br><br>

    <button type="submit">Actualizar</button>
    <a href="index.php"><button type="button">Cancelar</button></a>
</form>
<br>

<!-- Botón para eliminar cuenta -->
<form method="POST" action="Eliminar/eliminar_cuenta.php" onsubmit="return confirm('⚠️ ¿Seguro que querés eliminar tu cuenta? Esta acción no se puede deshacer.')">
    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
    <button type="submit" style="background-color:red; color:white;">Eliminar cuenta</button>
</form>
</body>
</html>
