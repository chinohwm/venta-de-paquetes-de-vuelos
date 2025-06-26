<?php
include("../conexion.php");

// Verificar si llega un id por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar datos actuales de la compra
    $sql = "SELECT * FROM compras WHERE id_compras = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $compra = $resultado->fetch_assoc();
    } else {
        echo "Compra no encontrada.";
        exit();
    }
} else {
    echo "ID no proporcionado.";
    exit();
}

// Consultar usuarios
$sql_usuarios = "SELECT id_usuario, nombre FROM usuarios";
$result_usuarios = $conexion->query($sql_usuarios);

// Consultar paquetes
$sql_paquetes = "SELECT id_paquetes, hotel FROM paquetes";
$result_paquetes = $conexion->query($sql_paquetes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar compra</title>
</head>
<body>
    <h1>Actualizar compra</h1>

    <form action="../Procesar.Actualizacion/procesar_actualizacion_compras.php" method="POST">
        <input type="hidden" name="id_compras" value="<?= htmlspecialchars($compra['id_compras']) ?>">

        <label>Usuario:</label>
        <select name="id_usuario" required>
            <?php while ($usuario = $result_usuarios->fetch_assoc()): ?>
                <option value="<?= $usuario['id_usuario'] ?>"
                    <?= $usuario['id_usuario'] == $compra['id_usuario'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($usuario['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Paquete (Hotel):</label>
        <select name="paquete" required>
            <?php while ($paquete = $result_paquetes->fetch_assoc()): ?>
                <option value="<?= $paquete['id_paquetes'] ?>"
                    <?= $paquete['id_paquetes'] == $compra['paquete'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($paquete['hotel']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Día de la compra:</label>
        <input type="date" name="dia_compra" value="<?= htmlspecialchars($compra['dia_compra']) ?>" required><br><br>

        <label>Precio:</label>
        <input type="number" name="precio" value="<?= htmlspecialchars($compra['precio']) ?>" required><br><br>

        <input type="submit" value="Actualizar">
    </form>

    <br>
    <a href="/viajes/admin.php">← Volver</a>
</body>
</html>
