<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProdutoRepositoryInterface;
use App\Repositories\Interfaces\TransactionInterface;
use App\Repositories\AbstractRepository;
use App\Models\Produto;

class ProdutoRepository extends AbstractRepository implements ProdutoRepositoryInterface, TransactionInterface
{

    public function __construct(Produto $model)
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
        if (!$this->update($dados, $id)) {
            return ['sucesso' => false];
        }

        return ['sucesso' => true];
    }

    public function deleteProduto($id)
    {
        if (!$this->delete($id)) {
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
