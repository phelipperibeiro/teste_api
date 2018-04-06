<?php

namespace App\Services;

use App\Jobs\ProdutoJob;
use App\Entities\ArquivoProdutos;

class ProdutoService
{
    public function produtoNovoLote(ArquivoProdutos $produtos)
    {
        foreach ($produtos->getProdutos() as $produto) {

            $job = (new ProdutoJob($produto->toArray()))
                    ->onConnection('database')
                    ->onQueue('default');

            dispatch($job);
        }
    }

}
