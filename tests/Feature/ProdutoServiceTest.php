<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\ProdutoService;
use App\Repositories\ProdutoRepository;
use App\Models\Produtos;

class ProdutoServiceTest extends TestCase
{

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testVerificaSeOTipoDaClassseEstaCorreto()
    {
        $this->assertInstanceOf("App\Services\ProdutoService", new \App\Services\ProdutoService(new ProdutoRepository(new Produtos())));
    }

}
