document.addEventListener("DOMContentLoaded", () => {
    fetch('mostrar_productos.php?tipo=mujeres')
        .then(response => response.json())
        .then(data => {
            const container = document.querySelector('.container-products');
            data.forEach(product => {
                const productHTML = `
                    <div class="card-product">
                        <div class="container-img">
                            <div class="flip-container">
                                <img src="${product.imagen_url}" alt="${product.nombre}" class="img-item"/>
                                <div class="face-back">
                                    <ul>
                                        <li><strong>Tamaño de la caja:</strong> ${product.tamanio_caja}</li>
                                        <li><strong>Movimiento:</strong> ${product.movimiento}</li>
                                        <li><strong>Material de la correa:</strong> ${product.material_correa}</li>
                                        <li><strong>Color de la correa:</strong> ${product.color_correa}</li>
                                        <li><strong>Resistencia al agua:</strong> ${product.resistencia_agua}</li>
                                        <li><strong>Material de la caja:</strong> ${product.material_caja}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="content-card-product" data-product-id="${product.id}">
                            <h3 class="titulo-item">${product.nombre}</h3>
                            <p>${product.descripcion}</p>
                            <div class="footer-card-product">
                                <span class="price">$${product.precio} USD</span>
                                <div class="container-buttons-card">
                                    <button class="favorite">
                                        <i class="fa-regular fa-heart" id="favorite-regular"></i>
                                        <i class="fa-solid fa-heart" id="added-favorite"></i>
                                    </button>
                                    <button class="cart">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                container.innerHTML += productHTML;
            });
            // Llama a showHTML después de cargar los productos
            showHTML();
        })
        .catch(error => console.error('Error al cargar productos:', error));
});
