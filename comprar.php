<?php
session_start();
include("conexion.php");

// Función para formatear precios
function formatear_precio($precio) {
    return "$" . number_format((int)$precio, 0, ',', '.');
}

// Verificar sesión iniciada
if (!isset($_SESSION['correo'])) {
    header("Location: Secion.php");
    exit;
}

// Buscar id_usuario según el correo en sesión
$correo = $_SESSION['correo'];
$sql_user = "SELECT id_usuario FROM usuarios WHERE correo = ?";
$stmt_user = $conexion->prepare($sql_user);
$stmt_user->bind_param("s", $correo);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $id_usuario = $row_user['id_usuario'];
} else {
    echo "❌ Usuario no encontrado.";
    exit;
}

// Validar carrito
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
    echo "❌ No hay paquetes en el carrito.";
    exit;
}

// Procesar compras
foreach ($_SESSION['carrito'] as $item) {
    if (!isset($item['id_paquetes'])) {
        echo "❌ Error: Paquete sin ID.";
        exit;
    }

    $id_paquete = $item['id_paquetes'];

    // Validar y convertir precio a entero seguro
    if (!isset($item['precio']) || !is_numeric($item['precio'])) {
        echo "❌ Error: Precio no válido.";
        exit;
    }
    $precio = intval($item['precio']);

    // Insertar compra
    $sql = "INSERT INTO compras (id_usuario, paquete, precio) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iii", $id_usuario, $id_paquete, $precio);

    if (!$stmt->execute()) {
        echo "❌ Error al insertar compra: " . $stmt->error;
        exit;
    }
}

// Vaciar carrito
$_SESSION['carrito'] = [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra realizada</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .carrito-btn {
            display: inline-block;
            padding: 10px 18px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .carrito-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>✅ ¡Compra confirmada!</h1>
    <p>Gracias por tu compra, <?= htmlspecialchars($correo) ?>.</p>
    <p>Tu pedido ha sido procesado correctamente.</p>

    <a href="index.php" class="carrito-btn">← Volver al inicio</a>

</body>
</html>
