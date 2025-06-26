<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
</head>
<body>
    <?php
include("../conexion.php");

// Verificar si llega un id por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos actuales del usuario
    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Si existe el usuario
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "ID no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar usuario</title>
</head>
<body>
    <h1>Actualizar usuario</h1>
    <form action="../Procesar.Actualizacion/procesar_actualizacion_usuario.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required><br>

        <label>Correo:</label>
        <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required><br>

        <label>Contraseña:</label>
        <input type="text" name="contraseña" value="<?= htmlspecialchars($usuario['contraseña']) ?>" required><br>

        <label>ID Cargo:</label>
        <input type="number" name="id_cargo" value="<?= htmlspecialchars($usuario['id_cargo']) ?>" required><br>

        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="../admin.php">Volver</a>
</body>
</html>

</body>
</html>