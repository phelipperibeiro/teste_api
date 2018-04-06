<?php

use Illuminate\Http\Request;
use App\Services\ProdutoService;
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

Route::get('/produto-novo-lote', function () {
    
    $Produto = new Produto();
    $Produto->setLm('1001');
    $Produto->setName('Furadeira X');
    $Produto->setFree_shipping('0');
    $Produto->setDescription('Furadeira eficiente X');
    $Produto->setPrice('100.00');

    $Produto2 = new Produto();
    $Produto2->setLm('1002');
    $Produto2->setName('Furadeira Y');
    $Produto2->setFree_shipping('1');
    $Produto2->setDescription('Furadeira super eficiente Y');
    $Produto2->setPrice('140.00');

    $Produto3 = new Produto();
    $Produto3->setLm('1003');
    $Produto3->setName('Chave de Fenda X');
    $Produto3->setFree_shipping('0');
    $Produto3->setDescription('Chave de fenda simples');
    $Produto3->setPrice('20.00');

    $Produto4 = new Produto();
    $Produto4->setLm('1008');
    $Produto4->setName('Serra de Marmore');
    $Produto4->setFree_shipping('1');
    $Produto4->setDescription('Serra com 1400W modelo 4100NH2Z-127V-L');
    $Produto4->setPrice('399.00');

    $Produto5 = new Produto();
    $Produto5->setLm('1009');
    $Produto5->setName('Broca Z');
    $Produto5->setFree_shipping('0');
    $Produto5->setDescription('Broca simples');
    $Produto5->setPrice('3.90');

    $Produto6 = new Produto();
    $Produto6->setLm('1010');
    $Produto6->setName('Luvas de Proteção');
    $Produto6->setFree_shipping('0');
    $Produto6->setDescription('Luva de proteção básica');
    $Produto6->setPrice('5.60');

    $ArquivoProdutos = new ArquivoProdutos();
    $ArquivoProdutos->addProduto($Produto);
    $ArquivoProdutos->addProduto($Produto2);
    $ArquivoProdutos->addProduto($Produto3);
    $ArquivoProdutos->addProduto($Produto4);
    $ArquivoProdutos->addProduto($Produto5);
    $ArquivoProdutos->addProduto($Produto6);
    
    dd($ArquivoProdutos);

    (new ProdutoService())->produtoNovoLote($ArquivoProdutos);
});
