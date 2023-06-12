<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [NewsController::class, 'allNews'])->name('home');

//User
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(['guest'])->middleware(['guest']);

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/criar-usuario', [UserController::class, 'create'])->name('user.create')->middleware(['guest']);

Route::post('/store-usuario', [UserController::class, 'store'])->name('user.store');

Route::get('/editar-usuario', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');

Route::post('/update-usuario', [UserController::class, 'update'])->name('user.update')->middleware('auth');

Route::get('/minhas-noticias', [UserController::class, 'myNews'])->name('user.news')->middleware('checkUserRole:user');

//News
Route::get('/criar-noticia', [NewsController::class, 'create'])->name('news.create')->middleware('checkUserRole:user');

Route::post('/store-noticia', [NewsController::class, 'store'])->name('news.store')->middleware('checkUserRole:user');

Route::get('/ver-noticia/{id}', [NewsController::class, 'show'])->name('news.show');

Route::get('/editar-noticia/{id}', [NewsController::class, 'edit'])->name('news.edit')->middleware('auth');

Route::post('/update-noticia/{id}', [NewsController::class, 'update'])->name('news.update')->middleware('auth');

Route::delete('/image-delete/{id}', [NewsController::class, 'destroyImage'])->name('image.delete')->middleware('auth');

Route::delete('/news-delete/{id}', [NewsController::class, 'destroyNews'])->name('news.delete')->middleware('auth');

Route::get('/filter', [NewsController::class, 'filter'])->name('news.filter');

//Admin
Route::get('/usuarios', [AdminController::class, 'allUsers'])->name('users')->middleware('checkUserRole:admin');

Route::get('/admin/editar-usuario/{id}', [AdminController::class, 'edit'])->name('admin.user.edit')->middleware('checkUserRole:admin');

Route::post('/admin/update-usuario/{id}', [AdminController::class, 'update'])->name('admin.user.update')->middleware('checkUserRole:admin');

Route::delete('/user-delete/{id}', [AdminController::class, 'destroyUser'])->name('user.delete')->middleware('checkUserRole:admin');