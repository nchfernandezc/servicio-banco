<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Balances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Listado de Balances') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">Registros</p>
                        </div>
                        <!--
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('balances.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><x-typ-plus class="w-4 h-4 mr-1 inline-block"/>Agregar nuevo</a>
                        </div>
                        -->
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Banco</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Monto Actual</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Ult Modificacion</th>

                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($bancos as $banco)
                                            <tr class="even:bg-gray-50">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $banco->nombre }}</td>

                                                @if ($banco->balances->isNotEmpty())
                                                    @php $balance = $banco->balances->last(); @endphp
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $balance->monto_actual }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $balance->ult_modificacion }}</td>
                                                    <td class="whitespace-nowrap px-3 py-2 text-sm font-medium text-gray-900">
                                                        <form action="{{ route('balances.destroy', $balance->id) }}" method="POST">
                                                            <a href="{{ route('balances.show', $balance->id) }}" class="text-gray-600 hover:text-gray-900 mr-2"><x-bx-show class="w-4 h-4 m-1 inline-block"/>Show</a>
                                                            <a href="{{ route('balances.edit', $balance->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2"><x-feathericon-edit class="w-4 h-4 m-1 inline-block"/>Edit</a>
                                                            <!--
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="{{ route('balances.destroy', $balance->id) }}" 
                                                                class="text-red-600 font-bold hover:text-red-900 mr-2" 
                                                                onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                                <x-monoicon-delete class="w-4 h-4 mr-1 inline-block"/>
                                                                {{ __('Delete') }}
                                                            </a>
                                                            -->
                                                        </form>
                                                    </td>        
                                                @else
                                                    <td colspan="3" class="p-3 bg-yellow-50 rounded-lg text-center">
                                                        <div class="inline-flex items-center space-x-2">
                                                            <span class="text-yellow-800 font-semibold">Sin balance inicial</span>
                                                            <a href="{{ route('balances.create', ['banco_id' => $banco->id]) }}" 
                                                                class="inline-block px-3 py-1 bg-yellow-300 text-yellow-900 rounded-md hover:bg-yellow-400 hover:text-yellow-900">
                                                                <x-typ-plus class="w-4 h-4 mr-1 inline-block"/>Agregar
                                                            </a>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>