<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                <i class="fas fa-clipboard-check mr-2"></i>{{ __('Detalles de Auditoría') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('auditorias.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <x-letsicon-back class="w-4 h-4 mr-1" />
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-8">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900">Información General</h3>
                            <p class="mt-1 text-sm text-gray-600">Detalles del registro de auditoría.</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200">
                        <dl class="divide-y divide-gray-200">
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">ID de Movimiento</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <span class="font-mono bg-gray-100 px-2 py-1 rounded">#{{ $auditoria->movimiento_id }}</span>
                                </dd>
                            </div>

                            @if($auditoria->movimiento)
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 bg-gray-50">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Tipo de Movimiento</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    @php
                                        $typeClasses = [
                                            'ingreso' => 'bg-green-100 text-green-800',
                                            'egreso' => 'bg-red-100 text-red-800',
                                            'transferencia' => 'bg-blue-100 text-blue-800',
                                        ][$auditoria->movimiento->tipo_movimiento] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeClasses }}">
                                        {{ ucfirst($auditoria->movimiento->tipo_movimiento) }}
                                    </span>
                                </dd>
                            </div>

                            @if($auditoria->movimiento->bancoEmisor)
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Banco Origen</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <div class="flex items-center">
                                        <i class="fas fa-university mr-2 text-indigo-500"></i>
                                        <span>{{ $auditoria->movimiento->bancoEmisor->nombre }}</span>
                                        <span class="ml-2 text-xs text-gray-500">({{ $auditoria->movimiento->bancoEmisor->numero_cuenta }})</span>
                                    </div>
                                </dd>
                            </div>
                            @endif

                            @if($auditoria->movimiento->bancoReceptor && $auditoria->movimiento->tipo_movimiento === 'transferencia')
                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0 bg-gray-50">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Banco Destino</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    <div class="flex items-center">
                                        <i class="fas fa-university mr-2 text-green-500"></i>
                                        <span>{{ $auditoria->movimiento->bancoReceptor->nombre }}</span>
                                        <span class="ml-2 text-xs text-gray-500">({{ $auditoria->movimiento->bancoReceptor->numero_cuenta }})</span>
                                    </div>
                                </dd>
                            </div>
                            @endif
                            @endif

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 bg-gray-50">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="fas fa-wallet mr-2 text-blue-500"></i> Saldo Anterior
                                </dt>
                                <dd class="mt-1 flex items-center text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="font-mono px-3 py-1 bg-blue-50 text-blue-900 rounded-md">
                                        {{ number_format($auditoria->saldo_anterior, 2) }}
                                    </span>
                                </dd>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="fas fa-coins mr-2 text-green-500"></i> Nuevo Saldo
                                </dt>
                                <dd class="mt-1 flex items-center text-sm font-semibold text-green-700 sm:mt-0 sm:col-span-2">
                                    <span class="px-3 py-1 bg-green-50 text-green-900 rounded-md">
                                        {{ number_format($auditoria->saldo_nuevo, 2) }}
                                    </span>
                                    @php
                                        $diferencia = $auditoria->saldo_nuevo - $auditoria->saldo_anterior;
                                        $esPositivo = $diferencia >= 0;
                                    @endphp
                                    <span class="ml-3 px-2 py-1 text-xs font-medium rounded-full {{ $esPositivo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $esPositivo ? '▲' : '▼' }} {{ number_format(abs($diferencia), 2) }}
                                    </span>
                                </dd>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 bg-gray-50 rounded-b-lg">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="far fa-clock mr-2 text-purple-500"></i> Fecha de Registro
                                </dt>
                                <dd class="mt-1 flex items-center text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <i class="far fa-calendar-alt mr-2 text-purple-400"></i>
                                    {{ \Carbon\Carbon::parse($auditoria->fecha_registro)->format('d/m/Y H:i:s') }}
                                    <span class="ml-2 text-xs text-gray-500">
                                        ({{ \Carbon\Carbon::parse($auditoria->fecha_registro)->diffForHumans() }})
                                    </span>
                                </dd>
                            </div>

                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 bg-gray-50">
                                <dt class="text-sm font-medium text-gray-500 flex items-center">
                                    <i class="fas fa-user mr-2 text-blue-500"></i> Realizado por
                                </dt>
                                <dd class="mt-1 flex items-center text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="px-3 py-1 bg-yellow-50 text-yellow-900 font-bold rounded-md">
                                        {{ $auditoria->movimiento->user->name ?? 'Usuario desconocido' }}
                                    </span>
                                </dd>
                            </div>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
