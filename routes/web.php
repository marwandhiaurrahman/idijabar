<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Livewire\Administrasi\DisposisiEdit;
use App\Livewire\Administrasi\DisposisiIndex;
use App\Livewire\Administrasi\SuratMasuk;
use App\Livewire\Administrasi\SuratMasukIndex;
use App\Livewire\Organisasi\PengurusIndex;
use App\Livewire\User\RolePermission;
use App\Livewire\Organisasi\StrukturIndex;
use App\Livewire\User\ProfilIndex;
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

Auth::routes();
Route::get('/refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
});
Route::get('disposisi-print', [DisposisiEdit::class, 'print'])->name('disposisi.print');
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('landingpage');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profil', ProfilIndex::class)->name('profil');

    Route::get('suratmasuk-index', SuratMasukIndex::class)->name('suratmasuk.index');
    Route::get('disposisi-index', DisposisiIndex::class)->name('disposisi.index');
    Route::get('disposisi-edit', DisposisiEdit::class)->name('disposisi.edit');
    Route::get('suratkeluar-index', SuratMasuk::class)->name('suratkeluar.index');
    Route::get('pengurus-index', PengurusIndex::class)->name('pengurus.index');
    Route::get('struktur-index', StrukturIndex::class)->name('struktur.index');
    Route::get('user-index', UserIndex::class)->name('user.index');
    Route::get('role-permission', RolePermission::class)->name('rolepermission.index');
});
