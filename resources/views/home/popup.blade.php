<!-- Popup Container -->
<div class="popup-container">
    <!-- Login Popup Overlay -->
    <div class="login-overlay" id="loginOverlay" style="display: none;">
        <div class="login-popup-box">
            <div class="header-container">
                <h2>Welcome Back to AIUEO</h2>
                <span class="close-button" onclick="hideLoginPopup()">&times;</span>
            </div>
            @if ($errors->any())
                <div class="mb-4 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" id="redirect_to_login" name="redirect_to" value="{{ url()->current() }}">
                <input type="email" id="email" name="email" placeholder="Email" required autofocus autocomplete="username">
                <input type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                <button type="submit" class="popup-button">Continue</button>
            </form>
        </div>
    </div>

    <!-- Sign Up Popup Overlay -->
    <div class="register-overlay" id="registerOverlay" style="display: none;">
        <div class="register-popup-box">
            <div class="header-container">
                <h2>Join AIUEO Today</h2>
                <span class="close-button" onclick="hideRegisterPopup()">&times;</span>
            </div>
            @if ($errors->any())
                <div class="mb-4 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" id="redirect_to_register" name="redirect_to" value="{{ url()->current() }}">
                <input type="text" id="newUsername" name="name" placeholder="Name" required>
                <input type="email" id="newEmail" name="email" placeholder="Email Address" required>
                <input type="text" id="newPhone" name="phone" placeholder="Phone Number" required>
                <input type="password" id="newPassword" name="password" placeholder="Create Password" required>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit" class="popup-button">Sign Up</button>
            </form>
        </div>
    </div>
</div>

<style>
/* Scoped Popup Styles */
.popup-container .login-overlay, 
.popup-container .register-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.popup-container .login-popup-box, 
.popup-container .register-popup-box {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column; /* Stack content vertically */
    align-items: center;
    justify-content: center;
    margin-bottom: 80px; /* Menambahkan jarak bawah pada form */

}

/* Centering the h2 text */
.popup-container h2 {
    text-align: center; /* Center the h2 text */
    width: 100%; /* Ensure it takes full width */
}

/* Ensure form elements are stacked vertically */
.popup-container form {
    display: flex;
    flex-direction: column; /* Stack children vertically */
    width: 100%; /* Ensure full width */
    margin: 0; /* Reset default margin */
    padding: 0; /* Reset default padding */
    
}

/* Ensure inputs and buttons are full-width */
.popup-container input,
.popup-container button {
    display: block; /* Each element on a new line */
    width: 100%;
    box-sizing: border-box; /* Include padding in width */
    margin-bottom: 15px; /* Space between elements */
}

/* Styling for close button */
.popup-container .header-container {
    display: flex;
    justify-content: space-between; /* Align items to the edges */
    width: 100%;
    align-items: center; /* Center vertically */
}

.popup-container .close-button {
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

/* Styling for popup buttons */
.popup-container .popup-button {
    width: 100%;
    padding: 10px;
    background: #336799; /* Updated color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center; /* Center text */
}

.popup-container .popup-button:hover {
    background: #2a4d6d; /* Darker shade on hover */
}

/* Alert box styling */
.popup-container .alert {
    margin: 10px 0;
    padding: 10px;
    color: red;
    background: #ffe6e6;
    border-radius: 5px;
}
/* Styling for popup buttons */
.popup-container .popup-button {
    width: 100%;
    padding: 10px;
    background: #336799; /* Updated color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center; /* Center text horizontally */
    line-height: 20px; /* Adjust the line height to center text vertically */
}

.popup-container .popup-button:hover {
    background: #2a4d6d; /* Darker shade on hover */
}


</style>
<script src="{{ asset('javascript/login.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const updateRedirectInput = (inputId) => {
        const currentUrl = window.location.href;
        const redirectInput = document.getElementById(inputId);
        if (redirectInput) {
            redirectInput.value = currentUrl;
        }
    };

    // Update redirect_to when login/register overlay is shown
    const loginOverlay = document.getElementById('loginOverlay');
    const registerOverlay = document.getElementById('registerOverlay');

    if (loginOverlay) {
        loginOverlay.addEventListener('show', () => updateRedirectInput('redirect_to_login'));
    }

    if (registerOverlay) {
        registerOverlay.addEventListener('show', () => updateRedirectInput('redirect_to_register'));
    }
});
</script>