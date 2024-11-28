<?php
session_start();

// Verificar si el usuario está logueado
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
$usuario_nombre = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : null;

// Manejar el cierre de sesión
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cronos</title>
    <link rel="stylesheet" href="index.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/imagenes/LogoRelojeria.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <script src="carrito.js" defer></script>
</head>
<body>
    <div class="barra"> 
        <h2>Menu<img src="imagenes/menu.png" alt="Menu" style="width: 40px; cursor: pointer;"></h2>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="principal-populares.php">Mas populares</a></li>
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
    <header style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
        
        <div class="search-container" style="display: flex; align-items: center; margin-left: 70px;">
            <img src="imagenes/buscar.png" alt="Buscar.icon" style="width: 50px; cursor: pointer;">
            <input type="text" placeholder="Buscar" id="buscar" class="search-bar">
        </div>
        
        <div style="display:flex; align-items: center; margin-left: -150px;">
            <img src="imagenes/LogoRelojeria.png" alt="Logo" style="width: 100px; height: 100px; margin-left: 200px;">
            <h2 style="color:aliceblue">CRONOS</h2>
        </div>
        
        <div style="display: flex; align-items: center; position: relative;">
            <?php if ($usuario_id): ?>
                <!-- Nombre del usuario logueado -->
                <span class="nombre_logueado" style="cursor: pointer;" 
                    onclick="document.getElementById('logoutForm').style.display='block';">
                    <?php echo htmlspecialchars($usuario_nombre); ?>
                </span>
            <?php else: ?>
                <!-- Imagen del login si no está logueado -->
                <a href="login.php">
                    <img src="imagenes/usuario.png" id="icono_user" alt="User Icon" 
                        style="width: 40px; height: 40px; cursor: pointer;">
                </a>
            <?php endif; ?>

            <!-- Formulario para cerrar sesión -->
            <div id="logoutForm" style="top: 30px; left: 0;">
                <form method="POST" action="">
                    <p>¿Seguro que quieres cerrar sesión?</p>
                    <button type="submit" name="logout">Cerrar sesión</button>
                    <button type="button" onclick="document.getElementById('logoutForm').style.display='none';">
                        Cancelar
                    </button>
                </form>
            </div>
        </div>



        <div class="menu-header">
            <button id="button-header-favorite">
                <i class="fa-solid fa-heart"></i>
                <span class="counter-favorite">0</span>
            </button>
            <button class="cart-button">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="counter-cart">0</span>
            </button>
        </div>
        <!-- Carrito de Compras -->
        <div class="carrito" id="carrito">
            <div class="header-carrito">
                <h2>Tu Carrito</h2>
                <button class="carrito-cerrar">&times;</button>
            </div>
            <div class="carrito-items"></div>
            <div class="carrito-total">
                <div class="fila">
                    <strong>Total</strong>
                    <span class="carrito-precio-total">
                        $0.00
                    </span>
                </div>
                <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
            </div>
        </div>
        <div id="toast" class="toast"></div>

        <!-- Lista de Favoritos -->
        <div class="container-list-favorites">
            <div class="header-favorite">
                <h3>Mis Favoritos</h3>
                <i class="fa-solid fa-xmark" id="btn-close"></i>
            </div>
            
            <div class="list-favorites">
                <div class="card-favorite">
                    <p class="title">Audífonos Bluetooth Pro</p>
                    <p>$150</p>
                </div>
            </div>
        </div>
    </header>

    <div class="carrusel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="7000" data-bs-pause="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imagenes/reloj_para_hombre.jpg" class="d-block w-100" alt="Imagen 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Relojes para Caballero</h5>
                        <a href="#">→</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="imagenes/reloj_para_mujer.png" class="d-block w-100" alt="Imagen 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Relojes para Dama</h5>
                        <a href="#">→</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <div class="pagina">
            <div class="botton">
                <a href="principal-relojes-caballeros.php">
                    <button class="boton">Relojes para hombre</button>
                </a>
            </div>
            <div class="botton">
                <a href="principal-relojes-damas.php">
                    <button class="boton">Relojes para mujer</button>
                </a>
            </div>
            <div class="botton">
                <a href="principal-populares.php">
                    <button class="boton">Mas populares</button>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 id="lo_mas_nuevo">Lo mas Nuevo</h2>
        <div class="container-products">
            <!-- Aquí se mostrarán los productos -->
        </div>
    </div>

    
    <div class="contenedor_gif"></div>
    <div class="contenedor_adorno"></div>
    <footer>
        <div class="footer-content">
            <div class="contact-info">
                <h3>Contacto</h3>
                <p>Email: info@cronos.com</p>
                <p>Teléfono: (123) 456-7890</p>
            </div>
            <div class="social-media">
                <h3>Síguenos</h3>
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Correo</a>
                <div class="imagen_redessociales">
                    <img src="imagenes/redes_sociales.png" alt="imagen ilustrativa">
                </div>
            </div>
            <div class="newsletter">
                <h3>No te pierdas de las ultimas novedades</h3>
                <form>
                    <input type="email" placeholder="Tu correo electrónico">
                    <button class="suscribirse">Suscribirse</button>
                </form>
            </div>
            <div class="legal">
                <p>&copy; 2024 CRONOS. Todos los derechos reservados.</p>
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="accesorios.js"></script>
    <script src="mostrar_productos_index.js" defer></script>

</body>
</html>
