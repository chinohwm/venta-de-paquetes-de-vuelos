<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viajes</title>
    <link rel="stylesheet" href="Style/index.css">
</head>
<body>

    <img src="recursos/vibes.png" alt="">
    <h1>Bienvenido a vuela lejos viajes</h1>

    <?php if (isset($_SESSION['id_usuario'])): ?>
        <p>✅ Bienvenido, <strong><?= htmlspecialchars($_SESSION['nombre']) ?></strong> 👋</p>

        <a href="editar_perfil.php?id=<?= $_SESSION['id_usuario'] ?>">
            <button>Editar Perfil</button>
        </a>

        <a href="logout.php">
            <button>Cerrar sesión</button>
        </a>
        <a href="ver_reservas.php">
            <button>Ver reservas</button>
        </a>
    <?php else: ?>
        <p>En vuela lejos viajes buscamos brindarte la mejor experiencia para que disfrutes de tu viaje al máximo. Seguro encontras el ideal para vos. ¿Qué esperás para viajar con nosotros?</p>

        <a href="registrarse.php">
            <button>Registrarse</button>
        </a>
        <br><br>
        <a href="Secion.php">
            <button>Iniciar Sesión</button>
        </a>
    <?php endif; ?>

    <div>
        <div>
            <a href="transporte/autobus.php">
                <img src="recursos/autobus.png" alt="">
            </a>
        </div>
        <div>
            <a href="transporte/vuelos.php">
                <img src="recursos/avion.png" alt="">
            </a>
        </div>
    </div>

</body>
</html>
