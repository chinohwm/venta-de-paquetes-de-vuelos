<?php
session_start();
include("../conexion.php");

// Verificar que viene el ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id = $_POST['id_usuario'];

    // Borrar usuario
    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Si el usuario se elimina correctamente:
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        echo "❌ Error al eliminar la cuenta: " . $stmt->error;
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
