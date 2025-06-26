<?php
session_start();
include("../conexion.php");

// Validar que venga el ID de reserva
if (!isset($_GET['id'])) {
    header("Location: ../admin.php");
    exit();
}

$id_reserva = $_GET['id'];

// Intentar eliminar la reserva
$sql = "DELETE FROM reservas WHERE id_reserva = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_reserva);

if ($stmt->execute()) {
    header("Location: ../admin.php");
    exit();
} else {
    echo "❌ Error al eliminar la reserva: " . $stmt->error;
}
?>
