<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuelos</title>
    <link rel="stylesheet" href="../Style/vuelos.css">
</head>
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
    </style>
<body>
    <h1>¡Viaja en avion!</h1>
    <p>Los mejores vuelos son con Viaja lejos viajes </p>
    <div> 
        <div>
            <a href="../Hoteles/Lagos_andinos/pagina/lagos_andinos.php">
                <img src="../Hoteles/Lagos_andinos/fotos/lagos_andinos.png" alt="">
                <P>Lagos andinos </P>
            </a>
            <a href="../carrito.php?id_paquetes=6" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
        <div>
            <a href="../Hoteles/Atlantico_madrid/pagina/Atlantico_madrid.php">
                <img src="../Hoteles/Atlantico_madrid/fotos/Atlantico1.png" alt="">
                <p>Hotel Atlantico Madrid</p>
            </a>
            <a href="../carrito.php?id_paquetes=7" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
        <div>
            <a href="../Hoteles/Ustedalen/pagina/Ustedalen.php">
                <img src="../Hoteles/Ustedalen/fotos/Ustedalen1.png" alt="">
                <p>Ustedalen Resort Leiligheter</p>
            </a>
            <a href="../carrito.php?id_paquetes=8" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
        <div>
            <a href="../Hoteles/Wynn_vegas/pagina/Wynn_vegas.php">
                 <img src="../Hoteles/Wynn_vegas/fotos/Wynn_vegas.png" alt="">
                <p>Wynn Las Vegas</p>
            </a>
            <a href="../carrito.php?id_paquetes=9" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
    </div>
    <br>
       <a href="../carrito.php" class="carrito-btn">🛒 Ver carrito</a>
</body>
</html>