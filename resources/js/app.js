
import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[name="search"]'); // Selecciona el input
    if (!searchInput) return; // Verifica que el input exista

    const suggestionsBox = document.createElement('ul'); // Crea el contenedor para sugerencias
    suggestionsBox.className = 'absolute bg-white border border-gray-300 rounded-lg shadow-lg w-full mt-1 z-50';
    searchInput.parentNode.appendChild(suggestionsBox); // Lo agrega al DOM

    // Evento cuando el usuario escribe en el input
    searchInput.addEventListener('input', async function () {
        const query = this.value.trim(); // Obtén el valor del input

        if (query.length < 2) { // Si el query tiene menos de 2 caracteres, limpia sugerencias
            suggestionsBox.innerHTML = '';
            return;
        }

        try {
            // Aquí va el fetch para obtener los datos de la API
            const response = await fetch('/autocomplete?query=' + query); // Realiza la solicitud
            if (!response.ok) throw new Error('Error al realizar la solicitud'); // Valida la respuesta
            const results = await response.json(); // Convierte la respuesta a JSON

            // Genera las sugerencias en HTML y las agrega al contenedor
            suggestionsBox.innerHTML = results
                .map(
                    result =>
                        `<li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" data-url="${result.url}">${result.title}</li>`
                )
                .join('');
        } catch (error) {
            console.error('Error fetching autocomplete results:', error); // Muestra el error en la consola
        }
    });

    // Evento para seleccionar una sugerencia
    suggestionsBox.addEventListener('click', function (e) {
        if (e.target.tagName === 'LI') {
            const postUrl = e.target.dataset.url; // Obtén la URL del dataset
            window.location.href = postUrl; // Redirige al usuario a la URL del post
            suggestionsBox.innerHTML = ''; // Limpia las sugerencias
        }
    });

    // Evento para cerrar el contenedor de sugerencias al hacer clic fuera
    document.addEventListener('click', function (e) {
        if (searchInput && !searchInput.contains(e.target) && suggestionsBox && !suggestionsBox.contains(e.target)) {
            suggestionsBox.innerHTML = ''; // Limpia las sugerencias
        }
    });
});
