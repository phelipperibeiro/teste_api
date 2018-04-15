<?php

namespace App\Repositories\Interfaces;

interface AbstractRepositoryInterface
{

    public function find($id);

    public function findAll();

    public function create(array $dados);

    public function update(array $dados, $id);

    public function delete($id);

    public function paginate($pages);
}
