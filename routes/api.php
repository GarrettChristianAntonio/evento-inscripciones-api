<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ParticipanteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/participantes', [ParticipanteController::class, 'store']);

Route::get('/participantes/{id}', [ParticipanteController::class, 'show']);