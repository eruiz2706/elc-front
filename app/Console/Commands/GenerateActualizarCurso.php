<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class GenerateActualizarCurso extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_estado_curso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que actualiza el estado de un curso';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fecha  =date('Y-m-d');
        DB::update("update cursos set estado='abierto'
                            where fecha_inicio>'$fecha'");

        DB::update("update cursos set estado='encurso'
                    where '$fecha'>=fecha_inicio and '$fecha'<=fecha_finalizacion");

        DB::update("update cursos set estado='finalizado'
                    where '$fecha'>=fecha_inicio and '$fecha'>fecha_finalizacion");
    }
}
