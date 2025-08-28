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
    $nombreBanco = $bancosVenezuela[$balance->banco->cuenta_banco] ?? 'Banco no especificado';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalles del Balance') }}
            </h2>
            <a href="{{ route('balances.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <x-letsicon-back class="w-4 h-4 mr-1" />
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="w-full">
                        <div class="space-y-4 max-w-3xl mx-auto">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-lg">
                                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $balance->banco->nombre }}</h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $nombreBanco }}</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Detalles del Balance</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-300">Monto Actual:</span>
                                        <span class="font-medium text-gray-900 dark:text-white">
                                            @php
                                                $symbol = match($balance->banco->moneda) {
                                                    'dolares' => '$',
                                                    'euro' => '€',
                                                    default => 'Bs.'
                                                };
                                            @endphp
                                            {{ $symbol }} {{ number_format($balance->monto_actual, 2, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-300">Última Actualización:</span>
                                        <span class="text-gray-900 dark:text-gray-200">{{ $balance->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
