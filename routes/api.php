<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;

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

});

