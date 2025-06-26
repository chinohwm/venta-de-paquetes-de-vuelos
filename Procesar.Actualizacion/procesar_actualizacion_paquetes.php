<?php
include("../conexion.php");

// Verificar si llegaron los datos necesarios por POST
if (
    isset($_POST['id_paquetes']) &&
    isset($_POST['destino']) &&
    isset($_POST['hotel']) &&
    isset($_POST['transporte']) &&
    isset($_POST['Pasajeros']) &&
    isset($_POST['estancia']) &&
    isset($_POST['precio'])
) {
    // Guardar datos en variables
    $id_paquetes = $_POST['id_paquetes'];
    $destino = $_POST['destino'];
    $hotel = $_POST['hotel'];
    $transporte = $_POST['transporte'];
    $pasajeros = $_POST['Pasajeros'];
    $estancia = $_POST['estancia'];
    $precio = $_POST['precio'];

    // Consulta para actualizar paquete
    $sql = "UPDATE paquetes 
            SET destino = ?, hotel = ?, transporte = ?, Pasajeros = ?, estancia = ?, precio = ?
            WHERE id_paquetes = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssissi", $destino, $hotel, $transporte, $pasajeros, $estancia, $precio, $id_paquetes);

    if ($stmt->execute()) {
        // Si se actualizó correctamente
        header("Location: ../admin.php?mensaje=Paquete actualizado con éxito");
        exit();
    } else {
        echo "❌ Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();

} else {
    echo "❌ Faltan datos del formulario.";
}
?>
