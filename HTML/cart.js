/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
    
document.addEventListener('DOMContentLoaded', () => {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartTableBody = document.getElementById('cart-items');
    const totalItemsElem = document.getElementById('total-items');
    const totalCostElem = document.getElementById('total-cost');

    const updateCartSummary = () => {
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        const totalCost = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
        
        totalItemsElem.textContent = totalItems;
        totalCostElem.textContent = `$${totalCost.toFixed(2)}`;
    };

    const removeCartItem = (index) => {
        cartItems.splice(index, 1);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        renderCartItems();
    };

    const renderCartItems = () => {
        cartTableBody.innerHTML = '';
        cartItems.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>${item.quantity}</td>
                <td>$${(item.price * item.quantity).toFixed(2)}</td>
                <td><button class="remove" data-index="${index}">Remove</button></td>
            `;
            cartTableBody.appendChild(row);
        });

        document.querySelectorAll('.remove').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = e.target.getAttribute('data-index');
                removeCartItem(index);
            });
        });

        updateCartSummary();
    };

    renderCartItems();
});
