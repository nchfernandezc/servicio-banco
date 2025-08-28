<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalles del Banco') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('bancos.edit', $banco) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('bancos.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <x-letsicon-back class="w-4 h-4 mr-1" />
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Datos Básicos -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $banco->nombre }}</h3>
                                    @php
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
                                        $nombreBanco = $bancosVenezuela[$banco->cuenta_banco] ?? 'Banco no especificado';
                                    @endphp
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $nombreBanco }}</p>
                                </div>
                            </div>

                            @if($banco->telefono || $banco->email || $banco->direccion)
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Información de Contacto</h4>
                                <div class="space-y-2">
                                    @if($banco->telefono)
                                    <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                        <svg class="flex-shrink-0 mr-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $banco->telefono }}
                                    </div>
                                    @endif
                                    @if($banco->email)
                                    <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                        <svg class="flex-shrink-0 mr-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $banco->email }}
                                    </div>
                                    @endif
                                    @if($banco->direccion)
                                    <div class="flex items-start text-sm text-gray-700 dark:text-gray-300">
                                        <svg class="flex-shrink-0 mr-2 mt-0.5 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $banco->direccion }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Saldo y Estadísticas -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Estado de la Cuenta</h4>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Saldo Actual</p>
                                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        @php
                                            $symbol = match($banco->moneda) {
                                                'dolares' => '$',
                                                'euro' => '€',
                                                default => 'Bs.'
                                            };
                                        @endphp
                                        {{ $symbol }} {{ number_format($banco->latestBalance->monto_actual ?? 0, 2, ',', '.') }}
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Último Movimiento</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $banco->movimientos()->latest()->first() ? $banco->movimientos()->latest()->first()->created_at->format('d/m/Y') : 'N/A' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Total Movimientos</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $banco->movimientos()->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Últimos Movimientos -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Últimos Movimientos</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Descripción</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Monto</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($banco->movimientos()->latest()->take(10)->get() as $movimiento)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $movimiento->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $typeClasses = [
                                            'ingreso' => 'bg-green-100 text-green-800',
                                            'egreso' => 'bg-red-100 text-red-800',
                                            'transferencia' => 'bg-blue-100 text-blue-800',
                                        ][$movimiento->tipo_movimiento] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeClasses }}">
                                        {{ ucfirst($movimiento->tipo_movimiento) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                    {{ $movimiento->motivo }}
                                    @if($movimiento->tipo_movimiento === 'transferencia')
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            @if($movimiento->banco_emisor_id === $banco->id)
                                                → {{ $movimiento->bancoReceptor->nombre ?? 'Banco Externo' }}
                                            @else
                                                ← {{ $movimiento->bancoEmisor->nombre ?? 'Banco Externo' }}
                                            @endif
                                        </p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium {{ $movimiento->tipo_movimiento === 'ingreso' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $movimiento->tipo_movimiento === 'ingreso' ? '+' : '-' }}{{ $symbol }} {{ number_format($movimiento->monto, 2, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No hay movimientos registrados para este banco.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($banco->movimientos()->count() > 10)
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 text-right">
                    <a href="{{ route('movimientos.index', ['banco' => $banco->id]) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                        Ver todos los movimientos
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
