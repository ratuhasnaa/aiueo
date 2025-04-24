<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\VenueNewController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LoginController;
use App\Models\Supplier;

// Homepage redirect (sementara ke venue pertama)
Route::get('/', function () {
    return redirect()->route('login');
});

// ========== VENUE ==========
// Form tambah venue baru
Route::get('/venues/create', [VenueNewController::class, 'create'])->name('venues.create');
Route::post('/venues/store', [VenueNewController::class, 'store'])->name('venues.store');

// Edit venue
Route::get('/editvenue/{id}', [VenueController::class, 'edit'])->name('admin.editvenue');
Route::put('editvenue/{id}/update', [VenueController::class, 'update'])->name('venues.update');

// Shortcut ke edit venue pertama (optional)
Route::get('/editvenue', function () {
    $venue = \App\Models\Venue::first(); // Bisa juga pakai Venue::find(1);
    return redirect()->route('admin.editvenue', $venue->id);
})->name('admin.editvenue.shortcut');

// ========== DASHBOARD ADMIN ==========
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// ========== STOCK ==========
Route::get('/stocks', [StockItemController::class, 'index'])->name('stocks.index');
Route::post('/stocks/bulk-delete', [StockItemController::class, 'bulkDelete'])->name('stocks.bulk-delete');
Route::post('/stocks/bulk-update', [StockItemController::class, 'bulkUpdate'])->name('stocks.bulk-update');
Route::put('/stocks/{id}', [StockItemController::class, 'update'])->name('stocks.update');




Route::get('/expenses', [ExpenseController::class, 'index'])->name('admin.expenses'); // Menampilkan semua data expense
Route::post('/expenses/store', [ExpenseController::class, 'store'])->name('admin.expenses.store'); // Menyimpan expense baru
Route::get('/expenses/edit/{id}', [ExpenseController::class, 'edit'])->name('admin.expenses.edit'); // Menampilkan form edit expense
Route::put('/expenses/update/{id}', [ExpenseController::class, 'update'])->name('admin.expenses.update'); // Mengupdate data expense
Route::delete('/expenses/delete/{id}', [ExpenseController::class, 'destroy'])->name('admin.expenses.destroy'); // Menghapus data expense



 // SUPPLIERS ROUTES
 

    // Menampilkan halaman form
    Route::get('/admin/suppliers', [SupplierController::class, 'create'])->name('admin.suppliers');
    
    // Menyimpan data supplier
    Route::post('/admin/suppliers/store', [SupplierController::class, 'store'])->name('admin.suppliers.store');
    Route::post('/admin/suppliers', [SupplierController::class, 'storeSupplier'])->name('admin.suppliers.store');
    Route::get('/admin/suppliers', [SupplierController::class, 'showSuppliers'])->name('admin.suppliers');
    Route::get('/admin/suppliers/{id}/edit', [SupplierController::class, 'edit']);
    Route::put('/admin/suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('/admin/suppliers/{id}', [SupplierController::class, 'destroy']);


    // ========== STATIC VIEWS ==========
Route::get('/bookings', function () {
    return view('admin.bookings');
});
Route::get('/pmethods', function () {
    return view('admin.pmethods');
});

// ========== ROOMS ==========
Route::get('/addrooms', function () {
    $rooms = \App\Models\Room::all();
    return view('admin.addrooms', compact('rooms'));
})->name('admin.addrooms');

Route::put('/rooms/{room}/update-status', [RoomController::class, 'updateStatus'])->name('rooms.updateStatus');

// ========== AUTH - LOGIN ==========
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
=======

use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\SearchController;



route::get('/',[AdminController::class,'home']);

Route::get('/home', [AdminController::class, 'index'])->name('home'); // Semua user diarahkan ke home

Route::post('/login', [AdminController::class, 'login'])->name('login');

route::post('/login', [AdminController::class, 'login'])->name('login');

route::get('/home', [AdminController::class,'index'])->name('home');

route::get('/create_room', [AdminController::class,'create_room']);

route::post('/add_room', [AdminController::class,'add_room']);

route::get('/view_room', [AdminController::class,'view_room']);

route::get('/room_delete/{id}', [AdminController::class,'room_delete']);

route::get('/room_update/{id}', [AdminController::class,'room_update']);

route::post('/edit_room/{id}', [AdminController::class,'edit_room']);

route::get('/room_details/{id}', [HomeController::class, 'room_details'])->name('room_details');

Route::get('/checkout/{room_id}/{variation_id}', [HomeController::class, 'checkout'])->name('checkout');

route::post('/check-availability/{id}', [HomeController::class, 'check_availability']);

route::post('/add_booking/{id}', [HomeController::class,'add_booking']);

route::get('/bookings', [AdminController::class,'bookings']);

route::get('/approve_book/{id}', [AdminController::class,'approve_book']);

route::get('/reject_book/{id}', [AdminController::class,'reject_book']);

route::get('/send_mail/{id}', [AdminController::class,'send_mail']);

route::post('/mail/{id}', [AdminController::class,'mail']);

route::get('/send_mail_direct/{id}', [AdminController::class, 'send_mail_direct']);

Route::get('/delete_room_image/{id}', [AdminController::class, 'delete_room_image'])->name('delete_room_image');

Route::get('/search_results', [SearchController::class, 'index'])->name('search_results');

Route::get('/payment/{booking}', [HomeController::class, 'paymentPage'])->name('payment.page');

Route::post('/payment/{booking}', [HomeController::class, 'submitPayment'])->name('payment.submit');

Route::post('/upload-payment/{booking}', [HomeController::class, 'uploadPayment'])->name('upload.payment');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [App\Http\Controllers\HomeController::class, 'myBookings'])->name('my.bookings');
});
>>>>>>> fitur-admin
