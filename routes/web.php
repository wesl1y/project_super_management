<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get("/",[\App\http\Controllers\PrincipalController::class, 'principal'])->name("site.index");

Route::get("/contato",[\App\http\Controllers\ContatoController::class, 'contato'])
->name("site.contato");

Route::get("/sobre-nos",[\App\http\Controllers\SobreNosController::class, 'sobreNos'])
->name("site.sobre-nos");

Route::get("/login", function(){echo "Login";}) ->name("site.login");

Route::prefix("/app")->group(function(){
    Route::get("/clientes", function(){echo "clientes";})
    ->name("app.clientes");

    Route::get("/fornecedores",[\App\http\Controllers\FornecedorController::class, 'index'])
    ->name("app.fornecedores");

    Route::get("/produtos", function(){echo "produtos";})
    ->name("app.produtos");
});

Route::get("/teste/{p1}/{p2}",[\App\http\Controllers\TesteController::class, 'teste'])
->name("teste");


Route::fallback(function(){
    echo "A rota acessada nao existe.";
});