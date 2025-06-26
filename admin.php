<?php
session_start();
include("conexion.php");

// Consulta de usuarios con INNER JOIN a cargo
$sql_usuarios = "SELECT u.*, c.descripcion AS nombre_cargo 
                 FROM usuarios u 
                 INNER JOIN cargo c ON u.id_cargo = c.id";

$datos_usuarios = $conexion->prepare($sql_usuarios);
$datos_usuarios->execute();
$resultado_usuarios = $datos_usuarios->get_result();
$registros_usuarios = $resultado_usuarios->fetch_all(MYSQLI_ASSOC);

// Consulta de compras con JOIN a usuarios y paquetes
$sql_compras = "SELECT c.id_compras, u.nombre AS nombre_usuario, p.hotel AS nombre_paquete, c.dia_compra, c.precio 
                FROM compras c 
                INNER JOIN usuarios u ON c.id_usuario = u.id_usuario 
                INNER JOIN paquetes p ON c.paquete = p.id_paquetes";
$datos_compras = $conexion->prepare($sql_compras);
$datos_compras->execute();
$resultado_compras = $datos_compras->get_result();
$registros_compras = $resultado_compras->fetch_all(MYSQLI_ASSOC);

// Consulta de paquetes
$sql_paquetes = "SELECT * FROM paquetes";
$datos_paquetes = $conexion->prepare($sql_paquetes);
$datos_paquetes->execute();
$resultado_paquetes = $datos_paquetes->get_result();
$registros_paquetes = $resultado_paquetes->fetch_all(MYSQLI_ASSOC);

// Consulta de reservas
$sql_reservas = "SELECT r.id_reserva, u.nombre AS nombre_usuario, p.hotel AS nombre_paquete, r.fecha_reserva, r.precio ,r.estado
                 FROM reservas r
                 INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
                 INNER JOIN paquetes p ON r.id_paquete = p.id_paquetes";
$datos_reservas = $conexion->prepare($sql_reservas);
$datos_reservas->execute();
$resultado_reservas = $datos_reservas->get_result();
$registros_reservas = $resultado_reservas->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Admin</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #555;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #ccc;
        }
        h1, h2 {
            margin-top: 30px;
        }
    </style>
    <link rel="stylesheet" href="Style/admin.css">
</head>
<body>
    <h1>Página Administrador</h1>

    <!-- Tabla de Usuarios -->
    <h2>Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($registros_usuarios) > 0): ?>
            <?php foreach ($registros_usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id_usuario'] ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['apellido']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario['contraseña']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre_cargo']) ?></td>
                    <td><a href="/viajes/Eliminar/eliminar.php?id=<?= $usuario['id_usuario'] ?>">Eliminar</a></td>
                    <td><a href="/viajes/Actualizar/actualizar_usuario.php?id=<?= $usuario['id_usuario'] ?>">Actualizar</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No se encontraron registros de usuarios.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Tabla de Compras -->
    <h2>Compras Realizadas</h2>
    <table>
        <thead>
            <tr>
                <th>ID Compra</th>
                <th>Usuario</th>
                <th>Paquete (Hotel)</th>
                <th>Día Compra</th>
                <th>Precio</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($registros_compras) > 0): ?>
            <?php foreach ($registros_compras as $compra): ?>
                <tr>
                    <td><?= $compra['id_compras'] ?></td>
                    <td><?= htmlspecialchars($compra['nombre_usuario']) ?></td>
                    <td><?= htmlspecialchars($compra['nombre_paquete']) ?></td>
                    <td><?= htmlspecialchars($compra['dia_compra']) ?></td>
                    <td>$<?= number_format($compra['precio'], 0, ',', '.') ?></td>
                    <td><a href="/viajes/Eliminar/eliminar_compras.php?id=<?= $compra['id_compras'] ?>">Eliminar</a></td>
                    <td><a href="/viajes/Actualizar/actualizar_compras.php?id=<?= $compra['id_compras'] ?>">Actualizar</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No se encontraron registros de compras.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <!-- Tabla de Paquetes -->
    <h2>Paquetes Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>ID Paquete</th>
                <th>Destino</th>
                <th>Hotel</th>
                <th>Transporte</th>
                <th>Pasajeros</th>
                <th>Estancia</th>
                <th>Precio</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($registros_paquetes) > 0): ?>
            <?php foreach ($registros_paquetes as $paquete): ?>
                <tr>
                    <td><?= $paquete['id_paquetes'] ?></td>
                    <td><?= htmlspecialchars($paquete['destino']) ?></td>
                    <td><?= htmlspecialchars($paquete['hotel']) ?></td>
                    <td><?= htmlspecialchars($paquete['transporte']) ?></td>
                    <td><?= htmlspecialchars($paquete['Pasajeros']) ?></td>
                    <td><?= htmlspecialchars($paquete['estancia']) ?></td>
                    <td>$<?= number_format($paquete['precio'], 0, ',', '.') ?></td>
                    <td><a href="/viajes/Eliminar/eliminar_paquetes.php?id=<?= $paquete['id_paquetes'] ?>">Eliminar</a></td>
                    <td><a href="/viajes/Actualizar/actualizar_paquetes.php?id=<?= $paquete['id_paquetes'] ?>">Actualizar</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No se encontraron paquetes disponibles.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <a href="crear_paquetes.php">
        <button>Añadir Paquetes</button>
    </a>

            
            <!-- Tabla de Reservas -->
<h2>Reservas Realizadas</h2>
<table>
    <thead>
        <tr>
            <th>ID Reserva</th>
            <th>Usuario</th>
            <th>Paquete (Hotel)</th>
            <th>Fecha Reserva</th>
            <th>Precio</th>
            <th>Estado</th>
            <th colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($registros_reservas) > 0): ?>
        <?php foreach ($registros_reservas as $reserva): ?>
            <tr>
                <td><?= $reserva['id_reserva'] ?></td>
                <td><?= htmlspecialchars($reserva['nombre_usuario']) ?></td>
                <td><?= htmlspecialchars($reserva['nombre_paquete']) ?></td>
                <td><?= htmlspecialchars($reserva['fecha_reserva']) ?></td>
                <td>$<?= number_format($reserva['precio'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($reserva['estado']) ?></td>
                <td><a href="/viajes/Eliminar/eliminar_reservas.php?id=<?= $reserva['id_reserva'] ?>">Eliminar</a></td>
                <td><a href="/viajes/Actualizar/actualizar_reserva.php?id=<?= $reserva['id_reserva'] ?>">Actualizar</a></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7">No se encontraron reservas registradas.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
