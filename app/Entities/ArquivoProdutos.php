<?php

namespace App\Entities;

class ArquivoProdutos
{
    /*
     * @Produtos
     */
    private $produtos = [];

    private $fileName;

    private $id;
    
    public function __construct()
    {
        $this->id = md5(uniqid(rand(), true));
    }

    function addProduto(Produto $produto)
    {
        $this->produtos[] = $produto;
    }

    function getProdutos()
    {
        return $this->produtos;
    }

    function getFileName()
    {
        return $this->fileName;
    }
    
    function getId()
    {
        return $this->id;
    }

    function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }
}
