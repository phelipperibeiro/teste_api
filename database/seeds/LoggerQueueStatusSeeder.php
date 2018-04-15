<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LoggerQueueStatusSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logger_queue_status')->insert([
            'description' => 'em fila'
        ]);
        DB::table('logger_queue_status')->insert([
            'description' => 'em processamento'
        ]);
        DB::table('logger_queue_status')->insert([
            'description' => 'processado com sucesso'
        ]);
        DB::table('logger_queue_status')->insert([
            'description' => 'processado com error'
        ]);
        
    }

}
