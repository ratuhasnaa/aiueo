function updatePaymentMethod() {
    const paymentDropdown = document.getElementById('payment-method');
    const selectedPayment = document.getElementById('selected-payment');
    const paymentMethod = paymentDropdown.value;

    if (paymentMethod !== 'none') {
        paymentDropdown.style.display = 'none';
        selectedPayment.innerHTML = `${paymentMethod.charAt(0).toUpperCase() + paymentMethod.slice(1)}`;
        selectedPayment.style.display = 'block';
    }
}
