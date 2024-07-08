/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', () => {
    const receiptDetails = document.getElementById('receipt-details');

    // Dummy cart items for receipt generation
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [
        { name: 'Wash & Fold', price: 10.00, quantity: 2 },
        { name: 'Dry Cleaning', price: 10.00, quantity: 2 },
        { name: 'Ironing', price: 10.00, quantity: 2 },
        { name: 'Express Service', price: 12.00, quantity: 1 },
    ];

    const generateReceipt = () => {
        receiptDetails.innerHTML = '';
        let totalCost = 0;
        cartItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            totalCost += itemTotal;
            receiptDetails.innerHTML += `
                <p>${item.name} (x${item.quantity}) - $${itemTotal.toFixed(2)}</p>
            `;
        });
        receiptDetails.innerHTML += `
            <hr>
            <p><strong>Total: $${totalCost.toFixed(2)}</strong></p>
        `;
    };

    generateReceipt();
});

function redirectToHome() {
    window.location.href = 'homepage.php'; // Update to the actual home page URL
}

