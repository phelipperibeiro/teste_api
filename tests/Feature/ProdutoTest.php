<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\Produto;

class ProdutoTest extends TestCase
{

    public function testVerificaSeOTipoDaClassseEstaCorreto()
    {
        $this->assertInstanceOf("App\Entities\Produto", new \App\Entities\Produto());
    }

    public function testVerificaSeSetGetProduto()
    {
        $Produto = new Produto();
        $Produto->setLm('1001');
        $Produto->setName('Furadeira X');
        $Produto->setFree_shipping('0');
        $Produto->setDescription('Furadeira eficiente X');
        $Produto->setPrice('100.00');
        
        //ArquivoProdutos

        $this->assertEquals('1001', $Produto->getLm());
        $this->assertEquals('Furadeira X', $Produto->getName());
        $this->assertEquals('0', $Produto->getFree_shipping());
        $this->assertEquals('Furadeira eficiente X', $Produto->getDescription());
        $this->assertEquals('100.00', $Produto->getPrice());
    }

}
