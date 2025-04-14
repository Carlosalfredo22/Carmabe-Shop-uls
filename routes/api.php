<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\DetallesPedidoController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\PagoController;

// Rutas protegidas por el middleware 'auth:sanctum'
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'userProfile']);

    //Agregar las demas rutas ejemplo pedido.
    Route::resource('metodos-pago', MetodoPagoController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('pedidos', PedidosController::class);
    Route::resource('detalles-pedido', DetallesPedidoController::class);
});
