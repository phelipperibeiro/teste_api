<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Services\ProdutoService;
use App\Repositories\ProdutoRepository;
use App\Repositories\LoggerQueueRepository;
use App\Entities\Produto;
use App\Models\Produto as ProdutoModel;
use App\Models\LoggerQueue;

class ProdutoServiceTest extends TestCase
{

    use DatabaseTransactions;

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testVerificaSeOTipoDaClassseEstaCorreto()
    {
        $this->assertInstanceOf("App\Services\ProdutoService", new \App\Services\ProdutoService(new ProdutoRepository(new ProdutoModel()), new LoggerQueueRepository(new LoggerQueue())));
    }

    public function testVerificaFuncionamentoProdutoServiceEnviarArquivoProdutosFila()
    {

        $Produto = new Produto();
        $Produto->setLm('1001');
        $Produto->setName('Furadeira X');
        $Produto->setFree_shipping('0');
        $Produto->setDescription('Furadeira eficiente X');
        $Produto->setPrice('100.00');

        $Produto2 = new Produto();
        $Produto2->setLm('1002');
        $Produto2->setName('Furadeira Y');
        $Produto2->setFree_shipping('1');
        $Produto2->setDescription('Furadeira super eficiente Y');
        $Produto2->setPrice('140.00');


        $ArquivoProdutos = new \App\Entities\ArquivoProdutos();
        $ArquivoProdutos->setFileName('testVerificaFuncionamentoProdutoServiceEnviarArquivoProdutosFila');
        $ArquivoProdutos->addProduto($Produto);
        $ArquivoProdutos->addProduto($Produto2);

        \App::make('ProdutoService')->enviarArquivoProdutosFila($ArquivoProdutos);

        $this->assertDatabaseHas('logger_queue', ['queue_name' => $ArquivoProdutos->getId(), 'status_id' => 1]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaFuncionamentoProdutoServiceProcessarArquivoProdutosInvalidArgumentException()
    {

        $Produto = new Produto();
        $Produto->setLm('1010');
        $Produto->setName('XPTO');
        $Produto->setFree_shipping('0');
        $Produto->setDescription('XPTO');
        $Produto->setPrice('100.00');

        $ArquivoProdutos = new \App\Entities\ArquivoProdutos();
        $ArquivoProdutos->setFileName('testVerificaFuncionamentoProdutoServiceEnviarArquivoProdutosFila');
        $ArquivoProdutos->addProduto($Produto);

        \App::make('ProdutoService')->processarArquivoProdutos($ArquivoProdutos);
    }

    public function testVerificaFuncionamentoProdutoServiceProcessarArquivoProdutos()
    {

        $Produto = new Produto();
        $Produto->setLm('1010');
        $Produto->setName('XPTO');
        $Produto->setFree_shipping('0');
        $Produto->setDescription('XPTO');
        $Produto->setPrice('100.00');

        $ArquivoProdutos = new \App\Entities\ArquivoProdutos();
        $ArquivoProdutos->setFileName('testVerificaFuncionamentoProdutoServiceEnviarArquivoProdutosFila');
        $ArquivoProdutos->addProduto($Produto);
        
        \App::make('ProdutoService')->enviarArquivoProdutosFila($ArquivoProdutos);

        \App::make('ProdutoService')->processarArquivoProdutos($ArquivoProdutos);

        $this->assertDatabaseHas('produto', ['description' => 'XPTO', 'name' => 'XPTO']);
    }

}
