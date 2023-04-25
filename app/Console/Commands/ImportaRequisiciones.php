<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportaRequisiciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-requisiciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa datos del sistema de Requisiciones para Oportunidades de negocio de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
