<?php

namespace App\Repositories\Interfaces;

interface TransactionInterface
{

    public function beginTransaction();

    public function commit();

    public function rollBack();
}
