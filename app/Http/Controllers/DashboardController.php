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

        // Transacciones de los ultimos 6 meses 
        $transactionsByMonth = Movimiento::select(
                DB::raw('DATE_FORMAT(created_at, "%b %Y") as month'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($transactionsByMonth as $transaction) {
            $transactionsData['labels'][] = $transaction->month;
            $transactionsData['data'][] = $transaction->total;
        }

        // Se obtiene el balance de cada banco 
        $bancos = Banco::with('latestBalance')->get();
        $usersData = [
            'labels' => [],
            'data' => []
        ];

        $banksData = [];
        
        foreach ($bancos as $banco) {
            $usersData['labels'][] = $banco->nombre;
            $balance = $banco->latestBalance ? (float)$banco->latestBalance->monto_actual : 0;
            $usersData['data'][] = $balance;
            
            // Datos para el grafico de dona
            $symbol = 'Bs.'; 
            if (isset($banco->moneda)) {
                $symbol = $banco->moneda === 'dolares' ? '$' : 'Bs.';
            }
            
            $banksData[] = [
                'nombre' => $banco->nombre,
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
