<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movimientos') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center justify-between">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Movimientos') }}</h1>
                        <p class="mt-2 text-sm text-gray-700">Lista de {{ __('Movimientos') }}.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('movimientos.create') }}" 
                           class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm 
                                  hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                  focus-visible:outline-indigo-600">
                            <x-typ-plus class="w-4 h-4 m-1 inline-block"/>
                            Agregar nuevo
                        </a>
                    </div>
                </div>

                <div class="py-12 bg-white shadow sm:rounded-lg p-8 max-w-full">
                    <div class="mb-6 flex space-x-4">
                        <button id="btn-ingresos" class="px-4 py-2 bg-indigo-600 text-white rounded font-semibold">Ingresos</button>
                        <button id="btn-egresos" class="px-4 py-2 bg-gray-300 text-gray-700 rounded font-semibold">Egresos</button>
                        <button id="btn-transferencias" class="px-4 py-2 bg-gray-300 text-gray-700 rounded font-semibold">Transferencias</button>
                    </div>

                    <!-- Tabla Ingresos -->
                    <div id="tabla-ingresos">
                        <h1 class="text-lg font-semibold mb-4">Ingresos</h1>
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-300 table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo Movimiento</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Receptor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Motivo</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @php $i = ($ingresos->currentPage() - 1) * $ingresos->perPage(); @endphp
                                @foreach($ingresos as $movimiento)
                                    <tr class="even:bg-gray-50">
                                        <td class="px-3 py-2 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ ucfirst($movimiento->tipo_movimiento) }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->monto }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->bancoReceptor->nombre }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->fecha }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->motivo }}</td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                            <a href="{{ route('movimientos.show', $movimiento->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">
                                                <x-bx-show class="w-4 h-4 mr-1 inline-block"/> {{ __('Show') }}
                                            </a>
                                            <a href="{{ route('movimientos.edit', $movimiento->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900 mr-2">
                                                <x-feathericon-edit class="w-4 h-4 mr-1 inline-block"/> {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('movimientos.destroy', $movimiento->id) }}" method="POST" class="form-delete" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                    <x-monoicon-delete class="w-4 h-4 mr-1 inline-block"/> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $ingresos->links() }}</div>
                    </div>

                    <!-- Tabla Egresos -->
                    <div id="tabla-egresos" class="hidden">
                        <h1 class="text-lg font-semibold mb-4">Egresos</h1>
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-300 table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo Movimiento</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Emisor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Motivo</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @php $i = ($egresos->currentPage() - 1) * $egresos->perPage(); @endphp
                                @foreach($egresos as $movimiento)
                                    <tr class="even:bg-gray-50">
                                        <td class="px-3 py-2 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ ucfirst($movimiento->tipo_movimiento) }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->monto }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->bancoEmisor->nombre }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->fecha }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->motivo }}</td>
                                        <td class="px-3 py-2 text-sm font-medium text-gray-900">
                                            <a href="{{ route('movimientos.show', $movimiento->id) }}" class="text-gray-600 hover:text-gray-900 mr-2"><x-bx-show class="w-4 h-4 m-1 inline-block"/>Show</a>
                                            <a href="{{ route('movimientos.edit', $movimiento->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2"><x-feathericon-edit class="w-4 h-4 m-1 inline-block"/>Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <form action="{{ route('movimientos.destroy', $movimiento->id) }}" method="POST" class="form-delete" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                    <x-monoicon-delete class="w-4 h-4 mr-1 inline-block"/> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $egresos->links() }}</div>
                    </div>

                    <!-- Tabla Transferencias -->
                    <div id="tabla-transferencias" class="hidden">
                        <h1 class="text-lg font-semibold mb-4">Transferencias</h1>
                        <div class="overflow-x-auto">
                            <table class="w-full divide-y divide-gray-300 table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        <!--<th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo Movimiento</th> !-->
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Emisor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco Receptor</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Motivo</th>
                                        <th class="px-3 py-2 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @php $i = ($transferencias->currentPage() - 1) * $transferencias->perPage(); @endphp
                                @foreach($transferencias as $movimiento)
                                    <tr class="even:bg-gray-50">
                                        <td class="px-3 py-2 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                        <!-- <td class="px-3 py-2 text-sm text-gray-500">{{ ucfirst($movimiento->tipo_movimiento) }}</td> !-->
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->monto }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->bancoEmisor->nombre }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->bancoReceptor->nombre }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->fecha }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $movimiento->motivo }}</td>
                                        <td class="px-3 py-2 text-sm font-medium text-gray-900">
                                            <a href="{{ route('movimientos.show', $movimiento->id) }}" class="text-gray-600 hover:text-gray-900 mr-2"><x-bx-show class="w-4 h-4 m-1 inline-block"/>Show</a>
                                            <a href="{{ route('movimientos.edit', $movimiento->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2"><x-feathericon-edit class="w-4 h-4 m-1 inline-block"/>Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <form action="{{ route('movimientos.destroy', $movimiento->id) }}" method="POST" class="form-delete" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                    <x-monoicon-delete class="w-4 h-4 mr-1 inline-block"/> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $transferencias->links() }}</div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 

    <script>
        const btnIngresos = document.getElementById('btn-ingresos');
        const btnEgresos = document.getElementById('btn-egresos');
        const btnTransferencias = document.getElementById('btn-transferencias');
        const tablaIngresos = document.getElementById('tabla-ingresos');
        const tablaEgresos = document.getElementById('tabla-egresos');
        const tablaTransferencias = document.getElementById('tabla-transferencias');

        function resetButtons() {
            btnIngresos.classList.remove('bg-indigo-600', 'text-white');
            btnIngresos.classList.add('bg-gray-300', 'text-gray-700');
            btnEgresos.classList.remove('bg-indigo-600', 'text-white');
            btnEgresos.classList.add('bg-gray-300', 'text-gray-700');
            btnTransferencias.classList.remove('bg-indigo-600', 'text-white');
            btnTransferencias.classList.add('bg-gray-300', 'text-gray-700');
        }

        btnIngresos.addEventListener('click', () => {
            tablaIngresos.classList.remove('hidden');
            tablaEgresos.classList.add('hidden');
            tablaTransferencias.classList.add('hidden');
            resetButtons();
            btnIngresos.classList.remove('bg-gray-300', 'text-gray-700');
            btnIngresos.classList.add('bg-indigo-600', 'text-white');
        });

        btnEgresos.addEventListener('click', () => {
            tablaIngresos.classList.add('hidden');
            tablaEgresos.classList.remove('hidden');
            tablaTransferencias.classList.add('hidden');
            resetButtons();
            btnEgresos.classList.remove('bg-gray-300', 'text-gray-700');
            btnEgresos.classList.add('bg-indigo-600', 'text-white');
        });

        btnTransferencias.addEventListener('click', () => {
            tablaIngresos.classList.add('hidden');
            tablaEgresos.classList.add('hidden');
            tablaTransferencias.classList.remove('hidden');
            resetButtons();
            btnTransferencias.classList.remove('bg-gray-300', 'text-gray-700');
            btnTransferencias.classList.add('bg-indigo-600', 'text-white');
        });
    </script>
</x-app-layout>
