<?php

namespace App\Services;

use App\Jobs\ArquivoProdutoJob;
use App\Entities\ArquivoProdutos;
use App\Models\Produtos;

class ProdutoService
{

    public function enviarArquivoProdutosFila(ArquivoProdutos $arquivoProdutos)
    {
        $job = (new ArquivoProdutoJob($arquivoProdutos))
                ->onConnection('database')
                ->onQueue('default');

        dispatch($job);
        
        return ['sucesso' => true];
    }

    public function processarArquivoProdutos(ArquivoProdutos $arquivoProdutos)
    {
        foreach ($arquivoProdutos->getProdutos() as $produto) {
            Produtos::create($produto->toArray());
        }
    }

    public function getProduto($id)
    {
        if (!$response = Produtos::find($id)) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function getProdutos()
    {
        if (!$response = Produtos::all()) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function updateProduto($id, Request $request)
    {
        if (!$produto = Produtos::find($id)) {
            return ['sucesso' => false];
        }
        
        $produto->update($request->all());
        
        return ['sucesso' => true];
    }

    public function deleteProduto($id)
    {
        
        if (!$produto = Produtos::find($id)) {
            return ['sucesso' => false];
        }
        
        $produto->delete();
        
        return ['sucesso' => true];
    }

}
