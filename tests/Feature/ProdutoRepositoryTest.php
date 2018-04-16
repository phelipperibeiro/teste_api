<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\ProdutoRepository;
use App\Models\Produto;

class ProdutoRepositoryTest extends TestCase
{

    //use DatabaseTransactions;

    public function testVerificaSeOTipoDaClassseEstaCorreto()
    {
        $this->assertInstanceOf("App\Repositories\ProdutoRepository", new ProdutoRepository(new Produto()));
    }

    public function testverificaSeCriaProduto()
    {
        $produtoRepository = new ProdutoRepository(new Produto());

        $produto = ['lm' => 'lm_xpto',
            'name' => 'name_xpto',
            'free_shipping' => '0',
            'description' => 'description_xpto',
            'price' => '100.00'];

        $produtoRepository->create($produto);

        $this->assertDatabaseHas('produto', $produto);
    }

    public function testverificaSeAtualizaProduto()
    {
        $produtoRepository = new ProdutoRepository(new Produto());

        $produto = ['lm' => 'lm_xpto',
            'name' => 'name_xpto',
            'free_shipping' => '0',
            'description' => 'description_xpto',
            'price' => '100.00'];

        $response = $produtoRepository->createProduto($produto);

        $produto = ['lm' => 'lm_xpth',
            'name' => 'name_xpth',
            'free_shipping' => '1',
            'description' => 'description_xpth',
            'price' => '200.00'];

        $produtoRepository->updateProduto($response['id'], $produto);

        $this->assertDatabaseHas('produto', $produto);
    }

    public function testverificaSePegaProdutoFalse()
    {
        $produtoRepository = new ProdutoRepository(new Produto());

        $produto = $produtoRepository->getProduto(0);

        $this->assertEquals(['sucesso' => false, 'dados' => []], $produto);
    }

    public function testverificaSePegaProdutoTrue()
    {
        $produtoRepository = new ProdutoRepository(new Produto());

        $produto = ['lm' => 'lm_xpto',
            'name' => 'name_xpto',
            'free_shipping' => '0',
            'description' => 'description_xpto',
            'price' => '100.00'];

        $response = $produtoRepository->createProduto($produto);

        $produto = $produtoRepository->getProduto($response['id']);

        $this->assertContains(['sucesso' => true], $produto);
    }

    public function testverificaSeDeletaProduto()
    {
        $produtoRepository = new ProdutoRepository(new Produto());

        $produto = ['lm' => 'lm_xpto',
            'name' => 'name_xpto',
            'free_shipping' => '0',
            'description' => 'description_xpto',
            'price' => '100.00'];

        $response = $produtoRepository->createProduto($produto);

        $response = $produtoRepository->deleteProduto($response['id']);

        $this->assertContains(['sucesso' => true], $response);
    }

}
