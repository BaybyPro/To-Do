<?php

use App\Http\Controllers\AuthController;
use App\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//vista principal home para registro o login
Route::get('/', function () {
    return Auth::check()  ? redirect()->route('tasks') : redirect()->route('login'); //veridicamos si se inició sessión para mostrar tasks de lo contrario mostrar login
});
//redireción a la vista /home en caso no este autentificado
Route::get('/login', function () {
    return Auth::check()  ? redirect()->route('tasks') : view('home'); //veridicamos si se inició sessión para mostrar tasks de lo contrario mostrar login
})->name('login');

//controlador para cerrar sessión
Route::post('/logout',action: [AuthController::class,'logout'])->name('logout');

// Ruta para restablecimiento de contraseña
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

//Rutas protegias con sanctum
Route::middleware('auth:sanctum')->group(function(){
    Route::view('/tasks', 'tasks')->name('tasks');
    
});

