<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
</head>
<body>
      <?php
include("../conexion.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

  
    $sql = "DELETE FROM compras WHERE id_compras = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
       
        header("Location: ../admin.php");
        exit();
    } else {
        echo "Error al eliminar el registro.";
    }
} else {
    echo "ID no proporcionado.";
}
?>

</body>
</html>