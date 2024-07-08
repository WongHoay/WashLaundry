/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
    
//document.addEventListener('DOMContentLoaded', () => {
//    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
//    const cartTableBody = document.getElementById('cart-items');
//    const totalItemsElem = document.getElementById('total-items');
//    const totalCostElem = document.getElementById('total-cost');
//
//    const updateCartSummary = () => {
//        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
//        const totalCost = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
//        
//        totalItemsElem.textContent = totalItems;
//        totalCostElem.textContent = `$${totalCost.toFixed(2)}`;
//    };
//
//    const removeCartItem = (index) => {
//        cartItems.splice(index, 1);
//        localStorage.setItem('cartItems', JSON.stringify(cartItems));
//        renderCartItems();
//    };
//
//    const renderCartItems = () => {
//        cartTableBody.innerHTML = '';
//        cartItems.forEach((item, index) => {
//            const row = document.createElement('tr');
//            row.innerHTML = `
//                <td>${item.name}</td>
//                <td>$${item.price.toFixed(2)}</td>
//                <td>${item.quantity}</td>
//                <td>$${(item.price * item.quantity).toFixed(2)}</td>
//                <td><button class="remove" data-index="${index}">Remove</button></td>
//            `;
//            cartTableBody.appendChild(row);
//        });
//
//        document.querySelectorAll('.remove').forEach(button => {
//            button.addEventListener('click', (e) => {
//                const index = e.target.getAttribute('data-index');
//                removeCartItem(index);
//            });
//        });
//
//        updateCartSummary();
//    };
//
//    renderCartItems();
//});

document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    const totalItemsElement = document.getElementById('total-items');
    const totalCostElement = document.getElementById('total-cost');

    function updateCart() {
        cartItemsContainer.innerHTML = '';
        let totalItems = 0;
        let totalCost = 0;

        cart.forEach((item, index) => {
            const { service, price, quantity } = item;
            const itemTotal = price * quantity;
            totalItems += quantity;
            totalCost += itemTotal;

            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${service}</td>
                <td>RM${price}</td>
                <td>
                    <input type="number" value="${quantity}" min="1" data-index="${index}" class="quantity-input">
                </td>
                <td>RM${itemTotal.toFixed(2)}</td>
                <td><button data-index="${index}" class="remove-item">Remove</button></td>
            `;

            cartItemsContainer.appendChild(row);
        });

        totalItemsElement.textContent = totalItems;
        totalCostElement.textContent = `RM${totalCost.toFixed(2)}`;
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    cartItemsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-item')) {
            const index = e.target.getAttribute('data-index');
            cart.splice(index, 1);
            updateCart();
        }
    });

    cartItemsContainer.addEventListener('input', (e) => {
        if (e.target.classList.contains('quantity-input')) {
            const index = e.target.getAttribute('data-index');
            const newQuantity = parseInt(e.target.value, 10);
            if (newQuantity > 0) {
                cart[index].quantity = newQuantity;
                updateCart();
            }
        }
    });

    updateCart();
});

