<?php
include("../conexion.php");

// Verificar si llegaron todos los datos por POST
if (isset($_POST['id_compras'], $_POST['id_usuario'], $_POST['paquete'], $_POST['dia_compra'], $_POST['precio'])) {
    $id_compras = $_POST['id_compras'];
    $id_usuario = $_POST['id_usuario'];
    $paquete = $_POST['paquete'];
    $dia_compra = $_POST['dia_compra'];
    $precio = $_POST['precio'];

    // Preparar y ejecutar consulta de actualización
    $sql = "UPDATE compras SET id_usuario = ?, paquete = ?, dia_compra = ?, precio = ? WHERE id_compras = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iisii", $id_usuario, $paquete, $dia_compra, $precio, $id_compras);

    if ($stmt->execute()) {
        echo "✅ Compra actualizada correctamente.<br>";
    } else {
        echo "❌ Error al actualizar compra: " . $stmt->error;
    }

    echo '<br><a href="../admin.php">← Volver al panel de administración</a>';
} else {
    echo "❌ Faltan datos para actualizar.";
}
?>
