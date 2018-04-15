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
            $table->integer('status_id')->unsigned();
            $table->string('queue_name', 100)->unique();
            $table->string('file_name', 500);
            $table->string('logger_msg', 500);
            $table->timestamps();
        });

        Schema::table('logger_queue', function($table) {
            $table->foreign('status_id')->references('id')->on('logger_queue_status');
        });
        
    }

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
