<style>
#cart-menu a {
    border: none !important;
    background: none !important;
    padding: 0 !important;
    font-weight: 500;
    color: inherit;
}
</style>

<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header-wrap">
                    <div id="logo">
                        <a href="/">
                            <img src="images/page/logo1.png" alt="Logo">
                        </a>
                    </div>
                    <div class="nav-wrap">
                        <nav id="mainnav" class="mainnav">
						<ul class="menu">
						<!-- Menu Customer Support 
						<li class="submenu-item" id="support-menu">
							<a href="support.html" title="Customer Support">Customer Support</a>
						</li>
						 Menu Contact Us
						<li class="submenu-item" id="contact-menu">
							<a href="contact.html" title="Contact Us">Contact Us</a>
						</li>-->

						<!-- Menu WhatsApp -->
						<li class="submenu-item" id="whatsapp-menu">
							<a href="https://wa.me/081290396472" title="WhatsApp">
								<img src="images/page/whatsapp.png" alt="WhatsApp" class="whatsapp-icon">
								081290396472
							</a>
						</li>

                        <!-- Cart / Pesanan Saya -->
                        @auth
                        <li class="submenu-item" id="cart-menu">
                            <a href="{{ url('/my-bookings') }}" title="Pesanan Saya">
                                <i class="fas fa-receipt" style="margin-right: 5px;"></i> Pesanan Saya
                            </a>
                        </li>
                        @endauth

						<!-- Tampilkan Tombol Login/SignUp untuk Guest -->
						@guest
							<li class="auth-menu" id="login-button">
								<a href="" onclick="showLoginPopup(); return false;" title="Log In">Log In</a>
							</li>
							<li class="auth-menu" id="register-button">
								<a href="" onclick="showRegisterPopup(); return false;" title="Sign Up">Sign Up</a>
							</li>
						@endguest

						@auth
						<!-- Tampilkan Dropdown Logout untuk User yang Login -->
						<li class="logged-menu dropdown" id="user-menu">
						<button class="dropdown-toggle" id="dropdownMenuButton" type="button" title="User Menu">
							Hello,&nbsp;<span style="font-weight: bold;">{{ Auth::user()->name }}</span>
						</button>

							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<!-- Link ke Profile -->
								<a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
								<!-- Tombol Logout -->
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<button type="submit" class="dropdown-item logout-btn" title="Logout">Logout</button>
								</form>
							</div>
						</li>

					@endauth
					</ul>

                        </nav><!-- /.mainnav -->

                        <div class="btn-menu">
                            <span></span>
                        </div><!-- //mobile menu button -->
                    </div><!-- /.nav-wrap -->
                </div><!-- /.header-wrap -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.header -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.querySelector('.logged-menu .dropdown-toggle');
        const dropdownMenu = document.querySelector('.logged-menu .dropdown-menu');
        const loggedMenu = document.querySelector('.logged-menu');
        const whatsappMenu = document.getElementById('whatsapp-menu');

        // Toggle dropdown menu
        dropdownToggle.addEventListener('click', function (e) {
            e.stopPropagation(); // Mencegah event bubbling
            dropdownMenu.classList.toggle('show'); // Tampilkan dropdown dengan class "show"
        });

        // Tutup dropdown jika klik di luar
        document.addEventListener('click', function () {
            dropdownMenu.classList.remove('show'); // Sembunyikan dropdown
        });

        // Ubah gaya nomor WhatsApp setelah login
        if (whatsappMenu) {
            whatsappMenu.classList.remove('auth-menu'); // Pastikan tidak menggunakan gaya tombol
            whatsappMenu.classList.add('submenu-item'); // Ubah menjadi submenu
            const whatsappLink = whatsappMenu.querySelector('a');
            if (whatsappLink) {
                whatsappLink.style.background = 'none';
                whatsappLink.style.border = 'none';
                whatsappLink.style.outline = 'none';
                whatsappLink.style.color = 'inherit';
                whatsappLink.style.cursor = 'pointer';
            }
        }
    });
</script>
		<script type="text/javascript" src="javascript/login.js"></script>




