<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>Accesorios</title>
		<link rel="icon" type="image/x-icon" href="imagenes/LogoRelojeria.png">
		<link rel="stylesheet" href="accesorios.css" />

		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
			integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		/>
		<!-- PARA EL CARRITO-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="carrito.css">
		<script src="carrito.js" async></script>
	</head>
	<body>
		<header>
			<div class="barra"> 
				<h2>Menu<img src="imagenes/menu.png" alt="Menu" style="width: 40px; cursor: pointer;"></h2>
				<ul>
					<li><a href="index.php">Inicio</a></li>
					<li><a href="#">Mas populares</a></li>
					<li><a href="tus_compras.php">Tus compras</a></li>
					<li>
                        <ul>
                            <li><a href="principal-relojes-caballeros.php">Relojes para Caballeros</a></li>
                            <li><a href="principal-relojes-damas.php">Relojes para Dama</a></li>
                        </ul>
                    </li>
					<li><a href="accesorios.php">Accesorios</a></li>
					<li><a href="#">Contacto</a></li>
				</ul>
			</div>
			
			<div style="display:flex; align-items: center; margin-left: -150px;">
				<img src="imagenes/LogoRelojeria.png" alt="Logo" style="width: 100px; height: 100px; margin-left: 200px;">
				<h2 style="color:aliceblue">CRONOS</h2>
			</div>
			
			
			
		</header>

		
			<h1>Tus Compras</h1>
			<div id="contenedor-compras">
				<!-- Aquí se mostrarán los productos comprados -->
			</div>
	
        <script src="tus_compras.js" defer></script>
	</body>
</html>