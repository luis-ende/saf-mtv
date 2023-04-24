<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// Implementar cuando se entregue API para consulta de Prebases.
class ImportaPrebases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-prebases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
