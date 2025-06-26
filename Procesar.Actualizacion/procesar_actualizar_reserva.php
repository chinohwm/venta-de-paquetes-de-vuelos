<?php
session_start();
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_reserva = $_POST['id_reserva'];
    $id_paquete = $_POST['id_paquete'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $estado = $_POST['estado'];

    $sql = "UPDATE reservas 
            SET id_paquete = ?, fecha_reserva = ?, estado = ?
            WHERE id_reserva = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("issi", $id_paquete, $fecha_reserva, $estado, $id_reserva);

    if ($stmt->execute()) {
        header("Location: ../admin.php");
        exit();
    } else {
        echo "Error al actualizar la reserva: " . $stmt->error;
    }
} else {
    header("Location: ../admin.php");
    exit();
}
