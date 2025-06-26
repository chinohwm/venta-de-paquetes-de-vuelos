<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="Style/procesar_reserva.css">
</head>
<body>
    <?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: carrito.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_paquete = $_POST['id_paquete'];
$precio = $_POST['precio'];

// Insertar reserva
$sql = "INSERT INTO reservas (id_usuario, id_paquete, precio, fecha_reserva) VALUES (?, ?, ?, NOW())";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iii", $id_usuario, $id_paquete, $precio);

if ($stmt->execute()) {
    echo "<h1>✅ Reserva confirmada</h1>";
    echo "<p>Tu paquete fue reservado correctamente.</p>";
    echo '<a href="index.php">Volver al inicio</a>';
} else {
    echo "❌ Error al realizar reserva: " . $stmt->error;
}
unset($_SESSION['carrito']);

?>

</body>
</html>