<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BandProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RecruitmentController;
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

require __DIR__.'/auth.php';

Route::get('/menu/top', [MenuController::class, 'top'])-> name('top');

Route::controller(UserController::class)->group(function(){
    Route::get('/user/create', 'create') -> name('usercreate');
    Route::post('/user/createuser', 'store') ->name('userstore');
    Route::get('/user/{user}/edit', 'edit') ->name('useredit');
    Route::put('/user/{user}/editband', 'update')->name('userupdate');
    Route::get('/band/list', 'bandlist')->name('list');
});

Route::controller(BandProfileController::class)->group(function(){
    Route::get('/band/create', 'create')->name('bandcreate');
    Route::post('/band/createband', 'store')->name('bandstore');
    Route::get('/band/{band}', 'bandpage')->name('bandpage');
    Route::get('/band/{band}/edit', 'edit')->name('bandedit');
    Route::put('/band/{band}/editband', 'update')->name('bandupdate');
});

Route::controller(RecruitmentController::class)->group(function(){
    Route::get('/band/{band}/recruitment/create', 'create')->name('recruitmentcreate');
    ROute::post('/band/{band}/recruitment/createrecruit', 'store')->name('recruitmentstore');
    Route::get('/recruitment/list', 'list')->name('recruitmentlist');
    Route::get('/recruitment/list/{recruit}', 'detail')->name('recruitdetail');
});