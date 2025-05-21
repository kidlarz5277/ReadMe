
document.addEventListener("DOMContentLoaded", () => {
    initUserMenu();
    initGenreDropdown();
    initComicLoader();
    loadComicFromURL();
});

function initUserMenu() {
    const userIcon = document.querySelector(".fa-user-circle");
    const userMenu = document.getElementById("user-menu");

    if (userIcon && userMenu) {
        userIcon.addEventListener("click", () => {
            userMenu.style.display = userMenu.style.display === "none" ? "block" : "none";
        });

        document.addEventListener("click", (event) => {
            if (!userIcon.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.style.display = "none";
            }
        });
    }
}

function initGenreDropdown() {
    const genreSelect = document.getElementById('genre');
    if (!genreSelect) return;

    fetch('get_genres.php')
        .then(res => res.json())
        .then(data => {
            genreSelect.innerHTML = '<option value="">All Genres</option>';
            data.forEach(genre => {
                const option = document.createElement('option');
                option.value = genre.id;
                option.textContent = genre.name;
                genreSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading genres:', error);
            genreSelect.innerHTML = '<option>Error loading genres</option>';
        });

    genreSelect.addEventListener('change', (event) => {
        loadComicsByGenre(event.target.value);
    });
}

function initComicLoader() {
    const container = document.querySelector('.container');
    if (container) {
        loadComicsByGenre('');
    }
}

async function loadComicsByGenre(genreId) {
    try {
        const res = await fetch(`get_comics.php?genre_id=${encodeURIComponent(genreId)}`);
        const comics = await res.json();
        const container = document.querySelector('.container');

        container.innerHTML = '';

        if (!Array.isArray(comics) || comics.length === 0) {
            container.innerHTML = '<p>No comics found for this genre.</p>';
            return;
        }

        comics.forEach(comic => {
            const card = document.createElement('div');
            card.classList.add('comic-card');

            const link = document.createElement('a');
            link.href = `comicdetails.html?id=${comic.id}`;

            const img = document.createElement('img');
            img.src = comic.cover_url;
            img.alt = comic.title;
            img.width = 120;
            img.onerror = () => img.src = 'fallback_image.jpg';

            const title = document.createElement('h3');
            title.textContent = comic.title;

            link.appendChild(img);
            card.appendChild(link);
            card.appendChild(title);
            container.appendChild(card);
        });
    } catch (err) {
        console.error('Error loading comics:', err);
        document.querySelector('.container').innerHTML = '<p>Error loading comics.</p>';
    }
}

function loadComicFromURL() {
    const params = new URLSearchParams(window.location.search);
    const comicId = params.get("id");

    if (comicId) {
        loadComicDetails(comicId);
    } else {
        const details = document.getElementById("comic-details");
        if (details) details.innerHTML = "<p>Error: Comic ID not found.</p>";
    }
}

async function loadComicDetails(comicId) {
    try {
        const res = await fetch(`comic_details.php?id=${encodeURIComponent(comicId)}`);
        
        // Check response status
        if (!res.ok) {
            throw new Error(`HTTP ${res.status}`);
        }

        const data = await res.json();

        if (data.error) {
            document.getElementById("comic-details").innerHTML = `<p>${data.error}</p>`;
            return;
        }

        document.getElementById("comic-title").textContent = data.title;
        document.getElementById("comic-cover").src = data.cover_url;
        document.getElementById("comic-description").textContent = data.description;
        document.getElementById("comic-genre").textContent = data.genre || "N/A";
        document.getElementById("comic-author").textContent = data.author || "N/A";
        document.getElementById("comic-price").textContent = data.price ? `₱${data.price}` : "N/A";

    } catch (err) {
        console.error("Error loading comic details:", err);
        document.getElementById("comic-details").innerHTML = "<p>Error fetching comic details. Please try again later.</p>";
    }
}
document.addEventListener("DOMContentLoaded", () => {
    initCart();
});

function initCart() {
    document.getElementById('add-to-cart').addEventListener('click', async () => {
        const comicID = new URLSearchParams(window.location.search).get('id');

        if (!comicID) {
            alert("Error: Comic ID missing.");
            return;
        }

        try {
            const response = await fetch('add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ comicID })
            });

            const data = await response.json();
            const msg = document.getElementById('cart-message');
            msg.textContent = data.message;
            msg.style.color = data.success ? "green" : "red";
        } catch (err) {
            console.error(err);
            alert("Error adding comic to cart.");
        }
    });

    loadCart();
}

async function loadCart() {
    try {
        const response = await fetch('get_cart.php');
        const cartItems = await response.json();
        const cartContainer = document.querySelector('.cart-container');

        cartContainer.innerHTML = '';

        if (!Array.isArray(cartItems) || cartItems.length === 0) {
            cartContainer.innerHTML = '<p>Your cart is empty.</p>';
            return;
        }

        cartItems.forEach(item => {
            const card = document.createElement('div');
            card.classList.add('cart-item');

            const img = document.createElement('img');
            img.src = item.cover_url;
            img.alt = item.title;
            img.onerror = () => img.src = 'fallback_image.jpg';

            const title = document.createElement('p');
            title.textContent = `${item.title} - ₱${item.price}`;

            card.appendChild(img);
            card.appendChild(title);
            cartContainer.appendChild(card);
        });
    } catch (error) {
        console.error("Error loading cart:", error);
    }
}


