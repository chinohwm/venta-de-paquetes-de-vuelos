<?php
session_start();
include("conexion.php");

// Verificar sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Secion.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Consultar reservas del usuario
$sql = "SELECT r.*, p.destino, p.hotel 
        FROM reservas r
        INNER JOIN paquetes p ON r.id_paquete = p.id_paquetes
        WHERE r.id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Reservas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            padding: 8px;
            border: 1px solid #555;
            text-align: center;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
        .confirmar { background-color: green; }
        .cancelar { background-color: red; }
    </style>
    <link rel="stylesheet" href="Style/ver_reservas.css">
</head>
<body>

<h1 style="text-align: center;">Mis Reservas</h1>

<table>
    <thead>
        <tr>
            <th>ID Reserva</th>
            <th>Destino</th>
            <th>Hotel</th>
            <th>Fecha Reserva</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($reserva = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $reserva['id_reserva'] ?></td>
                    <td><?= htmlspecialchars($reserva['destino']) ?></td>
                    <td><?= htmlspecialchars($reserva['hotel']) ?></td>
                    <td><?= htmlspecialchars($reserva['fecha_reserva']) ?></td>
                    <td><?= htmlspecialchars($reserva['estado']) ?></td>
                    <td>
                        <?php if ($reserva['estado'] == 'pendiente'): ?>
                            <a href="Procesar.Actualizacion/cambiar_estado_reserva.php?id=<?= $reserva['id_reserva'] ?>&estado=Confirmada">
                                <button class="btn confirmar">Confirmar</button>
                            </a>
                            <a href="Procesar.Actualizacion/cambiar_estado_reserva.php?id=<?= $reserva['id_reserva'] ?>&estado=Cancelada">
                                <button class="btn cancelar">Cancelar</button>
                            </a>
                        <?php else: ?>
                            Sin acciones
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No tenés reservas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="index.php" style="display: block; text-align: center;">← Volver al inicio</a>

</body>
</html>
