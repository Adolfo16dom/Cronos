// Variable que mantiene el estado visible del carrito
var carritoVisible = false;

// Seleccionar el botón de cerrar carrito y añadir el evento
const cerrarCarritoBtn = document.querySelector('.carrito-cerrar');
if (cerrarCarritoBtn) {
    cerrarCarritoBtn.addEventListener('click', function () {
        const carrito = document.getElementById('carrito');
        carrito.classList.toggle('mostrar');
    });
}


// Función para abrir el carrito (manteniendo tu implementación existente)
document.querySelector('.cart-button').addEventListener('click', function () {
    const carrito = document.getElementById('carrito');
    carrito.classList.toggle('mostrar');
});

// Función que oculta el carrito si no tiene elementos
function ocultarCarrito() {
    //const carrito = document.getElementById('carrito');
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    if (carritoItems.childElementCount === 0) {
        carrito.classList.remove('mostrar');
    }
}
// Esperamos que todos los elementos de la página carguen para ejecutar el script
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

function ready() {
    // Cargar carrito desde LocalStorage al inicio
    cargarCarritoDesdeLocalStorage();
    
    // Agregamos funcionalidad a los botones eliminar del carrito
    var botonesEliminarItem = document.getElementsByClassName('btn-eliminar');
    for (var i = 0; i < botonesEliminarItem.length; i++) {
        var button = botonesEliminarItem[i];
        button.addEventListener('click', eliminarItemCarrito);
    }

    // Agrego funcionalidad al botón sumar cantidad
    var botonesSumarCantidad = document.getElementsByClassName('sumar-cantidad');
    for (var i = 0; i < botonesSumarCantidad.length; i++) {
        var button = botonesSumarCantidad[i];
        button.addEventListener('click', sumarCantidad);
    }

    // Agrego funcionalidad al botón restar cantidad
    var botonesRestarCantidad = document.getElementsByClassName('restar-cantidad');
    for (var i = 0; i < botonesRestarCantidad.length; i++) {
        var button = botonesRestarCantidad[i];
        button.addEventListener('click', restarCantidad);
    }

    // Agregamos funcionalidad al botón Agregar al carrito
    document.querySelector('.container-products').addEventListener('click', function (event) {
        if (event.target.closest('.cart')) {
            agregarAlCarritoClicked(event);
        }
    });
    

    // Agregamos funcionalidad al botón comprar
    document.getElementsByClassName('btn-pagar')[0].addEventListener('click', pagarClicked);
}

// Eliminamos todos los elementos del carrito cuando se pague y lo ocultamos
function pagarClicked() {
    alert("Gracias por la compra");

    // Recoger los productos del carrito
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    const productosComprados = [];

    const items = carritoItems.getElementsByClassName('carrito-item');
    for (let item of items) {
        const titulo = item.querySelector('.carrito-item-titulo').innerText;
        const precio = item.querySelector('.carrito-item-precio').innerText;
        const cantidad = item.querySelector('.carrito-item-cantidad').value;
        const imagenSrc = item.querySelector('img').src;
        productosComprados.push({ titulo, precio, cantidad, imagenSrc });
    }

    // Guardar los productos comprados en LocalStorage
    localStorage.setItem('productos_comprados', JSON.stringify(productosComprados));

    // Limpiar el carrito
    var carritoItems = document.getElementsByClassName('carrito-items')[0];
    while (carritoItems.hasChildNodes()) {
        carritoItems.removeChild(carritoItems.firstChild);
    }

    actualizarTotalCarrito();
    ocultarCarrito();
}

// Función que controla el botón clickeado de agregar al carrito
function agregarAlCarritoClicked(event) {
    var button = event.target;
    var item = button.closest('.card-product'); // Selecciona el contenedor principal del producto
    var titulo = item.querySelector('.titulo-item').innerText;
    var precio = item.querySelector('.price').innerText;
    var imagenSrc = item.querySelector('.img-item').src;

    console.log(`Producto añadido: ${titulo} - Precio: ${precio}`);
    agregarItemAlCarrito(titulo, precio, imagenSrc);
    hacerVisibleCarrito();
}


function hacerVisibleCarrito() {
    const carrito = document.getElementById('carrito');
    carrito.classList.add('mostrar');
}

function mostrarToast(mensaje) {
    const toast = document.getElementById('toast');
    toast.innerText = mensaje;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 2000);
}

function guardarCarritoEnLocalStorage() {
    const itemsCarrito = document.getElementsByClassName('carrito-items')[0];
    const productos = [];
    const items = itemsCarrito.getElementsByClassName('carrito-item');
    
    for (let item of items) {
        const titulo = item.querySelector('.carrito-item-titulo').innerText;
        const precio = item.querySelector('.carrito-item-precio').innerText;
        const cantidad = item.querySelector('.carrito-item-cantidad').value;
        const imagenSrc = item.querySelector('img').src;
        productos.push({ titulo, precio, cantidad, imagenSrc });
    }

    localStorage.setItem('carrito', JSON.stringify(productos));
}
function cargarCarritoDesdeLocalStorage() {
    const itemsCarrito = document.getElementsByClassName('carrito-items')[0];
    const productosGuardados = JSON.parse(localStorage.getItem('carrito')) || [];

    productosGuardados.forEach(producto => {
        agregarItemAlCarrito(producto.titulo, producto.precio, producto.imagenSrc, producto.cantidad);
    });
}

// Modifica `agregarItemAlCarrito` para aceptar cantidad como argumento opcional:
function agregarItemAlCarrito(titulo, precio, imagenSrc, cantidad = 1) {
    const itemsCarrito = document.getElementsByClassName('carrito-items')[0];

    // Revisa si el producto ya está en el carrito
    const nombresItemsCarrito = itemsCarrito.getElementsByClassName('carrito-item-titulo');
    for (let i = 0; i < nombresItemsCarrito.length; i++) {
        if (nombresItemsCarrito[i].innerText.trim().toLowerCase() === titulo.trim().toLowerCase()) {
            mostrarToast("El item ya se encuentra en el carrito");
            return;
        }
    }

    // Crear el elemento y agregarlo
    const item = document.createElement('div');
    item.innerHTML = `
        <div class="carrito-item">
            <img src="${imagenSrc}" width="80px" alt="">
            <div class="carrito-item-detalles">
                <span class="carrito-item-titulo">${titulo}</span>
                <div class="selector-cantidad">
                    <i class="fa-solid fa-minus restar-cantidad"></i>
                    <input type="text" value="${cantidad}" class="carrito-item-cantidad" disabled>
                    <i class="fa-solid fa-plus sumar-cantidad"></i>
                </div>
                <span class="carrito-item-precio">${precio}</span>
            </div>
            <button class="btn-eliminar">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    `;
    itemsCarrito.appendChild(item);

    item.querySelector('.btn-eliminar').addEventListener('click', eliminarItemCarrito);
    item.querySelector('.restar-cantidad').addEventListener('click', restarCantidad);
    item.querySelector('.sumar-cantidad').addEventListener('click', sumarCantidad);

    actualizarTotalCarrito();
    guardarCarritoEnLocalStorage(); // Guardar cambios en LocalStorage
}


function sumarCantidad(event) {
    var buttonClicked = event.target;
    var selector = buttonClicked.parentElement;
    var cantidadActual = parseInt(selector.getElementsByClassName('carrito-item-cantidad')[0].value);
    cantidadActual++;
    selector.getElementsByClassName('carrito-item-cantidad')[0].value = cantidadActual;
    actualizarTotalCarrito();
    guardarCarritoEnLocalStorage(); // Guardar cambios
}

function restarCantidad(event) {
    var buttonClicked = event.target;
    var selector = buttonClicked.parentElement;
    var cantidadActual = parseInt(selector.getElementsByClassName('carrito-item-cantidad')[0].value);
    cantidadActual--;
    if (cantidadActual >= 1) {
        selector.getElementsByClassName('carrito-item-cantidad')[0].value = cantidadActual;
        actualizarTotalCarrito();
        guardarCarritoEnLocalStorage(); // Guardar cambios
    }
}

function eliminarItemCarrito(event) {
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.remove();
    actualizarTotalCarrito();
    ocultarCarrito();
    guardarCarritoEnLocalStorage(); // Guardar cambios
}


function actualizarTotalCarrito() {
    var carritoContenedor = document.getElementsByClassName('carrito')[0];
    var carritoItems = carritoContenedor.getElementsByClassName('carrito-item');
    var total = 0;
    console.log(`Cantidad de elementos en carritoItems: ${carritoItems.length}`);
    
    for (var i = 0; i < carritoItems.length; i++) {
        var item = carritoItems[i];
        var precioElemento = item.getElementsByClassName('carrito-item-precio')[0];
        var precio = parseFloat(precioElemento.innerText.replace('$', '').replace(',', '').replace(' USD', ''));
        if (isNaN(precio)) continue;
        var cantidadItem = item.getElementsByClassName('carrito-item-cantidad')[0];
        var cantidad = parseInt(cantidadItem.value);
        total += precio * cantidad;
        console.log(`Total: $${total}`);
    }
    
    total = Math.round(total * 100) / 100;
    document.getElementsByClassName('carrito-precio-total')[0].innerText = '$' + total.toLocaleString("en-US") + ".00";
}
