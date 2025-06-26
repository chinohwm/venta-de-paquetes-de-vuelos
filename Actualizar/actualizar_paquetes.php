<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM paquetes WHERE id_paquetes = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "Paquete no encontrado.";
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
    <title>Actualizar paquete</title>
</head>
<body>
    <h1>Actualizar Paquete</h1>
    <form action="../Procesar.Actualizacion/procesar_actualizacion_paquetes.php" method="POST">
        <input type="hidden" name="id_paquetes" value="<?= htmlspecialchars($usuario['id_paquetes']) ?>">

        <label>Destino:</label>
        <input type="text" name="destino" value="<?= htmlspecialchars($usuario['destino']) ?>" required><br>

        <label>Hotel:</label>
        <input type="text" name="hotel" value="<?= htmlspecialchars($usuario['hotel']) ?>" required><br>

        <label>Transporte:</label>
        <input type="text" name="transporte" value="<?= htmlspecialchars($usuario['transporte']) ?>" required><br>

        <label>Pasajeros:</label>
        <input type="number" name="Pasajeros" value="<?= htmlspecialchars($usuario['Pasajeros']) ?>" required><br>

        <label>Estancia (en días):</label>
        <input type="text" name="estancia" value="<?= htmlspecialchars($usuario['estancia']) ?>" required><br>

        <label>Precio:</label>
        <input type="number" name="precio" value="<?= htmlspecialchars($usuario['precio']) ?>" required><br>

        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="/viajes/admin.php">Volver</a>
</body>
</html>
