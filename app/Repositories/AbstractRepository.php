<?php

namespace App\Repositories;

abstract class AbstractRepository
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function create(array $dados)
    {
        return $this->model->create($dados);
    }

    public function update(array $dados, $id)
    {
        return $this->model->find($id)->update($dados);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    
    public function paginate($pages)
    {
        return $this->model->paginate($pages);
    }

}
