<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\Produto;
use App\Entities\ArquivoProdutos;

class ArquivoProdutosTest extends TestCase
{

    public function testVerificaSeOTipoDaClassseEstaCorreto()
    {
        $this->assertInstanceOf("App\Entities\ArquivoProdutos", new \App\Entities\ArquivoProdutos());
    }

    public function testVerificaFuncionamentoDoArquivoProdutosUnitario()
    {
        #Produto1
        $Produto = $this->createMock('App\Entities\Produto', array('getLm', 'getName', 'getFree_shipping', 'getDescription', 'getPrice'));


        $Produto->expects($this->any())
                ->method('getLm')
                ->willReturn('1001');

        $Produto->expects($this->any())
                ->method('getName')
                ->willReturn('Furadeira X');

        $Produto->expects($this->any())
                ->method('getFree_shipping')
                ->willReturn('0');

        $Produto->expects($this->any())
                ->method('getDescription')
                ->willReturn('Furadeira eficiente X');

        $Produto->expects($this->any())
                ->method('getPrice')
                ->willReturn('100.00');

        #Produto2
        $Produto2 = $this->createMock('App\Entities\Produto', array('getLm', 'getName', 'getFree_shipping', 'getDescription', 'getPrice'));


        $Produto2->expects($this->any())
                ->method('getLm')
                ->willReturn('1002');

        $Produto2->expects($this->any())
                ->method('getName')
                ->willReturn('Furadeira Y');

        $Produto2->expects($this->any())
                ->method('getFree_shipping')
                ->willReturn('1');

        $Produto2->expects($this->any())
                ->method('getDescription')
                ->willReturn('Furadeira super eficiente Y');

        $Produto2->expects($this->any())
                ->method('getPrice')
                ->willReturn('140.00');


        $ArquivoProdutos = new \App\Entities\ArquivoProdutos();
        $ArquivoProdutos->addProduto($Produto);
        $ArquivoProdutos->addProduto($Produto2);

        $produtos = $ArquivoProdutos->getProdutos();

        $this->assertEquals('1001', $produtos[0]->getLm());
        $this->assertEquals('Furadeira X', $produtos[0]->getName());
        $this->assertEquals('0', $produtos[0]->getFree_shipping());
        $this->assertEquals('Furadeira eficiente X', $produtos[0]->getDescription());
        $this->assertEquals('100.00', $produtos[0]->getPrice());

        $this->assertEquals('1002', $produtos[1]->getLm());
        $this->assertEquals('Furadeira Y', $produtos[1]->getName());
        $this->assertEquals('1', $produtos[1]->getFree_shipping());
        $this->assertEquals('Furadeira super eficiente Y', $produtos[1]->getDescription());
        $this->assertEquals('140.00', $produtos[1]->getPrice());
    }

    public function testVerificaFuncionamentoDoArquivoProdutosIntegracao()
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
        $ArquivoProdutos->addProduto($Produto);
        $ArquivoProdutos->addProduto($Produto2);

        $produtos = $ArquivoProdutos->getProdutos();

        $this->assertEquals('1001', $produtos[0]->getLm());
        $this->assertEquals('Furadeira X', $produtos[0]->getName());
        $this->assertEquals('0', $produtos[0]->getFree_shipping());
        $this->assertEquals('Furadeira eficiente X', $produtos[0]->getDescription());
        $this->assertEquals('100.00', $produtos[0]->getPrice());

        $this->assertEquals('1002', $produtos[1]->getLm());
        $this->assertEquals('Furadeira Y', $produtos[1]->getName());
        $this->assertEquals('1', $produtos[1]->getFree_shipping());
        $this->assertEquals('Furadeira super eficiente Y', $produtos[1]->getDescription());
        $this->assertEquals('140.00', $produtos[1]->getPrice());
    }

}
