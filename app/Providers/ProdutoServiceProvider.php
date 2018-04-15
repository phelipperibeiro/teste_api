<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProdutoService;
use App\Repositories\ProdutoRepository;
use App\Repositories\LoggerQueueRepository;
use App\Models\Produto;
use App\Models\LoggerQueue;

class ProdutoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ProdutoService', function() {
            return new ProdutoService(new ProdutoRepository(new Produto()), new LoggerQueueRepository(new LoggerQueue));
        });
    }

}
