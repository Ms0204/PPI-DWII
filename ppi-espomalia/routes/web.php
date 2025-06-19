<?php

use App\Http\Controllers\Auth\PasswordRecoveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\EgresosController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RolesController;
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
//Route::get('/nuevousuario', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

// Ruta para la vista de Inventarios
Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios.index');
Route::post('/inventarios', [InventarioController::class, 'store'])->name('inventarios.store');

// Ruta para la vista de Pagos
Route::get('/pagos', [PagosController::class, 'index'])->name('inventarios.index');
Route::post('/pagos', [PagosController::class, 'store'])->name('pagos.store');

// Ruta para la vista de Reportes
Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
Route::post('/reportes', [ReportesController::class, 'store'])->name('reportes.store');

// Ruta para la vista de Ingresos
Route::get('/ingresos', [IngresosController::class, 'index'])->name('ingresos.index');
Route::post('/ingresoss', [IngresosController::class, 'store'])->name('ingresos.store');

// Ruta para la vista de Egresos
Route::get('/egresos', [EgresosController::class, 'index'])->name('egresos.index');
Route::post('/egresoss', [EgresosController::class, 'store'])->name('egresos.store');

// Ruta para la vista de Productos
Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');

// Ruta para la vista de Categorias
Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');

// Ruta para la vista de Roles
Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');

// Ruta para la vista de Permisos
Route::get('/permisos', [PermisosController::class, 'index'])->name('permisos.index');
Route::post('/permisos', [PermisosController::class, 'store'])->name('permisos.store');