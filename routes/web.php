<?php

use App\Livewire\Administrasi\SuratMasuk;
use App\Livewire\User\RolePermission;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('suratmasuk-index', SuratMasuk::class)->name('suratmasuk.index');
Route::get('suratkeluar-index', SuratMasuk::class)->name('suratkeluar.index');
Route::get('user-index', UserIndex::class)->name('user.index');
Route::get('role-permission', RolePermission::class)->name('rolepermission.index');
Route::get('profil', SuratMasuk::class)->name('profil');
