<?php
include("conexion.php");

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar que todos los campos estén presentes
    if (
        isset($_POST["destino"], $_POST["hotel"], $_POST["transporte"], 
              $_POST["Pasajeros"], $_POST["estancia"], $_POST["precio"])
    ) {
        // Sanitizar y guardar datos
        $destino = trim($_POST["destino"]);
        $hotel = trim($_POST["hotel"]);
        $transporte = trim($_POST["transporte"]);
        $pasajeros = intval($_POST["Pasajeros"]);
        $estancia = intval($_POST["estancia"]);
        $precio = trim($_POST["precio"]); // puede ser string si tu campo es VARCHAR

        // Insertar en la base de datos
        $sql = "INSERT INTO paquetes (destino, hotel, transporte, Pasajeros, estancia, precio)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssiss", $destino, $hotel, $transporte, $pasajeros, $estancia, $precio);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>✅ Paquete añadido correctamente.</p>";
        } else {
            echo "<p style='color: red;'>❌ Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color: red;'>❌ Faltan datos en el formulario.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Paquete</title>
</head>
<body>
    <h1>🧳 Añadir nuevo paquete</h1>
    <form action="" method="POST">
        <label>Destino:</label><br>
        <input type="text" name="destino" required><br><br>

        <label>Hotel:</label><br>
        <input type="text" name="hotel" required><br><br>

        <label>Transporte:</label><br>
        <input type="text" name="transporte" required><br><br>

        <label>Pasajeros:</label><br>
        <input type="number" name="Pasajeros" min="1" required><br><br>

        <label>Estancia (días):</label><br>
        <input type="number" name="estancia" min="1" required><br><br>

        <label>Precio (ej: 97.000):</label><br>
        <input type="text" name="precio" required><br><br>

        <input type="submit" value="Añadir paquete">
    </form>

    <br>
    <a href="admin.php">← Volver al panel</a>
</body>
</html>
