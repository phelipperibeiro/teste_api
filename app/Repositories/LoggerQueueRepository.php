<?php

namespace App\Repositories;

use App\Repositories\Interfaces\LoggerQueueRepositoryInterface;
use App\Repositories\AbstractRepository;
use App\Models\LoggerQueue;

class LoggerQueueRepository extends AbstractRepository implements LoggerQueueRepositoryInterface
{

    public function __construct(LoggerQueue $model)
    {
        $this->model = $model;
    }

    public function createLoggerQueue(array $dados)
    {
        if (!$this->create($dados)) {
            return ['sucesso' => false];
        }

        return ['sucesso' => true];
    }

    public function getLoggerQueue($queueName)
    {
        if (!$response = $this->find($queueName)) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function updateLoggerQueue($queueName, array $dados)
    {
        if (!$this->update($dados, $queueName)) {
            return ['sucesso' => false];
        }

        return ['sucesso' => true];
    }

}
