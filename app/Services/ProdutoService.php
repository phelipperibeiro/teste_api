<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Jobs\ArquivoProdutoJob;
use App\Entities\ArquivoProdutos;
use App\Models\Produtos;
use App\Entities\Produto;

class ProdutoService
{

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
        foreach ($arquivoProdutos->getProdutos() as $produto) {
            Produtos::create($produto->toArray());
        }
    }

    public function getProduto($id)
    {
        if (!$response = Produtos::find($id)) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function getProdutos()
    {
        if (!$response = Produtos::all()) {
            return ['sucesso' => false, 'dados' => []];
        }

        return ['sucesso' => true, 'dados' => $response];
    }

    public function updateProduto($id, Request $request)
    {
        if (!$produto = Produtos::find($id)) {
            return ['sucesso' => false];
        }

        $produto->update($request->all());

        return ['sucesso' => true];
    }

    public function deleteProduto($id)
    {

        if (!$produto = Produtos::find($id)) {
            return ['sucesso' => false];
        }

        $produto->delete();

        return ['sucesso' => true];
    }

}
