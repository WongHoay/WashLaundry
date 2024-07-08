/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

function confirmReset() {
    if (confirm("Are you sure you want to cancel and clear all inputs?")) {
        document.getElementById("signupForm").reset();
    }
}
