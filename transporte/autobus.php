<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autobus</title>
    <link rel="stylesheet" href="../Style/autobus.css">
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
    <h1>Viaja en autobus</h1>
    <p>Nuestros exelentes precios te ayudaran a planificar un viaje hermoso </p>

    <div>
        <div>
            <a href="../Hoteles/Park_hyatt/pagina/Park_Hyatt.php">
                <img src="../Hoteles/Park_hyatt/fotos/Park_Hyatt.png" alt="">
                <p>Hotel Park Hyatt</p>
            </a>
            <a href="../carrito.php?id_paquetes=2" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
        <div>
            <a href="../Hoteles/Hotel_virgo/pagina/hotel_virgo.php">
                <img src="../Hoteles/Hotel_virgo/fotos/Hotel-virgo.png" alt="">
                <p>Hotel virgo</p>
            </a>
             <a href="../carrito.php?id_paquetes=3" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
        <div>
            <a href="../Hoteles/Hotel_hualta/pagina/hualta_hotel.php">
                 <img src="../Hoteles/Hotel_hualta/fotos/Hualta-hotel.png" alt="">
                <p>Hotel hualta </p>
            </a>
             <a href="../carrito.php?id_paquetes=4" class="carrito-btn">🛒 Agregar al carrito</a>
        </div>
        <div>
            <a href="../Hoteles/Hotel_diplomatic/pagina/diplomatic.php">
                <img src="../Hoteles/Hotel_diplomatic/fotos/diplomatic_hotel.png" alt="">
                <p>Diplomatic hotel</p>
            </a>
               <a href="../carrito.php?id_paquetes=5" class="carrito-btn">🛒 Agregar al carrito</a> 
        </div>
    </div>
     <br>
       <a href="../carrito.php" class="carrito-btn">🛒 Ver carrito</a>
</body>
</html>