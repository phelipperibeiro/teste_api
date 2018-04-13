<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProdutoRepositoryInterface;
use App\Repositories\Interfaces\Transaction;
use App\Repositories\AbstractRepository;
use App\Models\Produtos;

class ProdutoRepository extends AbstractRepository implements ProdutoRepositoryInterface, Transaction
{

    public function __construct(Produtos $model)
    {
        $this->model = $model;
    }

    public function createProduto(array $dados)
    {
        if (!$this->create($dados)) {
            return ['sucesso' => false];
        }

        return ['sucesso' => true];
    }

    public function getProduto($id)
    {
        if (!$response = $this->find($id)) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function getProdutos()
    {
        if (!$response = $this->findAll()) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function updateProduto($id, array $dados)
    {
        if (!$response = $this->update($dados, $id)) {
            return ['sucesso' => false];
        }

        return ['sucesso' => true];
    }

    public function deleteProduto($id)
    {
        if (!$response = $this->delete($id)) {
            return ['sucesso' => false];
        }

        return ['sucesso' => true];
    }

    public function beginTransaction()
    {
        \DB::beginTransaction();
    }

    public function commit()
    {
        \DB::commit();
    }

    public function rollBack()
    {
        \DB::rollBack();
    }

}
