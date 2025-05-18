<?php

use App\Http\Controllers\kategoriController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
Route::get('/', function () {
    return view('welcome');
});
});
Route::middleware('auth', 'verified')->group(function () {
// route admin
Route::get('admin/dashboard', function () {
    return view('admin/dashboard');
})->name('dashboard');
route::get('admin/data/userdata', [userController::class, 'userdata']);
route::get('admin/add/user', [userController::class, 'user']);
route::get('admin/add/user', [userController::class, 'tambah']);
route::post('admin/add/user', [userController::class, 'action_tambah'])->name('add.user');
route::get('admin/edit/{id}/user', [userController::class, 'edit']);
 Route::patch('admin/edit/user', [ProfileController::class, 'update'])->name('edit');

route::get('admin/data/kategori', [kategoriController::class, 'kategori']);

route::get('admin/data/produk', [produkController::class, 'produk']);


//  Route::get('/add/user')->name('add.user');
// route anggota
Route::get('anggota/dashboard', function () {
    return view('anggota/dashboard');
})->name('dashboard');

// route petugas
Route::get('petugas/dashboard', function () {
    return view('petugas/dashboard');
})->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('admin',function(){
//     return '<h1>helloadmin</h1>';
// })->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
