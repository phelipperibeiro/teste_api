<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoggerQueueStatus extends Model
{
   
    protected $table = 'logger_queue_status';
    
    const EM_FILA = 1;
    const EM_PROCESSAMENTO = 2;
    const PROCESSADO_COM_SUCESSO = 3;
    const PROCESSADO_COM_ERROS = 4;

    protected $fillable = [
        'description',
    ];
}
