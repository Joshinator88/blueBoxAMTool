<?php

use App\Http\Controllers\ProfileController;
use App\http\Controllers\RegisterController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\CategoryController;
use App\Models\Role;
use App\Models\User;
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
route::post('usermanagement', [RegisterController::class, 'create']);
Route::post('editUser', [RegisterController::class, 'update']);
Route::get('search-users', [RegisterController::class, 'search']);

Route::get('/parents', [ParentController::class, 'index'])->name('parents.index');
Route::post('/parents', [ParentController::class, 'store'])->name('parents.store');
Route::resource('parents', ParentController::class);
Route::get('parents/search', [ParentController::class, 'search'])->name('parents.search');
Route::get('/parents/{id}/edit', [ParentController::class, 'edit'])->name('parents.edit');
Route::put('/parents/{id}', [ParentController::class, 'update'])->name('parents.update');
Route::delete('/parents/{id}', [ParentController::class, 'destroy'])->name('parents.destroy');

Route::resource('categories', CategoryController::class);
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

require __DIR__ . '/auth.php';
