<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Constantes\LoggerQueueStatus;
use App\Repositories\LoggerQueueRepository;
use App\Models\LoggerQueue;

class LoggerQueueRepositoryTest extends TestCase
{

    use DatabaseTransactions;

    public function testVerificaSeOTipoDaClassseEstaCorreto()
    {
        $this->assertInstanceOf("App\Repositories\LoggerQueueRepository", new LoggerQueueRepository(new LoggerQueue()));
    }

    public function testVerificaSeCriaLogger()
    {
        //createLoggerQueue
        $LoggerQueueRepository = new LoggerQueueRepository(new LoggerQueue());
        
        $LoggerQueueRepository->createLoggerQueue(['queue_name' => 'queue_xpto',
            'file_name' => 'file_name_xpto',
            'status_id' => LoggerQueueStatus::EM_FILA,
            'logger_msg' => '-']);
        
        
        $this->assertDatabaseHas('logger_queue', ['queue_name' => 'queue_xpto', 'file_name' => 'file_name_xpto' ,'status_id' => LoggerQueueStatus::EM_FILA]);
        
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaSeAtualizaLoggerInvalidArgumentException()
    {
        //createLoggerQueue
        $LoggerQueueRepository = new LoggerQueueRepository(new LoggerQueue());
        
        $LoggerQueueRepository->updateLoggerQueue('queue_xpto', ['queue_name' => 'queue_xpth',
            'file_name' => 'file_name_xpth',
            'status_id' => LoggerQueueStatus::EM_FILA,
            'logger_msg' => '-']);        
    }
    
    public function testVerificaSeAtualizaLogger()
    {
        //createLoggerQueue
        $LoggerQueueRepository = new LoggerQueueRepository(new LoggerQueue());
        
        $LoggerQueueRepository->createLoggerQueue(['queue_name' => 'queue_xpto',
            'file_name' => 'file_name_xpto',
            'status_id' => LoggerQueueStatus::EM_FILA,
            'logger_msg' => '-']);
        
        $LoggerQueueRepository->updateLoggerQueue('queue_xpto', ['queue_name' => 'queue_xpth',
            'file_name' => 'file_name_xpth',
            'status_id' => LoggerQueueStatus::EM_PROCESSAMENTO,
            'logger_msg' => '-']);
        
        $this->assertDatabaseHas('logger_queue', ['queue_name' => 'queue_xpth',
                                                  'file_name' => 'file_name_xpth', 
                                                   'status_id' => LoggerQueueStatus::EM_PROCESSAMENTO]);        
    }
    
    public function testVerificaSePegaLoggerFalse()
    {
        $LoggerQueueRepository = new LoggerQueueRepository(new LoggerQueue());
        
        $response = $LoggerQueueRepository->getLoggerQueue('queue_name_not_exists');    
        
        $this->assertEquals(['sucesso' => false, 'dados' => []], $response);
    }
    
    public function testVerificaSePegaLogger()
    {
        //createLoggerQueue
        $LoggerQueueRepository = new LoggerQueueRepository(new LoggerQueue());
        
        $LoggerQueueRepository->createLoggerQueue(['queue_name' => 'queue_xpto',
            'file_name' => 'file_name_xpto',
            'status_id' => LoggerQueueStatus::EM_FILA,
            'logger_msg' => '-']);
        
        $response = $LoggerQueueRepository->getLoggerQueue('queue_xpto');
        
        $this->assertContains(['sucesso' => true], $response);        
    }

}
