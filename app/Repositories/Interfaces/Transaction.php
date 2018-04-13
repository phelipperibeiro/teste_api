<?php

namespace App\Repositories\Interfaces;

interface Transaction
{

    public function beginTransaction();

    public function commit();

    public function rollBack();
}
