<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balance;
use App\Models\Movimiento;
use App\Models\Banco;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Variables para las estadisticas
        $currentUsers = User::count();
        $currentTransactions = Movimiento::count();
        $currentBalance = Balance::sum('monto_actual');
        $totalBanks = Banco::count();
        
        // Variables para los periodos previos
        $previousUsers = User::where('created_at', '<', now()->subMonth())->count();
        $previousTransactions = Movimiento::where('created_at', '<', now()->subMonth())->count();
        $previousBalance = Balance::where('created_at', '<', now()->subMonth())->sum('monto_actual');
        
        // Calcular porcentajes
        $totalUsers = $currentUsers;
        $usersChange = $previousUsers > 0 ? round((($currentUsers - $previousUsers) / $previousUsers) * 100) : 100;
        
        $totalTransactions = $currentTransactions;
        $transactionsChange = $previousTransactions > 0 ? round((($currentTransactions - $previousTransactions) / $previousTransactions) * 100) : ($currentTransactions > 0 ? 100 : 0);
        
        $totalBalance = $currentBalance;
        $balanceChange = $previousBalance > 0 ? round((($currentBalance - $previousBalance) / $previousBalance) * 100) : ($currentBalance > 0 ? 100 : 0);

        $previousBanks = Banco::where('created_at', '<', now()->subMonth())->count();
        $banksChange = $previousBanks > 0 ? round((($totalBanks - $previousBanks) / $previousBanks) * 100) : ($totalBanks > 0 ? 100 : 0);

        // Transacciones de los últimos 6 meses (orden correcto y meses sin datos = 0)
        $desde = now()->startOfMonth()->subMonths(5); // incluye el mes actual y 5 anteriores
        $raw = Movimiento::select(
                DB::raw('YEAR(created_at) as y'),
                DB::raw('MONTH(created_at) as m'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', $desde)
            ->groupBy('y', 'm')
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        // Mapa "YYYY-MM" => total
        $mapYM = [];
        foreach ($raw as $r) {
            $key = sprintf('%04d-%02d', $r->y, $r->m);
            $mapYM[$key] = (int)$r->total;
        }

        // Construir las series garantizando 6 puntos
        $transactionsData = [
            'labels' => [],
            'data' => [],
        ];
        for ($i = 0; $i < 6; $i++) {
            $dt = (clone $desde)->addMonths($i);
            $key = $dt->format('Y-m');
            $transactionsData['labels'][] = $dt->format('M Y');
            $transactionsData['data'][] = $mapYM[$key] ?? 0;
        }

        // Se obtiene el balance de cada banco 
        $bancos = Banco::with('latestBalance')->get();
        
        // Mapa explícito de códigos de bancos de Venezuela a nombres
        $bancosVenezuela = [
            '0102' => 'Banco de Venezuela',
            '0104' => 'Venezolano de Crédito',
            '0105' => 'Banco Mercantil',
            '0108' => 'Banco Provincial',
            '0114' => 'Bancaribe',
            '0115' => 'Banco Exterior',
            '0128' => 'Banco Caroní',
            '0134' => 'Banesco',
            '0137' => 'Banco Sofitasa',
            '0138' => 'Banco Plaza',
            '0146' => 'Banco de la Gente Emprendedora',
            '0151' => 'BFC Banco Fondo Común',
            '0156' => '100% Banco',
            '0157' => 'DelSur',
            '0163' => 'Banco del Tesoro',
            '0166' => 'Banco Agrícola de Venezuela',
            '0168' => 'Bancrecer',
            '0169' => 'Mi Banco',
            '0171' => 'Banco Activo',
            '0172' => 'Bancamiga',
            '0174' => 'Banplus',
            '0175' => 'Bicentenario Banco',
            '0177' => 'Banfanb',
            '0191' => 'BNC Nacional de Crédito',
            '0601' => 'Instituto Municipal de Crédito Popular',
        ];
        
        // Construir un mapa codigo_banco (primeros 4 dígitos de numero_cuenta) => nombre (fallback)
        $codeToName = [];
        foreach ($bancos as $b) {
            $num = (string)($b->numero_cuenta ?? '');
            if (strlen($num) >= 4) {
                $code = substr($num, 0, 4);
                // Solo setear si no existe para mantener el primer nombre encontrado
                if (!isset($codeToName[$code])) {
                    $codeToName[$code] = $b->nombre ?? $code;
                }
            }
        }
        $usersData = [
            'labels' => [],
            'data' => []
        ];

        $banksData = [];
        
        foreach ($bancos as $banco) {
            $usersData['labels'][] = $banco->cuenta_banco;
            $balance = $banco->latestBalance ? (float)$banco->latestBalance->monto_actual : 0;
            $usersData['data'][] = $balance;
            
            // Datos para el grafico de dona
            $symbol = 'Bs.'; 
            if (isset($banco->moneda)) {
                $symbol = $banco->moneda === 'dolares' ? '$' : 'Bs.';
            }
            
            // Traducir el código almacenado en cuenta_banco a nombre legible usando el mapa explícito y luego fallback
            $codigo = (string)($banco->cuenta_banco);
            $labelNombre = $bancosVenezuela[$codigo] 
                ?? $codeToName[$codigo] 
                ?? ($banco->nombre ?? $codigo);
            
            $banksData[] = [
                'nombre' => $labelNombre,
                'saldo' => $balance,
                'moneda' => $banco->moneda ?? 'bolivares',
                'simbolo' => $symbol
            ];
        }

        // Se extraen datos por el motivo 
        $categorias = Movimiento::select('motivo', DB::raw('SUM(monto) as total'))
            ->groupBy('motivo')
            ->orderBy('total', 'desc')
            ->get();

        $categoryData = [
            'labels' => $categorias->pluck('motivo')->toArray(),
            'data' => $categorias->pluck('total')->toArray(),
            'colors' => [
                '#4F46E5', 
                '#10B981', 
                '#F59E0B', 
                '#EF4444', 
                '#8B5CF6'  
            ]
        ];

        // Se toman los últimos 5 movimientos 
        $recentMovements = Movimiento::with([
                'user', 
                'bancoEmisor', 
                'bancoReceptor'
            ])
            ->with(['bancoEmisor' => function($q) {
                $q->select('id', 'nombre');
            }])
            ->with(['bancoReceptor' => function($q) {
                $q->select('id', 'nombre');
            }])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'usersChange' => $usersChange,
            'totalTransactions' => $totalTransactions,
            'transactionsChange' => $transactionsChange,
            'totalBalance' => $totalBalance,
            'balanceChange' => $balanceChange,
            'totalBanks' => $totalBanks,
            'banksChange' => $banksChange,
            'transactionsData' => $transactionsData,
            'usersData' => $usersData,
            'banksData' => $banksData,
            'categoryData' => $categoryData,
            'recentMovements' => $recentMovements,
            'bancos' => $bancos
        ]);
    }
}
