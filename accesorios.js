
const counterFavorites = document.querySelector('.counter-favorite');
const containerListFavorites = document.querySelector('.container-list-favorites');
const listFavorites = document.querySelector('.list-favorites');

let favorites = [];

// Actualizar favoritos en LocalStorage
const updateFavoritesInLocalStorage = () => {
	localStorage.setItem('favorites', JSON.stringify(favorites));
};

// Cargar favoritos desde LocalStorage
const loadFavoritesFromLocalStorage = () => {
	const storedFavorites = localStorage.getItem('favorites');
	if (storedFavorites) {
		favorites = JSON.parse(storedFavorites);
		showHTML();
	}
};

// Alternar favoritos (agregar o quitar)
const toggleFavorite = product => {
	const index = favorites.findIndex(fav => fav.id === product.id);
	if (index > -1) {
		favorites.splice(index, 1);
	} else {
		favorites.push(product);
	}
	updateFavoritesInLocalStorage();
};

// Actualizar la lista de favoritos en el menú
const updateFavoriteMenu = () => {
	listFavorites.innerHTML = '';

	favorites.forEach(fav => {
		const favoriteCard = document.createElement('div');
		favoriteCard.classList.add('card-favorite');

		const titleElement = document.createElement('p');
		titleElement.classList.add('title');
		titleElement.textContent = fav.title;
		favoriteCard.appendChild(titleElement);

		const priceElement = document.createElement('p');
		priceElement.textContent = fav.price;
		favoriteCard.appendChild(priceElement);

		listFavorites.appendChild(favoriteCard);
	});
};

// Mostrar productos actualizados en la interfaz
const showHTML = () => {
    const products = document.querySelectorAll('.card-product');
    products.forEach(product => {
        const contentProduct = product.querySelector('.content-card-product');
        const productId = contentProduct.dataset.productId.toString(); // Convertir ID a string

        // Verificar si el producto está en favoritos
        const isFavorite = favorites.some(fav => fav.id === productId);

        // Elementos para modificar clases
        const favoriteButton = product.querySelector('.favorite');
        const favoriteRegularIcon = product.querySelector('#favorite-regular');
        const favoriteActiveButton = product.querySelector('#added-favorite');

        // Aplicar clases según el estado de favorito
        if (favoriteButton) favoriteButton.classList.toggle('favorite-active', isFavorite);
        if (favoriteRegularIcon) favoriteRegularIcon.classList.toggle('active', isFavorite);
        if (favoriteActiveButton) favoriteActiveButton.classList.toggle('active', isFavorite);
    });

    // Actualizar contador y menú
    counterFavorites.textContent = favorites.length;
    updateFavoriteMenu();
};


// Delegación de eventos para manejar clics en favoritos
document.addEventListener('click', e => {
	if (e.target.closest('.favorite')) {
		const button = e.target.closest('.favorite');
		const card = button.closest('.content-card-product');

		const product = {
			id: card.dataset.productId,
			title: card.querySelector('h3').textContent,
			price: card.querySelector('.price').textContent,
		};

		toggleFavorite(product);
		showHTML();
	}
});

// Mostrar/ocultar menú de favoritos
const buttonHeaderFavorite = document.querySelector('#button-header-favorite');
const btnClose = document.querySelector('#btn-close');

buttonHeaderFavorite.addEventListener('click', () => {
	containerListFavorites.classList.toggle('show');
});

btnClose.addEventListener('click', () => {
	containerListFavorites.classList.remove('show');
});

// Inicializar favoritos
loadFavoritesFromLocalStorage();
updateFavoriteMenu();
console.log('Favoritos cargados:', favorites);
console.log('Productos en la página:', document.querySelectorAll('.card-product'));
