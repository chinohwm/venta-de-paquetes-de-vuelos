<?php
session_start();
include("../conexion.php");

if (!isset($_GET['id']) || !isset($_GET['estado'])) {
    header("Location: ../ver_reservas.php");
    exit;
}

$id_reserva = $_GET['id'];
$nuevo_estado = $_GET['estado'];

$sql = "UPDATE reservas SET estado = ? WHERE id_reserva = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("si", $nuevo_estado, $id_reserva);
$stmt->execute();

header("Location: ../ver_reservas.php");
exit;
?>
