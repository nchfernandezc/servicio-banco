<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reportes de Auditoría') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('auditorias.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <x-letsicon-back class="w-4 h-4 mr-1" />
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- filtrar formulario -->
                    <form action="{{ route('auditorias.reportes') }}" method="GET" id="form-filtrar">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ request('fecha_inicio') }}">
                            </div>
                            <div>
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    value="{{ request('fecha_fin') }}">
                            </div>
                            <div>
                                <label for="tipo_movimiento" class="block text-sm font-medium text-gray-700">Tipo de Movimiento</label>
                                <select name="tipo_movimiento" id="tipo_movimiento"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todos</option>
                                    <option value="ingreso" {{ request('tipo_movimiento') == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                                    <option value="egreso" {{ request('tipo_movimiento') == 'egreso' ? 'selected' : '' }}>Egreso</option>
                                    <option value="transferencia" {{ request('tipo_movimiento') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-filter mr-2"></i> Filtrar
                            </button>
                        </div>
                    </form>

                    <!-- genera pdf -->
                    <form action="{{ route('auditorias.generar-reporte-pdf') }}" method="GET" target="_blank" id="form-pdf" class="mt-4">
                        <input type="hidden" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                        <input type="hidden" name="fecha_fin" value="{{ request('fecha_fin') }}">
                        <input type="hidden" name="tipo_movimiento" value="{{ request('tipo_movimiento') }}">
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-file-pdf mr-2"></i> Generar PDF
                            </button>
                        </div>
                    </form>

                    <!-- muestra si existen resultados -->
                    @if(isset($auditorias) && $auditorias->count() > 0)
                    <div class="mt-8 overflow-x-auto">
                        <div class="table-responsive">
                            <table id="audit-table" class="w-full text-sm text-left text-black bg-red-300" cellspacing="0" width="90%">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Anterior</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Nuevo</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($auditorias as $auditoria)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $auditoria->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $typeClasses = [
                                                        'ingreso' => 'bg-green-100 text-green-800',
                                                        'egreso' => 'bg-red-100 text-red-800',
                                                        'transferencia' => 'bg-blue-100 text-blue-800',
                                                    ][$auditoria->movimiento->tipo_movimiento ?? ''] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeClasses }}">
                                                    {{ ucfirst($auditoria->movimiento->tipo_movimiento ?? 'N/A') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($auditoria->movimiento->monto ?? 0, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($auditoria->saldo_anterior, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($auditoria->saldo_nuevo, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($auditoria->fecha_registro)->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $auditoria->movimiento->user->name ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>    
                            <div class="mt-4">
                                {{ $auditorias->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    @elseif(request()->has('action') && request('action') === 'filtrar')
                        <div class="mt-8 text-center py-12 bg-gray-50 rounded-lg">
                            <i class="fas fa-search text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">No se encontraron registros con los filtros seleccionados.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#audit-table').DataTable({
                pageLength: 50,
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                dom: 'Bfrtip',
            });
        });
    </script>
    @endpush
</x-app-layout>
