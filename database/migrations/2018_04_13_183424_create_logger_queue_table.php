<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggerQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logger_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id');
            $table->foreign('status_id')->references('id')->on('logger_queue_status');
            $table->timestamps();
        });
    }
    
        # status
    # 1 => em fila
    # 2 => em processamento
    # 3 => processado com sucesso
    # 4 => processado com errors
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logger_queue');
    }
}
