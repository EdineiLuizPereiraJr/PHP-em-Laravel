<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Route;

Route::get('/eventos', [EventoController::class, 'index']);
Route::post('/eventos', [EventoController::class, 'store']);

Route::get('/participantes', [ParticipanteController::class, 'index']);
Route::post('/participantes', [ParticipanteController::class, 'store']);

Route::get('/inscricoes/resumo', [InscricaoController::class, 'resumo']);
