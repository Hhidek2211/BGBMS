<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
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

Route::controller(UserProfileController::class)->group(function(){
    Route::get('/top', 'top')-> name('top');    //RouteServiceProviderに直接ルートを書いているので変更時は当該ファイルも要確認
    Route::get('/user/create', 'create') -> name('usercreate');
    Route::post('/user/create/store', 'store') ->name('userstore');
    Route::get('/user/{user}/edit', 'edit') ->name('useredit');
    Route::put('/user/{user}/edit/update', 'update')->name('userupdate');
    Route::get('/user/{user}/band/list', 'bandlist')->name('bandlist');
});

Route::controller(BandProfileController::class)->group(function(){
    Route::get('/band/create', 'create')->name('bandcreate');
    Route::post('/band/create/store', 'store')->name('bandstore');
    Route::get('/band/{band}', 'bandpage')->name('bandpage');
    Route::get('/band/{band}/edit', 'edit')->name('bandedit');
    Route::put('/band/{band}/edit/update', 'update')->name('bandupdate');
    Route::get('/band/{band}/app/list', 'applist')->name('applist');
    Route::get('/band/{band}/app/{user}/detail', 'appdetail')->name('appdetail'); //applicationsテーブルは自己idを保持しないためuserprofiles経由で情報を格納する
    Route::put('/band/{band}/app/{user}/approval', 'approval')->name('app_approval');
});

Route::controller(RecruitmentController::class)->group(function(){
    Route::get('/band/{band}/recruitment/create', 'create')->name('recruitmentcreate');
    ROute::post('/band/{band}/recruitment/create/store', 'store')->name('recruitmentstore');
    Route::get('/recruitment/list', 'Recruitlist')->name('recruitmentlist');
    Route::get('/recruitment/list/{recruit}', 'detail')->name('recruitdetail');
    Route::get('/recruitment/{recruit}/form', 'appform')->name('appform');
    Route::post('/recruitment/{recruit}/app', 'application')->name('application');
    Route::delete('/recruitment/{recruit}/delete', 'delete')->name('recruitdelete');
});