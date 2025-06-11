<?php

use App\Http\Controllers\Api\LivroController;
use Illuminate\Support\Facades\Route;


Route::get('/livros', [LivroController::class, 'index']);            // GET - 127.0.0.1/api/livros
Route::get('/livros/{id}', [LivroController::class, 'show']);        // GET - 127.0.0.1/api/livros/1
Route::post('/livros', [LivroController::class, 'store']);           // POST - 127.0.0.1/api/livros
Route::put('/livros/{id}', [LivroController::class, 'update']);      // PUT - 127.0.0.1/api/livros/1
Route::delete('/livros/{id}', [LivroController::class, 'destroy']);  // DELETE - 127.0.0.1/api/livros/1

// Rota ping para teste
Route::get('/ping', function () {
    return response()->json(['status' => true, 'message' => 'Pong'], 200);
});
