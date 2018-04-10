<?php

use Illuminate\Http\Request;
use App\Services\ProdutoService;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/produto/{id}', function ($id) {
    return App::make('ProdutoService')->getProduto($id);
});

Route::get('/produtos', function () {
    return App::make('ProdutoService')->getProdutos();
});

Route::put('/produto/{id}', function ($id, Request $request) {
    return App::make('ProdutoService')->updateProduto($id, $request->all());
});

Route::delete('/produto/{id}', function ($id) {
    return App::make('ProdutoService')->deleteProduto($id);
});

Route::post('/produto-novo-lote', function (Request $request) {
    
    $validator = Validator::make($request->all(), [
            'planilha'   => 'required|mimes:xls,xlsx'
        ]);

    if ($validator->fails()) {
        return ['sucesso' => false, 'msg' => 'arquivo invalido'];
    }
    
    return App::make('ProdutoService')->processarDados($request->file('planilha'));
});
