document.addEventListener('DOMContentLoaded', function() {
    // Obtener los productos almacenados en LocalStorage
    const productosComprados = JSON.parse(localStorage.getItem('productos_comprados')) || [];

    // Obtener el contenedor donde mostrar los productos
    const contenedorCompras = document.getElementById('contenedor-compras');

    // Si no hay productos guardados, mostrar un mensaje
    if (productosComprados.length === 0) {
        contenedorCompras.innerHTML = '<p>No tienes compras recientes.</p>';
    } else {
        // Si hay productos, mostrar cada uno en la página
        productosComprados.forEach(producto => {
            const productoHTML = `
                <div class="compra-item">
                    <img src="${producto.imagenSrc}" width="80px" alt="${producto.titulo}">
                    <div class="compra-item-detalles">
                        <h3>${producto.titulo}</h3>
                        <p>Precio: ${producto.precio}</p>
                        <p>Cantidad: ${producto.cantidad}</p>
                        <p>Total: $${(parseFloat(producto.precio.replace('$', '').replace(',', '')) * producto.cantidad).toFixed(2)}</p>
                    </div>
                </div>
            `;
            contenedorCompras.innerHTML += productoHTML;
        });
    }
});
