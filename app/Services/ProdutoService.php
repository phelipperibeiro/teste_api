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
    }

    public function processarArquivoProdutos(ArquivoProdutos $arquivoProdutos)
    {
        foreach ($arquivoProdutos->getProdutos() as $produto) {
            Produtos::create($this->produto->toArray());
        }
    }

}
