<?php

namespace App\Repositories\Interfaces;

interface ProdutoRepositoryInterface
{

    public function createProduto(array $array);

    public function getProduto($id);

    public function getProdutos();

    public function updateProduto($id, array $array);

    public function deleteProduto($id);
}
