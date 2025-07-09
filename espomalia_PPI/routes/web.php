<?php
use App\Http\Controllers\Auth\PasswordRecoveryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Ruta para mostrar el formulario de login
Route::get('/', function () {
    return view('index'); // resources/views/login.blade.php
})->name('login');

// Ruta para procesar el login
Route::post('/login', [AuthController::class, 'procesarLogin'])->name('login.procesar');

// Ruta para recuperar contraseña del login
Route::post('/recover-password', [PasswordRecoveryController::class, 'recover'])->name('password.recover');

// Ruta para la vista de home
Route::get('/home', function () {
    return view('home.home'); // resources/views/home.blade.php
})->name('home');

// Ruta para la vista de Usuarios
Route::resource('usuarios', UsuarioController::class);

// Ruta para la vista de Inventarios
Route::resource('inventarios', InventarioController::class);

// Ruta para la vista de Pagos
Route::resource('pagos', PagoController::class);

// Ruta para la vista de Reportes
Route::resource('reportes', ReporteController::class);

// Ruta para la vista de Ingresos
Route::resource('ingresos', IngresoController::class);

// Ruta para la vista de Egresos
Route::resource('egresos', EgresoController::class);

// Ruta para la vista de Productos
Route::resource('productos', ProductoController::class);

// Ruta para la vista de Categorías
Route::resource('categorias', CategoriaController::class);

// Ruta para la vista de Roles
Route::resource('roles', RolController::class);

// Ruta para la vista de Permisos
Route::resource('permisos', PermisoController::class);