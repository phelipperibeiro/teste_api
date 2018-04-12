<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Repositories\Interfaces\ProdutoRepositoryInterface;
use App\Jobs\ArquivoProdutoJob;
use App\Entities\ArquivoProdutos;
use App\Entities\Produto;

class ProdutoService
{

    private $produto;

    public function __construct(ProdutoRepositoryInterface $produto)
    {
        $this->produto = $produto;
    }

    public function processarDados(UploadedFile $file)
    {
        $dados = $this->extrairDadosPlanilha($file);

        $ArquivoProdutos = new ArquivoProdutos();

        foreach ($dados["Plan1"] as $linha) {

            list($ln, $name, $free_shipping, $description, $price) = array_values($linha);

            if (empty(array_filter([$ln, $name, $free_shipping, $description, $price]))) {
                break;
            }

            $ArquivoProdutos->addProduto(new Produto($ln, $name, $free_shipping, $description, $price));
        }

        return $this->enviarArquivoProdutosFila($ArquivoProdutos);
    }

    public function enviarArquivoProdutosFila(ArquivoProdutos $arquivoProdutos)
    {
        $job = (new ArquivoProdutoJob($arquivoProdutos))
                ->onConnection('database')
                ->onQueue('default');

        dispatch($job);

        return ['sucesso' => true];
    }

    public function extrairDadosPlanilha(UploadedFile $file)
    {
        $fileName = date("Y-m-d-H:i:s") . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs('tmp/', $fileName);

        $pathfileName = storage_path("app/tmp") . '/' . $fileName;
        $dados = UtilsService::getSheets($pathfileName);

        // deletando o cabeçalho do excel
        unset($dados["Plan1"][0]);
        unset($dados["Plan1"][1]);
        unset($dados["Plan1"][2]);

        return $dados;
    }

    public function processarArquivoProdutos(ArquivoProdutos $arquivoProdutos)
    {
        $this->produto->beginTransaction();
        
        try {
            foreach ($arquivoProdutos->getProdutos() as $produto) {
                $this->produto->createProduto($produto->toArray());
            }

            $this->produto->commit();
        } catch (Exception $e) {

            $this->produto->rollBack();

            throw $e;
        }
    }

    public function getProduto($id)
    {
        return $this->produto->getProduto($id);
    }

    public function getProdutos()
    {
        return $this->produto->getProdutos();
    }

    public function updateProduto(array $dados, $id)
    {
        return $this->produto->updateProduto($id, $dados);
    }

    public function deleteProduto($id)
    {
        return $this->produto->deleteProduto($id);
    }

}
