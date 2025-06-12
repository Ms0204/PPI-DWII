<?php

use App\Http\Controllers\Auth\PasswordRecoveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para mostrar el formulario de login
Route::get('/login', function () {
    return view('login'); // resources/views/login.blade.php
})->name('login');

// Ruta para procesar el login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');

// Ruta para recuperar contraseña del login
Route::post('/recover-password', [PasswordRecoveryController::class, 'recover'])->name('password.recover');

// Ruta para la vista de home
Route::get('/home', function () {
    return view('home.home'); // resources/views/home.blade.php
})->name('home');

// Ruta para la vista de Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');