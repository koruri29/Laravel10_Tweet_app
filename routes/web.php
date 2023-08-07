<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\UpdateController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function() {
    Route::get('/', [ReadController::class, 'show'])
        ->name('index');   
    Route::get('/tweet', [ReadController::class, 'show'])
        ->name('index');
    Route::post('/tweet', [CreateController::class, 'create'])
        ->name('create');
    Route::get('tweet/edit/{tweetId}', [UpdateController::class, 'edit'])
        ->name('edit.edit');
    Route::post('tweet/edit/{tweetId}', [UpdateController::class, 'update'])
        ->name('edit.update');
    Route::get('tweet/delete/{tweetId}', [DeleteController::class, 'delete'])
        ->name('delete');
});
