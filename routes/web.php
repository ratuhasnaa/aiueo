<?php

use Illuminate\Support\Facades\Route;

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
