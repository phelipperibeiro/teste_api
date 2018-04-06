<?php

namespace App\Entities;

class ArquivoProdutos
{
    /*
     * @Produtos
     */
    private $produtos = [];

    function addProduto(Produto $produto)
    {
        $this->produtos[] = $produto;
    }

    function getProdutos()
    {
        return $this->produtos;
    }

}
