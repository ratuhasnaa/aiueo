document.addEventListener("DOMContentLoaded", function() {
    let checkInInput = document.getElementById('check-in');
    checkInInput.placeholder = 'Select date';
});

function showDatePicker() {
    let checkInInput = document.getElementById('check-in');
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
    let yy = String(today.getFullYear()).slice(-2);
    let formattedDate = `${dd}/${mm}/${yy}`;

    checkInInput.type = 'date';
    checkInInput.placeholder = formattedDate;
    checkInInput.value = ''; // Clear the input value to show the date picker
}

function formatDate() {
    let checkInInput = document.getElementById('check-in');
    if (!checkInInput.value) {
        checkInInput.type = 'text';
        checkInInput.placeholder = 'Select date';
    } else {
        let dateValue = checkInInput.value;
        let dateParts = dateValue.split('-');
        let formattedDate = `${dateParts[2]}/${dateParts[1]}/${dateParts[0].slice(-2)}`;
        checkInInput.type = 'text';
        checkInInput.value = formattedDate; // Format date to dd/mm/yy
    }
}
