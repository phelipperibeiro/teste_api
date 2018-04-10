<?php

use Illuminate\Http\Request;
use App\Services\ProdutoService;
use App\Services\UtilsService;
use App\Entities\Produto;
use App\Entities\ArquivoProdutos;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

    $dados = App::make('ProdutoService')->extrairDadosPlanilha($request->file('planilha'));
    
    $ArquivoProdutos = new ArquivoProdutos();

    foreach ($dados["Plan1"] as $key => $value) {
        
        list($ln, $name, $free_shipping, $description, $price) = array_values($dados["Plan1"][$key]);
        
        if (empty(array_filter([$ln, $name, $free_shipping, $description, $price]))) {break;}
        
        $ArquivoProdutos->addProduto(new Produto($ln, $name, $free_shipping, $description, $price));
    }
   
    return App::make('ProdutoService')->enviarArquivoProdutosFila($ArquivoProdutos);
});
