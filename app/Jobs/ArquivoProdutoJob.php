<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Entities\ArquivoProdutos;
use App\Services\ProdutoService;

class ArquivoProdutoJob implements ShouldQueue
{

    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    private $arquivoProdutos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ArquivoProdutos $ArquivoProdutos)
    {
        $this->arquivoProdutos = $ArquivoProdutos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new ProdutoService())->processarArquivoProdutos($this->arquivoProdutos);
    }

}
