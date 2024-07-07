/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

document.addEventListener('DOMContentLoaded', () => {
    const cardPaymentBtn = document.getElementById('card-payment-btn');
    const qrPaymentBtn = document.getElementById('qr-payment-btn');
    const cardPaymentForm = document.getElementById('card-payment-form');
    const qrPayment = document.getElementById('qr-payment');
    const paymentForms = document.querySelector('.payment-forms');

    cardPaymentBtn.addEventListener('click', () => {
        paymentForms.style.display = 'block';
        cardPaymentForm.style.display = 'block';
        qrPayment.style.display = 'none';
    });

    qrPaymentBtn.addEventListener('click', () => {
        paymentForms.style.display = 'block';
        cardPaymentForm.style.display = 'none';
        qrPayment.style.display = 'block';
    });

    cardPaymentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Card payment submitted successfully!');
        // Add actual payment processing logic here
    });
});


