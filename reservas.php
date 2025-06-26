<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="Style/reservas.css">
</head>
<body>
    <?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario']) || !isset($_GET['index'])) {
    header("Location: carrito.php");
    exit();
}

$index = $_GET['index'];
if (!isset($_SESSION['carrito'][$index])) {
    echo "❌ Paquete no encontrado.";
    exit();
}

$paquete = $_SESSION['carrito'][$index];
?>

<h1>Confirmar Reserva</h1>

<p><strong>Destino:</strong> <?= htmlspecialchars($paquete['destino']) ?></p>
<p><strong>Hotel:</strong> <?= htmlspecialchars($paquete['hotel']) ?></p>
<p><strong>Transporte:</strong> <?= htmlspecialchars($paquete['transporte']) ?></p>
<p><strong>Pasajeros:</strong> <?= htmlspecialchars($paquete['Pasajeros']) ?></p>
<p><strong>Estancia:</strong> <?= htmlspecialchars($paquete['estancia']) ?></p>
<p><strong>Precio:</strong> $<?= htmlspecialchars($paquete['precio']) ?></p>

<form method="POST" action="procesar_reserva.php">
    <input type="hidden" name="id_paquete" value="<?= $paquete['id_paquetes'] ?>">
    <input type="hidden" name="precio" value="<?= $paquete['precio'] ?>">
    <button type="submit">Confirmar Reserva</button>
</form>

<a href="carrito.php">← Volver al carrito</a>

</body>
</html>