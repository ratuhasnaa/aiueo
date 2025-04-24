document.addEventListener('DOMContentLoaded', function () {
    // Prevent default behavior for all links with href="#"
    document.querySelectorAll('a[href="#"]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah navigasi ke route public#
            console.log('Prevented navigation for link:', link);
        });
    });

    // Delegasi event untuk tombol login dan register
    document.body.addEventListener('click', function (event) {
        if (event.target.id === 'login-button') {
            event.preventDefault();
            console.log('Login button clicked');
            showLoginPopup();
        }

        if (event.target.id === 'register-button') {
            event.preventDefault();
            console.log('Register button clicked');
            showRegisterPopup();
        }
    });
});

function showLoginPopup() {
    const loginOverlay = document.getElementById('loginOverlay');
    if (loginOverlay) {
        console.log('Displaying login popup');
        loginOverlay.style.display = 'flex';
    }
}

function hideLoginPopup() {
    const loginOverlay = document.getElementById('loginOverlay');
    if (loginOverlay) {
        console.log('Hiding login popup');
        loginOverlay.style.display = 'none';
    }
}

function showRegisterPopup() {
    const registerOverlay = document.getElementById('registerOverlay');
    if (registerOverlay) {
        console.log('Displaying register popup');
        registerOverlay.style.display = 'flex';
    }
}

function hideRegisterPopup() {
    const registerOverlay = document.getElementById('registerOverlay');
    if (registerOverlay) {
        console.log('Hiding register popup');
        registerOverlay.style.display = 'none';
    }
}
