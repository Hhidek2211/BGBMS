<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BandProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ScoutController;
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
    return view('menu.welcome');
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

Route::middleware('auth')->controller(UserProfileController::class)->group(function(){
    Route::get('/top', 'top')-> name('top');    //RouteServiceProviderに直接ルートを書いているので変更時は当該ファイルも要確認
    Route::get('/user/create', 'create') -> name('user_create');
    Route::post('/user/create/store', 'store') ->name('user_store');
    Route::get('/user/{user}/edit', 'edit') ->name('user_edit');
    Route::put('/user/{user}/edit/update', 'update')->name('user_update');
    Route::get('/user/{user}/band/list', 'bandlist')->name('band_list');
    Route::get('/user/{user}/scout/list', 'scoutlist')->name('scout_list'); // ユーザー機能の中でスカウトを確認するためuserprofileconrollerに実装
    Route::get('/user/{user}/scout/{scout}', 'scoutdetail')->name('scout_detail');
    Route::put('/user/{user}/scout/{scout}/approve', 'scoutapprove')->name('scout_approve');
});

Route::middleware('auth')->controller(BandProfileController::class)->group(function(){
    Route::get('/band/create', 'create')->name('band_create');
    Route::post('/band/create/userinst', 'getuserinst')->name('getuserinst');
    Route::post('/band/create/store', 'store')->name('bandstore');
    Route::get('/band/{band}', 'bandpage')->name('bandpage');
    Route::get('/band/{band}/edit', 'edit')->name('bandedit');
    Route::put('/band/{band}/edit/update', 'update')->name('bandupdate');
    Route::get('/band/{band}/app/list', 'applist')->name('applist');
    Route::get('/band/{band}/app/{user}/detail', 'appdetail')->name('appdetail'); //applicationsテーブルは自己idを保持しないためuserprofiles経由で情報を格納する
    Route::put('/band/{band}/app/{user}/approval', 'approval')->name('app_approval');
});

Route::middleware('auth')->controller(RecruitmentController::class)->group(function(){
    Route::get('/band/{band}/recruitment/create', 'create')->name('recruitmentcreate');
    ROute::post('/band/{band}/recruitment/create/store', 'store')->name('recruitmentstore');
    Route::get('/recruitment/list', 'Recruitlist')->name('recruitment_list');
    Route::get('/recruitment/list/{recruit}', 'detail')->name('recruitdetail');
    Route::post('/recruitment/{recruit}/app', 'application')->name('application');
    Route::delete('/recruitment/{recruit}/delete', 'delete')->name('recruitdelete');
});

Route::middleware('auth')->controller(ScoutController::class)->group(function () {
    Route::get('/band/{band}/scout/select', 'select')->name('scout_userselect');
    Route::get('/band/{band}/scout/select/re', 'reload')->name('scout_userselect_reload');
    Route::get('/band/{band}/scout/{user}', 'detail')->name('scout_userdetail');
    Route::get('/band/{band}/scout/{user}/create', 'create')->name('scout_create');
    Route::post('/band/{band}/scout/{user}/create/store', 'store')->name('scout_store');
});