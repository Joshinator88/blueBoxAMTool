<?php

use App\Http\Controllers\ProfileController;
use App\http\Controllers\RegisterController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\CategoryController;
use App\Models\Role;
use App\Models\User;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('usermanagement', [RegisterController::class, 'index'])->name('usermanagement');
Route::post('usermanagement', [RegisterController::class, 'create']);
Route::post('editUser', [RegisterController::class, 'update'])->name('usermanagement');
Route::get('search-users', [RegisterController::class, 'search']);

Route::get('/parents', [MasterController::class, 'index'])->name('parents.index');
Route::post('/parents', [MasterController::class, 'store'])->name('parents.store');
Route::get('/parents/search', [MasterController::class, 'search'])->name('parents');
Route::get('/parents/{id}/edit', [MasterController::class, 'edit'])->name('parents.edit');
Route::post('/parents/update', [MasterController::class, 'update'])->name('parents.update');
Route::resource('parents', MasterController::class);

// Route::get('{parent}', [MasterController::class, 'indexOfOneMaster'])->name('parents');

Route::resource('categories', CategoryController::class);
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

require __DIR__ . '/auth.php';
