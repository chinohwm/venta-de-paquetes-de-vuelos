<?php
session_start();
include("conexion.php");

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar paquete al carrito si se recibe por GET
if (isset($_GET['id_paquetes'])) {
    $id_paquetes = $_GET['id_paquetes'];

    $sql = "SELECT * FROM paquetes WHERE id_paquetes = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_paquetes);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $paquete = $resultado->fetch_assoc();
        $_SESSION['carrito'][] = $paquete;
    }

    // Redireccionar para evitar recarga duplicada
    header("Location: carrito.php");
    exit;
}

// Eliminar elemento del carrito si se recibe por GET
if (isset($_GET['eliminar'])) {
    $pos = $_GET['eliminar'];
    if (isset($_SESSION['carrito'][$pos])) {
        unset($_SESSION['carrito'][$pos]);
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }

    // Redireccionar para evitar recarga duplicada
    header("Location: carrito.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
    <style>
        .carrito-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 5px;
        }
        .carrito-btn:hover {
            background-color: #0056b3;
        }
        .eliminar-btn {
            color: red;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
    <link rel="stylesheet" href="Style/carrito.css">
</head>
<body>
    <h1>Carrito de compras</h1>

    <?php if (count($_SESSION['carrito']) > 0): ?>
        <ul>
            <?php foreach ($_SESSION['carrito'] as $index => $item): ?>
                <li>
                    <strong><?= htmlspecialchars($item['hotel']) ?></strong> en <?= htmlspecialchars($item['destino']) ?> -
                    Transporte: <?= htmlspecialchars($item['transporte']) ?> -
                    Pasajeros: <?= htmlspecialchars($item['Pasajeros']) ?> -
                    Estancia: <?= htmlspecialchars($item['estancia']) ?> -
                    Precio: $<?= htmlspecialchars($item['precio']) ?>
                    <a href="carrito.php?eliminar=<?= $index ?>" class="eliminar-btn">❌</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="comprar.php" class="carrito-btn">✔️ Confirmar compra</a>

    <?php else: ?>
        <p>Tu carrito está vacío.</p>
    <?php endif; ?>

    <a href="index.php" class="carrito-btn">← Seguir viendo hoteles</a>
    <br>
   <a href="reservas.php?index=<?= $index ?>" class="carrito-btn">Reservar</a>

</body>
</html>
