<x-guest-layout>
    <div class="login-overlay" id="loginOverlay">
        <div class="login-popup-box">
            <div class="header-container">
                <span class="close-button" onclick="hideLoginPopup()">&times;</span>
                
            </div>
            <hr class="divider">
            <h2>Welcome Back to AIUEO</h2>
            
            <!-- Display validation errors -->
            <x-validation-errors class="mb-4" />
            
            <!-- Display session status -->
            @if(session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username field -->
                <input type="email" id="email" name="email" placeholder="Email" :value="old('email')" required autofocus autocomplete="username" class="block mt-1 w-full" />
          
                <!-- Phone field with placeholder -->
                <input type="text" id="newPhone" name="phone" placeholder="Phone Number" required>

                <!-- Password field -->
                <input type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password" class="block mt-1 w-full" />

                <!-- Remember Me checkbox -->
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Continue button -->
                <button type="submit">Continue</button>
            </form>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>
