<style>
/* Wrapper Form */
form {
    display: flex; /* Membuat elemen dalam form sejajar horizontal */
    align-items: center; /* Menjaga elemen sejajar secara vertikal */
    gap: 10px; /* Jarak antar elemen */
}

/* Styling untuk Elemen Input dan Select */
form span {
    flex: 1; /* Semua elemen berbagi ruang secara merata */
    position: relative; /* Untuk ikon dropdown */
}

form input[type="text"] {
    width: 100%; /* Elemen memenuhi lebar parent (span) */
    padding-bottom: 19px; /* Ruang dalam elemen */
    font-size: 14px; /* Ukuran font konsisten */
    border: 1px solid #ccc; /* Garis tepi elemen */
    border-radius: 5px; /* Sudut membulat */
    box-sizing: border-box; /* Padding tidak memengaruhi ukuran */
}

/* Hilangkan Gaya Default Select */
form select {
    padding: 8px;
    width: 70%;
    appearance: none; /* Hilangkan gaya default browser */
    -webkit-appearance: none; /* Untuk browser berbasis Webkit */
    -moz-appearance: none; /* Untuk Firefox */
    padding-right: 30px; /* Ruang ekstra untuk ikon dropdown */
    background-color: #fff; /* Sama dengan input */
}



/* Styling untuk Tombol */
form .search-icon-btn {
    font-size: 14px; /* Ukuran font konsisten */
    background-color: #007BFF; /* Warna tombol */
    color: #fff; /* Warna teks tombol */
    border: none; /* Hilangkan border */
    border-radius: 5px; /* Sudut membulat */
    cursor: pointer; /* Pointer pada hover */
    margin-left: 0; /* Hilangkan margin kiri */
    margin-left: -30px !important; /* Jarak ke kanan tombol */
    box-sizing: border-box;
}

/* Ikon dalam tombol */
form .search-icon-btn img {
    max-height: 20px; /* Sesuaikan ukuran ikon di tombol */
    vertical-align: middle; /* Ikon sejajar dengan teks */
}

/* Untuk Menjaga Tombol tetap di dalam Form */
form .search-icon-btn {
    flex-shrink: 0; /* Tombol tidak mengecil */
}



</style>

<section class="page-title style2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    Meeting anywhere, everywhere	
                </div>
                
                <div class="wrap-box-search">
                    <form action="{{ route('search_results') }}" method="get" accept-charset="utf-8">
                        <span>
                            <input type="text" placeholder="What are you looking for?" name="search" value="{{ request('search') }}">
                        </span>
                        <span class="location">
                            <input type="text" placeholder="Location" name="location" value="{{ request('location') }}">
                        </span>
                        <span class="categories new-categories">
							<select name="room_type">
								<option value="">Select Category</option>
								<option value="office-space" {{ request('room_type') == 'office-space' ? 'selected' : '' }}>Office Space</option>
								<option value="coworking" {{ request('room_type') == 'coworking' ? 'selected' : '' }}>Coworking</option>
								<option value="virtual-office" {{ request('room_type') == 'virtual-office' ? 'selected' : '' }}>Virtual Office</option>
								<option value="meeting-room" {{ request('room_type') == 'meeting-room' ? 'selected' : '' }}>Meeting Rooms</option>
							</select>

                        </span>
                        <button type="submit" class="search-icon-btn">
                            <img src="images/page/search.png" alt="Search">
                        </button>
                    </form>
                </div>

                @if(isset($results))
                    <div class="search-results mt-4">
                        @if($results->isEmpty())
                            <p>No results found. Try adjusting your search criteria.</p>
                        @else
                            <ul>
                                @foreach($results as $result)
                                    <li>
                                        <h3>{{ $result->room_title }}</h3>
                                        <p>{{ $result->description }}</p>
                                        <p><strong>Location:</strong> {{ $result->location }}</p>
                                        <p><strong>Category:</strong> {{ $result->room_type }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
