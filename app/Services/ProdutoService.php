<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Constantes\LoggerQueueStatus;
use App\Repositories\Interfaces\ProdutoRepositoryInterface;
use App\Repositories\Interfaces\LoggerQueueRepositoryInterface;
use App\Jobs\ArquivoProdutoJob;
use App\Entities\ArquivoProdutos;
use App\Entities\Produto;

class ProdutoService
{

    private $produto;
    private $loggerQueue;

    public function __construct(ProdutoRepositoryInterface $produto, LoggerQueueRepositoryInterface $loggerQueue)
    {
        $this->produto = $produto;
        $this->loggerQueue = $loggerQueue;
    }

    public function processarDados(UploadedFile $file)
    {
        $ArquivoProdutos = new ArquivoProdutos();
        $ArquivoProdutos->setFileName($file->getClientOriginalName());

        foreach ($this->extrairDadosPlanilha($file)["Plan1"] as $linha) {

            list($ln, $name, $free_shipping, $description, $price) = array_values($linha);

            if (empty(array_filter([$ln, $name, $free_shipping, $description, $price]))) {
                continue;
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

        $this->loggerQueue->createLoggerQueue(['queue_name' => $arquivoProdutos->getId(),
            'file_name' => $arquivoProdutos->getFileName(),
            'status_id' => LoggerQueueStatus::EM_FILA,
            'logger_msg' => '-']);

        dispatch($job);

        return ['sucesso' => true, 'queue_name' => $arquivoProdutos->getId()];
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
        $this->loggerQueue->updateLoggerQueue($arquivoProdutos->getId(), 
                ['status_id' => LoggerQueueStatus::EM_PROCESSAMENTO]);

        $this->produto->beginTransaction();
        
        try {
           
            foreach ($arquivoProdutos->getProdutos() as $produto) {
                $this->produto->createProduto($produto->toArray());
            }

            $this->produto->commit();

            $this->loggerQueue->updateLoggerQueue($arquivoProdutos->getId(), 
                    ['status_id' => LoggerQueueStatus::PROCESSADO_COM_SUCESSO]);
            
        } catch (Exception $e) {
            
            $this->produto->rollBack();

            $this->loggerQueue->updateLoggerQueue($arquivoProdutos->getId(), 
                    ['status_id' => LoggerQueueStatus::PROCESSADO_COM_ERROS, 'logger_msg' => $e->getMessage()]);

            throw $e;
        }
    }
    
    public function getQueueStatus($queueName)
    {
        return $this->loggerQueue->getLoggerQueue($queueName);
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
