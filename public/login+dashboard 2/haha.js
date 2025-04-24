document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var email = document.querySelector('input[type="email"]').value;
    var password = document.querySelector('input[type="password"]').value;

    if (email === "admin@example.com" && password === "password") {
        window.location.href = 'dashboard.html';
    } else {
        alert("Invalid credentials, please try again.");
    }
});

// Adding event listeners for other buttons
document.querySelectorAll('.social-button').forEach(function(button) {
    button.addEventListener('click', function() {
        window.location.href = 'dashboard.html';
    });
});
