document.addEventListener("DOMContentLoaded", () => {
    const userIcon = document.querySelector(".fa-user-circle");
    const userMenu = document.getElementById("user-menu");

    userIcon.addEventListener("click", (e) => {
        e.stopPropagation();
        userMenu.style.display = userMenu.style.display === "block" ? "none" : "block";
    });

    document.addEventListener("click", (event) => {
        if (!userIcon.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.style.display = "none";
        }
    });

    loadCart();
});

async function loadCart() {
    try {
        const response = await fetch('for_cart.php');
        const text = await response.text();

        try {
            const result = JSON.parse(text);
            console.log("Cart Data Received:", result);

            const cartContainer = document.querySelector('.cart-container');
            cartContainer.innerHTML = '';

            if (!result.success) {
                cartContainer.innerHTML = `<p>${result.message}</p>`;
                return;
            }

            const cartItems = result.data;

            if (!Array.isArray(cartItems) || cartItems.length === 0) {
                cartContainer.innerHTML = '<p>Your cart is empty.</p>';
                return;
            }

            const table = document.createElement('table');
            table.classList.add('cart-table');

            const headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Title</th>
                <th>Price</th>
                <th>Action</th>
            `;
            table.appendChild(headerRow);

            cartItems.forEach(item => {
                const row = document.createElement('tr');
                row.dataset.id = item.id;

                const titleCell = document.createElement('td');
                titleCell.textContent = item.title;

                const priceCell = document.createElement('td');
                priceCell.textContent = `₱${item.price}`;

                const actionCell = document.createElement('td');
                const removeButton = document.createElement('button');
                removeButton.textContent = "Remove";
                removeButton.classList.add('remove-btn');
                removeButton.dataset.id = item.id;

                // ✅ Add confirmation prompt before removing
                removeButton.addEventListener("click", () => {
                    const confirmed = confirm("Are you sure you want to remove this comic from your cart?");
                    if (confirmed) {
                        removeFromCart(item.id);
                    }
                });

                actionCell.appendChild(removeButton);
                row.appendChild(titleCell);
                row.appendChild(priceCell);
                row.appendChild(actionCell);
                table.appendChild(row);
            });

            cartContainer.appendChild(table);
        } catch (error) {
            console.error("Invalid JSON received:", text);
            document.querySelector('.cart-container').innerHTML = '<p>Error: Failed to load cart.</p>';
        }
    } catch (error) {
        console.error("Error loading cart:", error);
        document.querySelector('.cart-container').innerHTML = '<p>Network error: Could not fetch cart data.</p>';
    }
}

async function removeFromCart(itemId) {
    console.log("Attempting to remove item:", itemId);

    try {
        const response = await fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ comicID: itemId })
        });

        const data = await response.json();
        console.log("Server response:", data);

        if (data.success) {
            const row = document.querySelector(`tr[data-id="${itemId}"]`);
            if (row) row.remove();

            if (document.querySelectorAll('.cart-table tr').length === 1) {
                document.querySelector('.cart-container').innerHTML = '<p>Your cart is empty.</p>';
            }
        } else {
            alert(data.message || "Failed to remove item.");
        }
    } catch (error) {
        console.error("Error removing item:", error);
        alert("An error occurred while removing the item.");
    }
}
