<?php
session_start();
include("../conexion.php");

// Verificar si recibimos el ID por GET
if (!isset($_GET['id'])) {
    header("Location: ../admin.php");
    exit();
}

$id_reserva = $_GET['id'];

// Obtener datos de la reserva + nombre de usuario
$sql = "SELECT r.*, u.nombre 
        FROM reservas r
        INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
        WHERE r.id_reserva = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_reserva);
$stmt->execute();
$resultado = $stmt->get_result();
$reserva = $resultado->fetch_assoc();

if (!$reserva) {
    echo "Reserva no encontrada.";
    exit();
}

// Obtener lista de paquetes para el select
$sql_paquetes = "SELECT * FROM paquetes";
$res_paquetes = $conexion->query($sql_paquetes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Reserva</title>
</head>
<body>

<h1>Actualizar Reserva</h1>

<form method="POST" action="../Procesar.Actualizacion/procesar_actualizar_reserva.php">
    <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva'] ?>">

    <label>Usuario:</label>
    <input type="text" value="<?= htmlspecialchars($reserva['nombre']) ?>" disabled><br><br>

    <label>Paquete:</label>
    <select name="id_paquete" required>
        <?php while ($paquete = $res_paquetes->fetch_assoc()): ?>
            <option value="<?= $paquete['id_paquetes'] ?>" 
                <?= ($paquete['id_paquetes'] == $reserva['id_paquete']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($paquete['destino']) ?> - <?= htmlspecialchars($paquete['hotel']) ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Día de Reserva:</label>
    <input type="date" name="fecha_reserva" value="<?= $reserva['fecha_reserva'] ?>" required>


    <label>Estado:</label>
    <select name="estado" required>
        <option value="Pendiente" <?= ($reserva['estado'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
        <option value="Confirmada" <?= ($reserva['estado'] == 'Confirmada') ? 'selected' : '' ?>>Confirmada</option>
        <option value="Cancelada" <?= ($reserva['estado'] == 'Cancelada') ? 'selected' : '' ?>>Cancelada</option>
    </select><br><br>

    <button type="submit">Actualizar Reserva</button>
    <a href="../admin.php"><button type="button">Cancelar</button></a>
</form>

</body>
</html>
