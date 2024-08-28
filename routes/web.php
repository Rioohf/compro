<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ExperienceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware([
    'auth',
    'admin'
]);
route::get('user/dashboard', [HomeController::class, 'indexUser'])->middleware([
    'auth',
    'user'
]);
//Profile
route::get('admin/profiles', [ProfController::class, 'index'])->name('profile.index')->middleware([
    'auth',
    'admin'
]);
route::get('admin/profiles/create', [ProfController::class, 'create'])->name('profiles.create')->middleware([
    'auth',
    'admin'
]);
route::post('admin/profiles/store', [ProfController::class, 'store'])->name('profiles.store')->middleware([
    'auth',
    'admin'
]);
route::get('admin/profiles/edit/{id}', [ProfController::class, 'edit'])->name('profiles.edit')->middleware([
    'auth',
    'admin'
]);
// update dan softdelete
route::put('admin/profiles/update/{id}', [ProfController::class, 'update'])->name('profiles.update')->middleware([
    'auth',
    'admin'
]);
route::delete('admin/profiles/softdelete/{id}', [ProfController::class, 'softdelete'])->name('profiles.softdelete')->middleware([
    'auth',
    'admin'
]);
// end update dan softdelete
route::post('admin/profiles/update-status/{id}', [ProfController::class, 'updateStatus'])->name('profiles.update-status')->middleware([
    'auth',
    'admin'
]);
route::get('admin/recycle', [ProfController::class, 'recycle'])->name('profiles.recycle');
route::get('admin/restore/{id}', [ProfController::class, 'restore'])->name('profiles.restore');
route::delete('admin/destroy/{id}', [ProfController::class, 'destroy'])->name('profiles.destroy');
route::get('profile/generate-pdf/{id}', [ProfController::class, 'show'])->name('generate-pdf');

// Experience:
route::resource('experience', ExperienceController::class);
route::delete('admin/experience/softdelete/{id}', [ExperienceController::class, 'softdelete'])->name('experience.softdelete');
// route::get('admin/experience/edit/{id}', [ExperienceController::class, 'edit'])->name('experience.edit');
Route::get('admin/experience/recycle', [ExperienceController::class, 'recycle'])->name('experience.recycle');
route::get('admin/experience/restore/{id}', [ExperienceController::class, 'restore'])->name('experience.restore');
route::delete('admin/experience/destroy/{id}', [ExperienceController::class, 'destroy'])->name('experience.destroy');

route::get('compro', [ContentController::class, 'index']);



Route::get('/', function () {
    return view('welcome');
});
route::get('latihan', [CountController::class, 'index']);
route::get('penjumlahan', [CountController::class, 'jumlah'])->name('penjumlahan');
route::get('pengurangan', [CountController::class, 'kurang'])->name('pengurangan');
route::get('perkalian', [CountController::class, 'kali'])->name('perkalian');
route::get('pembagian', [CountController::class, 'bagi'])->name('pembagian');

route::post('storejumlah', [CountController::class, 'storejumlah'])->name('store_penjumlahan');
route::post('storekurang', [CountController::class, 'storekurang'])->name('store_pengurangan');
route::post('storekali', [CountController::class, 'storekali'])->name('store_perkalian');
route::post('storebagi', [CountController::class, 'storebagi'])->name('store_pembagian');


Route::get('/dashboard', function () {
    if (Auth::user()->id_level === 1) {
        return view('admin.dashboard');
    } elseif (Auth::user()->id_level === 2) {
        return view('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
