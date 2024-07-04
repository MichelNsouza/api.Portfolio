<?php

use App\Http\Controllers\ApiProjetoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('projetos', ApiProjetoController::class);

/*
GET /projetos: Rota para listar todos os projetos (index method).
GET /projetos/{id}: Rota para exibir um projeto específico (show method).
POST /projetos: Rota para criar um novo projeto (store method).
PUT /projetos/{id} ou PATCH /projetos/{id}: Rota para atualizar um projeto existente (update method).
DELETE /projetos/{id}:
 */
