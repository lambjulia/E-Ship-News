<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

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
    return redirect()->route('home');
});

Route::get('/home', [NewsController::class, 'allNews'])->name('home');

//User
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(['guest']);

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get')->middleware(['guest']);

Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post')->middleware(['guest']); 

Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get')->middleware(['guest']);

Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post')->middleware(['guest']);

Route::get('/criar-usuario', [UserController::class, 'create'])->name('user.create')->middleware(['guest']);

Route::post('/store-usuario', [UserController::class, 'store'])->name('user.store');

Route::get('/editar-usuario', [UserController::class, 'edit'])->name('user.edit');

Route::post('/update-usuario', [UserController::class, 'update'])->name('user.update');

Route::get('/minhas-noticias', [UserController::class, 'myNews'])->name('user.news');

//News
Route::get('/criar-noticia', [NewsController::class, 'create'])->name('news.create');

Route::post('/store-noticia', [NewsController::class, 'store'])->name('news.store');

Route::get('/ver-noticia/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/editar-noticia/{id}', [NewsController::class, 'edit'])->name('news.edit');

Route::post('/update-noticia/{id}', [NewsController::class, 'update'])->name('news.update');

Route::delete('/image-delete/{id}', [NewsController::class, 'destroyImage'])->name('image.delete');

Route::delete('/news-delete/{id}', [NewsController::class, 'destroyNews'])->name('news.delete');

//Admin
Route::get('/usuarios', [AdminController::class, 'allUsers'])->name('users');

Route::get('/admin/editar-usuario/{id}', [AdminController::class, 'edit'])->name('admin.user.edit');

Route::post('/admin/update-usuario/{id}', [AdminController::class, 'update'])->name('admin.user.update');

Route::delete('/user-delete/{id}', [AdminController::class, 'destroyUser'])->name('user.delete');