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
         $response = $this->model->select(
                'logger_queue.status_id',
                'logger_queue.queue_name',
                'logger_queue_status.description'
            )->join('logger_queue_status', 'logger_queue_status.id', '=', 'logger_queue.status_id')
             ->where('queue_name', $queueName)->get();
         
        if ($response->isEmpty()) {
            return ['sucesso' => false, 'dados' => []];
        }
        
        return ['sucesso' => true, 'dados' => $response];
    }

    public function updateLoggerQueue($queueName, array $dados)
    {
        if (!$this->model->where(['queue_name' => $queueName])->update($dados)) {
             throw new \InvalidArgumentException("Job nao localizado na fila de processamento");
        }

        return ['sucesso' => true];
    }

}
