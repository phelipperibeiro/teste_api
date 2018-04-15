<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoggerQueue extends Model
{
    
    protected $table = 'logger_queue';
    
    protected $fillable = [
        'queue_name',
        'status_id',
        'file_name',
        'logger_msg',
    ];

}
