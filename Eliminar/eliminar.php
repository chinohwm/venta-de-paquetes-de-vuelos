<?php
include("../conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

 
    $conexion->begin_transaction();

    try {
    
        $sql_compras = "DELETE FROM compras WHERE id_usuario = ?";
        $stmt_compras = $conexion->prepare($sql_compras);
        $stmt_compras->bind_param("i", $id);
        if (!$stmt_compras->execute()) {
            throw new Exception("Error al eliminar compras: " . $stmt_compras->error);
        }

        // Borramos usuario
        $sql_usuario = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt_usuario = $conexion->prepare($sql_usuario);
        $stmt_usuario->bind_param("i", $id);
        if (!$stmt_usuario->execute()) {
            throw new Exception("Error al eliminar usuario: " . $stmt_usuario->error);
        }

        // Commit si todo salió bien
        $conexion->commit();

        header("Location: ../admin.php");
        exit();

    } catch (Exception $e) {
        // Revertimos cambios si hubo error
        $conexion->rollback();
        echo $e->getMessage();
    }

} else {
    echo "ID no proporcionado.";
}
?>
