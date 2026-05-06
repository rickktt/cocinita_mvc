<?php

use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Route;

//ruta que redirige a el login
Route::get('/', function () {
    return redirect()->route('login');
});

//ruta para mostrar el dashboard  para los cocineros o los asistentes (meseros supongo)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Editar perfil
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    //Ruta del crudsito
    Route::resource('recetas', RecetaController::class);

    //ruta para generar el pdf de la receta inventada
    Route::get('recetas/{receta}/pdf', [RecetaController::class, 'pdf'])->name('recetas.pdf');
});

//las rutas del auth
require __DIR__.'/auth.php';
require __DIR__.'/auth.php';
