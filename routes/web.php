<?php

use App\Http\Controllers\kategoriController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\setoranController;
use App\Http\Controllers\userController;
use App\Models\setoranModel;
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
})->name('admin/dashboard');
route::get('admin/data/userdata', [userController::class, 'userdata']);
// route::get('admin/add/user', [userController::class, 'user']);
route::get('admin/add/user', [userController::class, 'tambah']);
route::post('admin/add/user', [userController::class, 'action_tambah'])->name('add.user');
route::get('admin/edit/{idi}/user', [userController::class, 'edit']);
Route::post('admin/edit/{id}/user', [userController::class, 'action_edit']);
Route::get('admin/data/userdata/{id}/hapus', [userController::class, 'hapus']);

route::get('admin/data/kategori', [kategoriController::class, 'kategori']);
route::get('admin/add/kategori', [kategoriController::class, 'tambah']);
route::post('admin/add/kategori', [kategoriController::class, 'action_tambah'])->name('add.kategori');
route::get('admin/edit/{id}/kategori', [kategoriController::class, 'edit']);
Route::post('admin/edit/{id}/kategori', [kategoriController::class, 'action_edit']);
Route::get('admin/data/kategori/{id}/hapus', [kategoriController::class, 'hapus']);

route::get('admin/data/produk', [produkController::class, 'produk']);
route::get('admin/add/produk', [produkController::class, 'tambah']);
route::post('admin/add/produk', [produkController::class, 'action_tambah'])->name('add.produk');
route::get('admin/edit/{id}/produk', [produkController::class, 'edit']);
Route::post('admin/edit/{id}/produk', [produkController::class, 'action_edit']);
Route::get('admin/data/produk/{id}/hapus', [produkController::class, 'hapus']);

route::get('admin/data/pesanan', [pesananController::class, 'pesanan']);


//  Route::get('/add/user')->name('add.user');
// route anggota
Route::get('anggota/dashboard', function () {
    return view('/anggota/dashboard');
})->name('dashboard');

// Route::get('anggota/pesanan/pesanan', function () {
//     return view('anggota/pesanan/pesanan');
// });
route::get('anggota/pesanan/{id}/pesanan', [pesananController::class, 'pesan']);
route::post('anggota/pesanan/pesanan', [pesananController::class, 'action_pesan'])->name('pesan_sekarang');
// route::get('anggota/setoran/bayar', [pesananController::class, 'setoran']);
// Route::get('anggota/setoran/{id}/bayar', [SetoranController::class, 'bayar'])->name('setoran.bayar');
Route::get('/anggota/setoran/{id}/bayar', [SetoranController::class, 'bayar'])->name('setoran.bayar');
Route::get('/anggota/pesanan/riwayat/{id}', [setoranController::class, 'riwayat']);
Route::get('/anggota/setoran/riwayat/{setoran}', [setoranController::class, 'sukses'])->name('setoran-sukses');

Route::get('/anggota/setoran/riwayat/{id}', [setoranController::class, 'riwayat']);

// route petugas
Route::get('petugas/dashboard', function () {
    return view('petugas/dashboard');
})->name('petugas/dashboard');

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


