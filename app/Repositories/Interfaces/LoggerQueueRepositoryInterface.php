<?php

namespace App\Repositories\Interfaces;

interface LoggerQueueRepositoryInterface
{

    public function createLoggerQueue(array $dados);

    public function getLoggerQueue($queueName);
    
    public function updateLoggerQueue($queueName, array $array);
}
