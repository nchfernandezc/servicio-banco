<?php

namespace App\Console\Commands;

use App\Models\Banco;
use Illuminate\Console\Command;

class actualizarBalanceBanco extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:actualizar-balance-banco';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar balances automaticamente desde JSON';

    /**
     * Execute the console command.
     */

    /*
        Comando para ejecutar servicio de banco y actualizar los balances de las cuentas agregadas
    */
    public function handle()
    {
        $bancos = Banco::all();

        foreach ($bancos as $banco) {
            try {
                $balance = $banco->actualizarBalanceBanco();

                if ($balance !== null) {
                    $this->info("Banco {$banco->nombre}: {$balance} Bolivares");
                } else {
                    $this->error("Error obteniendo balance para {$banco->nombre}");
                }
            } catch (\Exception $e) {
                $this->error("Error con {$banco->nombre}: " . $e->getMessage());
            }
        }

        $this->info("Balances actualizados correctamente");
    }
}